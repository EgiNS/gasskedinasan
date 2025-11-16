<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers", "X-Requested-With, content-type");
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('HTTP/1.0 200 OK');

/**
 * @property CI_Loader $load
 * @property CI_Input $input
 * @property CI_DB_query_builder $db
 * @property Midtrans $midtrans
 * @property object $loginUser
 * @property User_model $user
 * @property Transaction_model $transaction
 * @property Pendaftar_to_model $pendaftar_to
 * @property Event_pendaftar_model $event_pendaftar
 */
class MidtransController extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	protected $loginUser;

	public function __construct()
	{
		parent::__construct();



		$params = array('server_key' => server_key(), 'production' => is_production());
		$this->load->library('midtrans/Midtrans', 'midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');
		$this->load->model('User_model', 'user');
		$this->load->model('Transaction_model', 'transaction');
		$this->load->model('Pendaftar_to_model', 'pendaftar_to');
		$this->loginUser = $this->user->getLoginUser();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		$this->load->view('checkout_snap');
	}

	public function token()
	{
		$paket_to_id = $this->input->post('id');
		$packet_to = $this->db->get_where('paket_to', ['id' => $paket_to_id])->row();
		$user = $this->loginUser;
		$order_id = 'ORDER-' . uniqid();
		$gross_amount = (int)$packet_to->harga;
		// // Required
		$transaction_details = array(
			'order_id' => $order_id,
			'gross_amount' => (int)$packet_to->harga,
		);

		$item1_details = array(
			'id' => $packet_to->id,
			'price' => (int)$packet_to->harga,
			'quantity' => 1,
			'name' => $packet_to->nama
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
			'unit' => 'day',
			'duration'  => 1
		);

		$data = [
			'user_id' => $user->id,
			'order_id' => $order_id,
			'gross_amount' => $gross_amount,
			'transaction_time'   => date('Y-m-d H:i:s'),
			'transaction_status' => 'pending'
		];

		$transaction_id = $this->transaction->insert($data);

		$pendaftar_to_data = [
			'user_id' => $user->id,
			'transaction_id' => $transaction_id,
			'paket_to_id' => $packet_to->id
		];
		$this->pendaftar_to->insert($pendaftar_to_data);
		$params = array(
			'transaction_details' => $transaction_details,
			'item_details'       => $item_details,
			'customer_details'   => $customer_details,
			'credit_card'        => $credit_card,
			'expiry'             => $custom_expiry
		);
		$snapToken = $this->midtrans->getSnapToken($params);

		echo $snapToken;
	}

	public function notification()
	{
		$this->load->model('Event_pendaftar_model', 'event_pendaftar');
		$json = file_get_contents('php://input');
		$notif = json_decode($json);
		if (!$notif) {
			http_response_code(400);
			return;
		}
		$data = [
			'transaction_id'     => $notif->transaction_id ?? null,
			'payment_type'       => $notif->payment_type ?? null,
			'transaction_time'   => $notif->transaction_time ?? date('Y-m-d H:i:s'),
			'bank'               => isset($notif->va_numbers[0]->bank) ? $notif->va_numbers[0]->bank : null,
			'va_number'          => isset($notif->va_numbers[0]->va_number) ? $notif->va_numbers[0]->va_number : null,
			'pdf_url'            => $notif->pdf_url ?? null,
			'status_code'        => $notif->status_code ?? null,
			'fraud_status'       => $notif->fraud_status ?? null,
			'transaction_status' => $notif->transaction_status,
			'updated_at'         => date('Y-m-d H:i:s'),
		];
		if ($data['transaction_status'] != 'settlement') {
			return;
		}
		$this->transaction->updateByOrderId($notif->order_id, $data);
	
	}	
}
