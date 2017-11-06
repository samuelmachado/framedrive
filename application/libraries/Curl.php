<?php

class Curl {

    private $ch;
    public function get($url,$token)
    {

        try {

            $this->init($url);

            //curl_setopt($this->ch,CURLOPT_TIMEOUT, 1);
            curl_setopt($this->ch, CURLOPT_URL, $url);
            curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($this->ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                'x-auth: '.$token));

            return $this->exec();
        }  catch (Exception $e) {
            throw new Exception("Not Found");
        }

    }
    public function postNotification($data){
        $this->init("https://onesignal.com/api/v1/notifications");

        curl_setopt($this->ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
            'Authorization: Basic ODI1MzdhZTUtMGE0Mi00ZGQ0LWI1OGYtZmM5ZGMyODI3NWQy'));
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($this->ch, CURLOPT_HEADER, FALSE);
        curl_setopt($this->ch, CURLOPT_POST, TRUE);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        return $this->exec();
    }

    public function post($url,$data, $token)
    {

        $this->init($url);

        curl_setopt($this->ch,CURLOPT_POST, true);
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded',
            'x-auth: '.$token));
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch,CURLOPT_POSTFIELDS, http_build_query($data));

        return $this->exec();

    }
    public function put($url,$data)
    {
        //echo $url."<br>";

        $this->init($url);

        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($this->ch, CURLOPT_POSTFIELDS,http_build_query($data));
        curl_setopt( $this->ch, CURLOPT_USERPWD, "dev@duraflex.com.br:p1p0c@s");
        curl_setopt( $this->ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($this->ch,CURLOPT_POSTFIELDS, http_build_query($data));


        curl_setopt($this->ch,CURLOPT_HEADER, false);

        return $this->exec();

    }
    public function delete($url)
    {
        //echo $url."<br>";

        $this->init($url);

        curl_setopt($this->ch,CURLOPT_POST, $url);
        curl_setopt($this->ch,CURLOPT_CUSTOMREQUEST, "DELETE");

        curl_setopt( $this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, ["Content-type: multipart/form-data"]);
        //curl_setopt($this->ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt( $this->ch, CURLOPT_USERPWD, "dev@duraflex.com.br:p1p0c@s");
        curl_setopt( $this->ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        // curl_setopt($this->ch,CURLOPT_POSTFIELDS, $data);
        return $this->exec();

    }

    private function init($url)
    {

        $this->ch = curl_init();
        curl_setopt($this->ch,CURLOPT_URL, $url);

    }

    private function exec()
    {
        $result = curl_exec($this->ch);


        return json_decode($result);
    }

}