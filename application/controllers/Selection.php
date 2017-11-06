<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Selection extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('Transform');
        $this->transform = new Transform();
        date_default_timezone_set('America/Sao_Paulo');

    }

    public function view($project_id){
        if (!$this->session->has_userdata('token'))
            redirect('/login');
        if(!$project_id)
            redirect('home');
        $this->load->view('adm/header');
        $this->load->view('adm/selectionPhotographer');
        $this->load->view('adm/footer',['includes' => 'datatable']);

    }

    public function newUser($project_id){
        if(!$project_id)
            redirect('home');
        //$this->load->view('adm/header');
        $this->load->view('adm/newUser');
        //$this->load->view('adm/footer',['includes' => 'datatable']);
    }

    public function myEvent(){
        if (!$this->session->has_userdata('token') || $this->session->userdata('account') != 'client')
            redirect('/login');

        $this->load->view('adm/header');
        $this->load->view('adm/myEvent');
        $this->load->view('adm/footer');
    }

    public function projects(){
        if (!$this->session->has_userdata('token') || $this->session->userdata('account') != 'client')
            redirect('/login');

        $this->load->view('adm/header');
        $this->load->view('adm/selectionProjects');
        $this->load->view('adm/footer');
    }

}
?>