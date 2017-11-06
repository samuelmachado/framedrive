<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	public function index()
	{
	    //print $_SERVER['DOCUMENT_ROOT'].'/framedrive/assets/key.json';
        $this->load->library('Storage');
        $teta = new Storage();
        $teta->auth_cloud_implicit();
    }



}
