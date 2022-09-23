<?php
class My404 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->model('Company_settings_model', 'company_settings');
        $company = $this->company_settings->get('one', ['id' => 1]);

        $data = [
            'company' => $company
        ];

        $this->output->set_status_header('404');
        $this->load->view('error404', $data); //loading in custom error view
    }
}