<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->has_userdata('token'))
            redirect('/login');
    }
    public function index()
    {
        $this->load->view('adm/header');
        $this->load->view('adm/dashboard');
        $this->load->view('adm/footer');
    }
    public function process()
    {
        try {
            $token = json_decode($this->input->raw_input_stream)->token;

            if(!$token)
                throw new Exception();

            $data = array(
                'token'  => $token,

            );

            $this->session->set_userdata($data);
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['status' => 200]));
        } catch (Exception $e) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['status' => 400]));
        }
    }
}
