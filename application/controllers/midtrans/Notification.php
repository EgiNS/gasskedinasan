<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends CI_Controller
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
		$this->load->library('midtrans/Veritrans', 'veritrans');
		$this->veritrans->config($params);
		$this->load->model('Midtrans_payment_model', 'midtrans_payment');
		$this->load->model('User_tryout_model', 'user_tryout');
		$this->load->helper('url');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		echo 'test notification handler';
		$json_result = file_get_contents('php://input');
		$result = json_decode($json_result, true);

		$now = date("Y-m-d H:i:s O", time());
		$order_id = $result['order_id'];

		if ($result['status_code'] == 200) {
			$data = [
				'status_code' => $result['status_code'],
				'updated_at' => $now
			];
			$this->midtrans_payment->update($data, ['order_id' => $order_id]);


			$order_payment = $this->midtrans_payment->get('one', ['order_id' => $order_id]);
			$slug = $order_payment['tryout'];

			$data = [
				'email' => $order_payment['email'],
				'token' => $this->_randtoken(),
				'status' => 0
			];

			$this->user_tryout->insert($data, $slug);
		} else if ($result['status_code'] == 202) {
			$order = $this->midtrans_payment->get('one', ['order_id' => $order_id]);
			if ($order['status_code'] != 203) {
				$data = [
					'status_code' => $result['status_code'],
					'updated_at' => $now
				];
				$this->midtrans_payment->update($data, ['order_id' => $order_id]);
			}
		} else if ($result['status_code'] == 201) {
			$data = [
				'transaction_id' => $result['transaction_id'],
				'gross_amount' => $result['gross_amount'],
				'payment_type' => $result['payment_type'],
				'transaction_time' => $result['transaction_time'],
				'bank' => $result['va_numbers'][0]['bank'],
				'va_number' => $result['va_numbers'][0]['va_number'],
				'pdf_url' => $result['pdf_url'],
				'status_code' => $result['status_code'],
				'updated_at' => $now
			];

			$this->midtrans_payment->update($data, ['order_id' => $order_id]);
		}
		//notification handler sample

		/*
		$transaction = $notif->transaction_status;
		$type = $notif->payment_type;
		$order_id = $notif->order_id;
		$fraud = $notif->fraud_status;

		if ($transaction == 'capture') {
		  // For credit card transaction, we need to check whether transaction is challenge by FDS or not
		  if ($type == 'credit_card'){
		    if($fraud == 'challenge'){
		      // TODO set payment status in merchant's database to 'Challenge by FDS'
		      // TODO merchant should decide whether this transaction is authorized or not in MAP
		      echo "Transaction order_id: " . $order_id ." is challenged by FDS";
		      } 
		      else {
		      // TODO set payment status in merchant's database to 'Success'
		      echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
		      }
		    }
		  }
		else if ($transaction == 'settlement'){
		  // TODO set payment status in merchant's database to 'Settlement'
		  echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
		  } 
		  else if($transaction == 'pending'){
		  // TODO set payment status in merchant's database to 'Pending'
		  echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
		  } 
		  else if ($transaction == 'deny') {
		  // TODO set payment status in merchant's database to 'Denied'
		  echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
		}*/
	}

	private function _randtoken()
	{
		$token = rand(111111, 999999);
		return $token;
	}
}