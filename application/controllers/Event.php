<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Loader $load
 * @property User_model $user
 * @property Event_model $event
 * @property Event_pendaftar_model $event_pendaftar
 * @property Transaction_model $transaction
 * @property Midtrans $midtrans
 * @property CI_Input $input
 * @property CI_DB_query_builder $db
 * @property User_tryout_model $user_tryout
 * 
 */

class Event extends CI_Controller
{
    protected $loginUser, $sidebarMenu;
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('User_model', 'user');

        $this->loginUser = $this->user->getLoginUser();
        $this->load->library('midtrans/Midtrans', 'midtrans');
        $this->load->model('User_tryout_model','user_tryout');
        $params = array('server_key' => server_key(), 'production' => is_production());
        $this->midtrans->config($params);
        $this->sidebarMenu = 'Tryout';
    }

    public function detail_event($slug)
    {
        $this->load->model('Event_model', 'event');
        $this->load->model('Event_pendaftar_model', 'event_pendaftar');
        
        $submenu_parent = 10;
        $parent_title = getSubmenuTitleById($submenu_parent)['title'];
        submenu_access($submenu_parent);
        $title = $slug;
        $breadcrumb_item = [
            [
                'title' => $parent_title,
                'href' => 'tryout'
            ],
            [
                'title' => $title,
                'href' => 'active'
            ]
        ];
        $total_soal = 0;
        $total_waktu = 0;
        $event = $this->event->getBySlugWithTryouts($slug);
        $jumlah_peserta = $this->event_pendaftar->getNumEventParticipantWithSuccessTransaction($event['id']);
        $payment_status = '';
        $pendaftar = $this->event_pendaftar->getByEventIdWithTransaction($event['id'], $this->loginUser->id);
        if ($pendaftar) {
            if (!$pendaftar['freemium']){
                $payment_status = "free";
            }
            else if ($pendaftar['transaction_status'] == 'settlement') {
                $payment_status = 'settlement';
    
            } else if ($pendaftar['transaction_status'] == 'pending' && $pendaftar['expiry_time'] > date('Y-m-d H:i:s')) {
                $payment_status = 'pending';
            }
        } else {
            $payment_status = 'expired';
        }
        
        foreach ($event['tryouts'] as $i => $tryout) {
            $user_tryout = $this->user_tryout->get('one', ['user_id' => $this->loginUser->id], $tryout['slug'], '*');
            if ($user_tryout){

                $event['tryouts'][$i]['status'] = 'registered';
                
            }
            else{
                $event['tryouts'][$i]['status'] = 'not_registered';
            }
            $total_soal += (int)$tryout['jumlah_soal'];
            $total_waktu += (int)$tryout['lama_pengerjaan'];
        }
        
        $data = [
            'title' => 'Detail Paket TO ' . $title,
            'breadcrumb_item' => $breadcrumb_item,
            'event' => $event,
            'total_soal' => $total_soal,
            'jumlah_peserta' => $jumlah_peserta,
            'jumlah_tryout' => count($event['tryouts']),
            'total_waktu' => $total_waktu,
            'sidebar_menu' => $this->sidebarMenu,
            'payment_status' => $payment_status ,
            'parent_submenu' => $parent_title,
        ];
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('tryout/beli_ilmu/events/detail', $data);
        $this->load->view('templates/user_footer');
    }

    public function event_registration()
    {
        $this->load->model('Event_model', 'event');
        $this->load->model('Event_pendaftar_model', 'event_pendaftar');
        $this->load->model('Transaction_model', 'transaction');

        $user = $this->loginUser;
        $event_slug = $this->input->post('slug');

        $event = $this->event->getBySlugWithTryouts($event_slug);
        $pendaftar = $this->event_pendaftar->getByEventIdWithTransaction($event['id'], $user->id);
        if ($pendaftar['transaction_status'] == 'pending' && $pendaftar['expiry_time'] > date('Y-m-d H:i:s')) {
            print_r($pendaftar['snap_token']);
            exit;
            echo $pendaftar['snap_token'];
            return;
        }
        $order_id = 'EVT-' . $event['id'] . '-USR-' . $user->id . '-' . time();
        foreach ($event['tryouts'] as $i => $tryout) {
            $user_tryout =  $this->user_tryout->get('one', ['user_id' => $this->loginUser->id], $tryout['slug'], '*');
            if ($user_tryout){
                $event['tryouts'][$i]['status'] = 'registered';
                
            }
            else{
                $event['tryouts'][$i]['status'] = 'not_registered';
            }
        }
        $gross_amount = (int)$event['harga'];
        $transaction_details = array(
            'order_id' => $order_id,
            'gross_amount' => $gross_amount,
        );
        $item1_details = array(
            'price' => $gross_amount,
            'quantity' => 1,
            'name' => $event['name']
        );

        $item_details = array($item1_details);

        $customer_details = array(
            'first_name'    => $user->name,
            'email'         => $user->email,
            'phone'         => $user->no_wa
        );
        $credit_card = array(
            'secure' => true,
            'save_card' => true
        );

        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O", time()),
            'unit' => 'hour',
            'duration'  => 2
        );
        $data = [
            'user_id' => $user->id,
            'order_id' => $order_id,
            'gross_amount' => $gross_amount,
            'transaction_time'   => date('Y-m-d H:i:s'),
            'transaction_status' => 'pending'
        ];
        try {


            $this->db->trans_begin();

            $transaction_id = $this->transaction->insert($data);
            if ($pendaftar['transaction_status'] == 'pending' && $pendaftar['expiry_time'] <= date('Y-m-d H:i:s')) {
                $this->event_pendaftar->update(
                    ['transaction_id' => $transaction_id],
                    ['id' => $pendaftar['id']]
                );
                $this-> user_tryout->updateUserTryoutMultiSlug(
                    ['transaction_id' => $transaction_id],
                    ['user_id' => $user->id],
                    $event['tryouts']
                );
            } else {

                $this->event_pendaftar->insert([
                    'event_id' => $event['id'],
                    'user_id' => $user->id,
                    'transaction_id' => $transaction_id,
                ]);
                $this->user_tryout->insertUserTryoutMultiSlug(
                    ['user_id' => $user->id, 'transaction_id' => $transaction_id,'token'=> 11111, 'status' => 0, 'freemium' => 1,'source_type'=>'event','source_id'=>$event['id']], 
                    $event['tryouts']
                );

            }
            $params = array(
                'transaction_details' => $transaction_details,
                'item_details'       => $item_details,
                'customer_details'   => $customer_details,
                'credit_card'        => $credit_card,
                'expiry'             => $custom_expiry
            );
            $snap_token = $this->midtrans->getSnapToken($params);
            $this->transaction->updateByOrderId(
                $order_id,
                ['snap_token' => $snap_token, 'expiry_time' => date("Y-m-d H:i:s", time() + (2 * 60 * 60))]
            );
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                throw new Exception("Gagal menyimpan transaksi atau pendaftar.");
            } else {
                $this->db->trans_commit();
            }
            echo $snap_token;
        } catch (\Throwable $th) {
            $this->db->trans_rollback();
            log_message('error', 'Gagal buat transaksi: ' . $th->getMessage());
            throw $th;
        }
    }
}
