<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
// header('Access-Control-Allow-Origin: *');
// header("Access-Control-Allow-Methods: GET, OPTIONS, POST, GET, PUT");
// header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers", "X-Requested-With, content-type");
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('HTTP/1.0 200 OK');

class Snap extends CI_Controller
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


	public function __construct()
	{
		parent::__construct();
	
		$params = array('server_key' => server_key(), 'production' => is_production());
		$this->load->library('midtrans/Midtrans', 'midtrans');
		$this->midtrans->config($params);
		$this->load->model('Midtrans_payment_model', 'midtrans_payment');
		$this->load->helper('url');
		$this->load->model('User_model', 'user');
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
		$order_id = rand();
		// // Required
		$transaction_details = array(
			'order_id' => $order_id,
			'gross_amount' => (int)$packet_to->harga, // no decimal allowed for creditcard
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

		// // Data yang akan dikirim untuk request redirect_url.
		$credit_card['secure'] = true;
		// //ser save_card true to enable oneclick or 2click
		$credit_card['save_card'] = true;

		$time = time();
		$custom_expiry = array(
			'start_time' => date("Y-m-d H:i:s O", $time),
			'unit' => 'day',
			'duration'  => 1
		);

		$transaction_data = array(
			'transaction_details' => $transaction_details,
			'item_details'       => $item_details,
			'customer_details'   => $customer_details,
			'credit_card'        => $credit_card,
			'expiry'             => $custom_expiry
		);

		// $data = [
		// 	'email' => $email,
		// 	'order_id' => $order_id,
		// 	'tryout' => $slug,
		// 	'status_code' => 204 //status ongoing
		// ];

		// error_log(json_encode($transaction_data));
		
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
	
		// $this->midtrans_payment->insert($data);

		// error_log($snapToken);
		echo $snapToken;
	}

	public function finish()
	{
		// success 200
		// pending 201
		// expire 202
		// cancel 203
		// ongoing 204
		$result = json_decode($this->input->post('result_data'), true);
		$email = $this->input->post('email');
		$now = date("Y-m-d H:i:s O", time());

		$data = [
			'pdf_url' => $result['pdf_url'],
			'updated_at' => $now
		];

		$update = $this->midtrans_payment->update($data, ['email' => $email, 'order_id' => $result['order_id']]);

		if ($update)
			$this->session->set_flashdata('success', 'melakukan pendaftaran tryout. Silakan lakukan pembayaran sebelum batas waktu berakhir');
		else
			$this->session->set_flashdata('error', 'Gagal melakukan pendaftaran tryout');

		redirect(base_url('tryout/detail/' . $this->input->get('slug')));
	}
}