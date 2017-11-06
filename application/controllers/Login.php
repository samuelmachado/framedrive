<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {


    public function index(){
        if($this->session->has_userdata('token'))
            redirect('/dashboard');
        $this->load->view('adm/login');
    }
    public function process()
    {
        try {
        $response = json_decode($this->input->raw_input_stream);
        $token = $response->token;
        $account = $response->account;
        if(!$token || $token == '')
            throw new Exception();

        $data = [
            'token'  => $token,
            'account' => $account
        ];

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
