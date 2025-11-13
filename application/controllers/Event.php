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
        $params = array('server_key' => server_key(), 'production' => is_production());
        $this->midtrans->config($params);
        $this->sidebarMenu = 'Tryout';
    }

    public function detail_event($id)
    {
        $this->load->model('Event_model', 'event');
        $this->load->model('Event_pendaftar_model', 'event_pendaftar');
        $submenu_parent = 10;
        $parent_title = getSubmenuTitleById($submenu_parent)['title'];
        submenu_access($submenu_parent);
        $title = $id;
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
        $jumlah_peserta = $this->event_pendaftar->getNumEventParticipantWithSuccessTransaction($id);
        $total_waktu = 0;
        $event = $this->event->getByIdWithTryouts($id);
        $pendaftar = $this->event_pendaftar->getByEventIdWithTransaction($id, $this->loginUser->id);
        $payment_status = '';
        if ($pendaftar['transaction_status'] == 'settlement') {
            $payment_status = 'settlement';

        } else if ($pendaftar['transaction_status'] == 'pending' && $pendaftar['expiry_time'] > date('Y-m-d H:i:s')) {
            $payment_status = 'pending';
        } else {
            $payment_status = 'expired';
        }
        
        foreach ($event['tryouts'] as $tryout) {
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
            'payment_status' => $payment_status,
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

        $event_id = $this->input->post('id');

        $user = $this->loginUser;
        $order_id = 'EVT-' . $event_id . '-USR-' . $user->id . '-' . time();
        $pendaftar = $this->event_pendaftar->getByEventIdWithTransaction($event_id, $user->id);
        if ($pendaftar['transaction_status'] == 'pending' && $pendaftar['expiry_time'] > date('Y-m-d H:i:s')) {
            print_r($pendaftar['snap_token']);
            exit;
            echo $pendaftar['snap_token'];
            return;
        }
        $event = $this->event->getByIdWithTryouts($event_id);
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
            'unit' => 'minute',
            'duration'  => 1
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
            } else {

                $this->event_pendaftar->insert([
                    'event_id' => $event_id,
                    'user_id' => $user->id,
                    'transaction_id' => $transaction_id,
                ]);
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
                ['snap_token' => $snap_token, 'expiry_time' => date("Y-m-d H:i:s", time() + (1 * 1 * 60))]
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
