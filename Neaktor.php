<?php

/*
    # Writen by mar4elkin
    # started 21 jan 2020
*/


class Neaktor 
{
    public string $url;
    public string $Token;
    public string $body_request;
    public string $request_method;

    public function neoconn($url, $Token, $body_request = '', $request_method = ''){
        /*
            Функция подключения к api и получения json массива  
            Обязательные значения url и токен
        */

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        
        if ($body_request != ''){

            curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
            
            if ($request_method == 'POST'){
                curl_setopt($ch, CURLOPT_POST, 1);
            }

            if ($request_method == 'PUT'){
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            }

            if ($request_method == 'DELETE'){
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            }

            if ($body_request != ''){
                $header = array(
                    'Authorization:'. $Token .' ',
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($body_request)
                );
                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $body_request);

            }

            if ($request_method == 'GET' && $body_request == '') {
                $header = array('Authorization:'. $Token .' ');
                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            }

        } 
        
        $this->data_json = json_decode(curl_exec($ch), TRUE);
        
        return $this->data_json;
    }

}
