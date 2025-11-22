<?php 
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Loader $load
 * @property User_model $user
 * @property Transaction_model $transaction
 * @property Pendaftar_to_model $pendaftar_to
 * @property Event_pendaftar_model $event_pendaftar
 * @property CI_Input $input
 * @property CI_DB_query_builder $db
 * 
 */
class MyOrder extends CI_Controller
{
    protected $loginUser, $sidebarMenu;

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('User_model', 'user');
        $this->load->model('Transaction_model', 'transaction');
        $this->load->model('Pendaftar_to_model', 'pendaftar_to');
        $this->load->model('Event_pendaftar_model', 'event_pendaftar');
        
        $this->loginUser = $this->user->getLoginUser();
        $this->sidebarMenu = 'My Orders';
    }

    public function index()
    {

        $parent_title = getSubmenuTitleById(27)['title'];
        submenu_access(27);
        
        $parent_title = 'Pembelian Saya';

        $breadcrumb_item = [
            [
                'title' => $parent_title,
                'href' => 'active'
            ]
        ];

        $user = $this->loginUser;
        
        // Get all transactions for this user
        $transactions = $this->get_user_transactions($user->id, $user->email);
        
        $data = [
            'title' => 'Pembelian Saya',
            'breadcrumb_item' => $breadcrumb_item,
            'user' => $user,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'transactions' => $transactions
        ];

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('tryout/my_orders/index', $data);
        $this->load->view('templates/user_footer');
    }
    
    private function get_user_transactions($user_id, $user_email)
    {
        $transactions = [];
        
        // 1. Get transactions from user_tryout (per tryout slug)
        // First, get all tryouts
        $this->db->select('id, slug, name');
        $tryouts = $this->db->get('tryout')->result_array();
        
        foreach ($tryouts as $tryout) {
            $table_name = 'user_tryout_' . $tryout['slug'];
            
            // Check if table exists
            if ($this->db->table_exists($table_name)) {
                // Check columns
                $fields = $this->db->list_fields($table_name);
                $has_freemium = in_array('freemium', $fields);
                $has_user_id = in_array('user_id', $fields);
                $has_email = in_array('email', $fields);
                $has_transaction_id = in_array('transaction_id', $fields);
                
                // Skip if no transaction_id column (old table before midtrans)
                if (!$has_transaction_id) {
                    continue;
                }
                
                $select = "
                    ut.id,
                    tr.order_id,
                    tr.gross_amount,
                    tr.transaction_status,
                    tr.payment_type,
                    tr.va_number,
                    tr.created_at,
                    tr.updated_at,
                    tr.expiry_time,
                    '{$tryout['name']}' as item_name,
                    '{$tryout['slug']}' as slug,
                    'Tryout' as purchase_type,
                    'tryout' as source_type
                ";
                
                $this->db->select($select);
                $this->db->from($table_name . ' ut');
                $this->db->join('transactions tr', 'tr.id = ut.transaction_id', 'inner');
                
                // Use user_id if exists, otherwise use email
                if ($has_user_id) {
                    $this->db->where('ut.user_id', $user_id);
                } elseif ($has_email) {
                    $this->db->where('ut.email', $user_email);
                }
                
                // Exclude data without transaction_id (before midtrans integration)
                $this->db->where('ut.transaction_id IS NOT NULL');
                $this->db->where('ut.transaction_id !=', 0);
                
                $result = $this->db->get()->result_array();
                
                // Add freemium flag to results
                foreach ($result as &$row) {
                    $row['is_free'] = 0; // Default not free
                    if ($has_freemium) {
                        // Check if this is a free tryout by querying again
                        $this->db->select('freemium');
                        $this->db->from($table_name);
                        $this->db->where('id', $row['id']);
                        $freemium_data = $this->db->get()->row_array();
                        if ($freemium_data && $freemium_data['freemium'] == 1) {
                            $row['is_free'] = 1;
                            // Keep gross_amount as is (don't change to 0)
                        }
                    }
                }
                unset($row);
                
                $transactions = array_merge($transactions, $result);
            }
        }
        
        // 2. Get transactions from pendaftar_paket_to
        $this->db->select("
            ppt.id,
            ppt.paket_to_id,
            tr.order_id,
            tr.gross_amount,
            tr.transaction_status,
            tr.payment_type,
            tr.va_number,
            tr.created_at,
            tr.updated_at,
            tr.expiry_time,
            pt.nama as item_name,
            pt.slug as slug,
            'Paket Tryout' as purchase_type,
            'paket_to' as source_type
        ");
        $this->db->from('pendaftar_paket_to ppt');
        $this->db->join('transactions tr', 'tr.id = ppt.transaction_id', 'inner');
        $this->db->join('paket_to pt', 'pt.id = ppt.paket_to_id', 'left');
        $this->db->where('ppt.user_id', $user_id);
        
        $paket_transactions = $this->db->get()->result_array();
        $transactions = array_merge($transactions, $paket_transactions);
        
        // 3. Get transactions from events_pendaftar
        $this->db->select("
            ep.id,
            ep.event_id,
            tr.order_id,
            tr.gross_amount,
            tr.transaction_status,
            tr.payment_type,
            tr.va_number,
            tr.created_at,
            tr.updated_at,
            tr.expiry_time,
            e.name as item_name,
            e.slug as slug,
            'Event' as purchase_type,
            'event' as source_type
        ");
        $this->db->from('events_pendaftar ep');
        $this->db->join('transactions tr', 'tr.id = ep.transaction_id', 'inner');
        $this->db->join('events e', 'e.id = ep.event_id', 'left');
        $this->db->where('ep.user_id', $user_id);
        
        $event_transactions = $this->db->get()->result_array();
        $transactions = array_merge($transactions, $event_transactions);
        
        // Sort by created_at DESC
        usort($transactions, function($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });
        
        return $transactions;
    }
}