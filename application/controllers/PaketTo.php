<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Loader $load
 * @property Paket_to_model $paket_to
 * @property CI_DB_query_builder $db
 * @property Transaction_model $transaction
 * @property Paket_to_model $paket_to
 * @property Midtrans $midtrans
 * @property User_model $user
 * @property CI_Input $input
 * @property Pendaftar_to_model $pendaftar_to
 * @property User_Tryout_model $user_tryout
 */

class PaketTo extends CI_Controller
{
    protected  $sidebarMenu, $loginUser;
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('User_model', 'user');

        $this->loginUser = $this->user->getLoginUser();
        $this->load->library('midtrans/Midtrans', 'midtrans');
        $params = array('server_key' => server_key(), 'production' => is_production());
        $this->midtrans->config($params);
        $this->load->model('Paket_to_model', 'paket_to');
        $this->load->model('Pendaftar_to_model', 'pendaftar_to');
        $this->load->model('User_tryout_model', 'user_tryout');
        $this->sidebarMenu = 'Tryout';
    }

    public function detail($slug)
    {
        
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
        $paket_to = $this->paket_to->getBySlugWithTryouts($slug);
        $jumlah_peserta = $this->pendaftar_to->getNumPaketParticipantWithSuccessTransaction($paket_to['id']);
        $pendaftar = $this->pendaftar_to->getByPacketToIdWithTransaction($paket_to['id'], $this->loginUser->id);
        $payment_status = '';
        if ($pendaftar['transaction_status'] == 'settlement') {
            $payment_status = 'settlement';
        } else if ($pendaftar['transaction_status'] == 'pending' && $pendaftar['expiry_time'] > date('Y-m-d H:i:s')) {
            $payment_status = 'pending';
        } else {
            $payment_status = 'expired';
        }
        $is_diskon = false;
        foreach ($paket_to['tryouts'] as $i => $tryout) {
            $user_tryout =  $this->user_tryout->get('one', ['user_id' => $this->loginUser->id], $tryout['slug'], '*');
            if ($user_tryout){

                $paket_to['tryouts'][$i]['status'] = 'registered';
                $is_diskon = true;
            }
            else{
                $paket_to['tryouts'][$i]['status'] = 'not_registered';
            }
            
            $total_soal += (int)$tryout['jumlah_soal'];
            $total_waktu += (int)$tryout['lama_pengerjaan'];
        }
        
        
        $data = [
            'title' => 'Detail Paket TO ' . $title,
            'breadcrumb_item' => $breadcrumb_item,
            'sidebar_menu' => $this->sidebarMenu,
            'paket_to' => $paket_to,
            'total_soal' => $total_soal,
            'is_diskon' => $is_diskon,
            'jumlah_peserta' => $jumlah_peserta,
            'jumlah_tryout' => count($paket_to['tryouts']),
            'total_waktu' => $total_waktu,
            'payment_status' => $payment_status,
            'parent_submenu' => $parent_title,
        ];
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('tryout/beli_ilmu/paket_to/detail', $data);
        $this->load->view('templates/user_footer');
    }

    public function paket_to_registration()
    {
        $this->load->model('Transaction_model', 'transaction');
        $this->load->model('Paket_to_model', 'paket_to');
        $this->load->model(('User_Tryout_model'), 'user_tryout');

        $user = $this->loginUser;
        $paket_to_slug = $this->input->post('slug');


        $paket_to = $this->paket_to->getBySlugWithTryouts($paket_to_slug);
        $pendaftar = $this->pendaftar_to->getByPacketToIdWithTransaction($paket_to['id'], $user->id);
        if ($pendaftar['transaction_status'] == 'pending' && $pendaftar['expiry_time'] > date('Y-m-d H:i:s')) {
            print_r($pendaftar['snap_token']);
            exit;
            echo $pendaftar['snap_token'];
            return;
        }
        $is_diskon = false;
        foreach ($paket_to['tryouts'] as $i => $tryout) {
            $user_tryout =  $this->user_tryout->get('one', ['user_id' => $this->loginUser->id], $tryout['slug'], '*');
            if ($user_tryout){

                $paket_to['tryouts'][$i]['status'] = 'registered';
                $is_diskon = true;
            }
            else{
                $paket_to['tryouts'][$i]['status'] = 'not_registered';
            }
        }
        $order_id = 'PTO-' . $paket_to['id'] . '-USR-' . $user->id . '-' . time();
        $gross_amount = $is_diskon ? (int)$paket_to['harga_diskon'] : (int)$paket_to['harga'];
        $transaction_details = array(
            'order_id' => $order_id,
            'gross_amount' => $gross_amount,
        );
        $item1_details = array(
            'price' => $gross_amount,
            'quantity' => 1,
            'name' => $paket_to['nama']
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
                $this->pendaftar_to->update(
                    ['transaction_id' => $transaction_id],
                    ['id' => $pendaftar['id']]
                );
                $this-> user_tryout->updateUserTryoutMultiSlug(
                    ['transaction_id' => $transaction_id],
                    ['user_id' => $user->id],
                    $paket_to['tryouts']
                );
            } else {
                $this->pendaftar_to->insert(
                    [
                        'user_id' => $user->id,
                        'transaction_id' => $transaction_id,
                        'paket_to_id' => $paket_to['id']
                    ]
                );
                $this->user_tryout->insertUserTryoutMultiSlug(
                    ['user_id' => $user->id, 'transaction_id' => $transaction_id,'token'=> 11111, 'status' => 0, 'freemium' => 1,'source_type'=>'paket_to'], 
                    $paket_to['tryouts']
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
