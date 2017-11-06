<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->serverPath = 'framedrive';
        $this->load->library('Transform');
        $this->transform =  new Transform();
        date_default_timezone_set('America/Sao_Paulo');
        if(!$this->session->has_userdata('token')  || $this->session->userdata('account') != 'admin')
            redirect('/login');
        $this->load->library('curl');
        $this->curl = new Curl();

    }
    public function index(){
        $this->load->view('adm/header');
        $this->load->view('adm/projects');
        $this->load->view('adm/footer');
    }

    private function mountUrl($segs,$totalSegs,$subs){
        $i = 4;
        $finalFolder = '';
        while($i <= $totalSegs){
            $finalFolder .= $segs[$i].$subs;
            $i++;
        }
        return rtrim($finalFolder,$subs);
    }
    public function view($project_id){
        if(!$project_id)
            redirect('projects');
        $segs = $this->uri->segment_array();
        $totalSegs = count($segs);


        $this->load->view('adm/header');
        $this->load->view('adm/project', [
           // 'totalSegs' => $totalSegs,
           // 'folders' => $totalSegs > 3 ? $this->mountUrl($segs, $totalSegs,'.') : '',
           // 'path' => $totalSegs > 3 ? '/'.$this->mountUrl($segs, $totalSegs,'/') : '/',
        ]);
        $this->load->view('adm/footer');
    }

    public function upload($project_id){
        if(!$project_id)
            redirect('projects');

        $this->load->view('adm/header');
        $this->load->view('adm/upload');
        $this->load->view('adm/footer');
    }

    public function cu($project_id, $folder_id){
        $a = $this->curl->post('http://localhost:3000/photos/'.$project_id.'/'.$folder_id,[
            'id' => 'framedrive-test/garantia.png/1508184939439835',
            'name' => 'garantia.png',
            'bucket' => 'framedrive-test',
            'size' =>'85964',
            'selfLink' => 'https://www.googleapis.com/storage/v1/b/framedrive-test/o/garantia.png',
            'mediaLink' => 'https://www.googleapis.com/download/storage/v1/b/framedrive-test/o/garantia.png?generation=1508184939439835&alt=media',

        ], $this->session->token );

    }
    public function fileUpload($project_id)
    {
        $folder_id = $this->uri->segment(4);
        if (!empty($_FILES)) {

            $this->load->library('Storage');
            $str = new Storage();

            $obj = $str->auth_cloud_implicit($_FILES['file'],'framedrive-test');

            $a = $this->curl->post('http://localhost:3000/photos/'.$project_id.'/'.$folder_id,[
                'id' => $obj['id'],
                'name' => $obj['name'],
                'bucket' => $obj['bucket'],
                'size' => $obj['size'],
                'selfLink' => $obj['selfLink'],
                'mediaLink' => $obj['mediaLink']

            ], $this->session->token );
        }
        /*
        ini_set('upload_max_filesize', '100M');
       // $this->load->model('lessonParts_model', 'parts');


        $folder = md5('Y-m-d H:i:s');
        $storeFolder = $_SERVER['DOCUMENT_ROOT'] . '/'.$this->serverPath.'assets/u/' . $folder . '/';   //2

        if (!file_exists($storeFolder)) {
            mkdir($storeFolder, 0777, true);
            $myfile = fopen($storeFolder . "index.html", "w");
            fwrite($myfile, "not allowed");
            fclose($myfile);
        }

        //print  $storeFolder;

        if (!empty($_FILES)) {

            $filename = $_FILES["file"]["name"];
            $file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
            $file_ext = substr($filename, strripos($filename, '.')); // get file name

            $tempFile = $_FILES['file']['tmp_name'];          //3

            $targetPath = $storeFolder;  //4
            $newfilename = url_title( $this->transform->clearString($file_basename) ) . $file_ext;
            $targetFile = $targetPath . $_FILES['file']['name'];  //5

            print $targetPath;
            move_uploaded_file($tempFile, $targetPath . $newfilename); //6
            //$dados = [
            //    'lpf_date' => date('Y-m-d'),
            //    'lpf_friendlyname' => $_FILES['file']['name'],
            //    'lpf_name' => $newfilename,
            //    'lpf_path' => base_url('assets/u/' . $folder . '/' . $newfilename),
            //    'les_id' => $les_id,
            //    'lep_id' => $lep_id,
            //];
            //$this->parts->storeFile($dados);
        }
        */
    }
}