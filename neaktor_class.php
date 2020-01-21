<?php

/*
    # Writen by mar4elkin
    # started 21 jan 2020
*/


class Neaktor 
{
    public string $url;
    public string $Token;
    public string $id_field;
    public string $key;
    public array  $data_json;

    public function connect($url, $Token){
        /*
            Функция подключения к api и получения json массива  
            Обязательные значения url и токен
        */
        
        $header = array('Authorization:'. $Token .' ');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        
        $this->data_json = json_decode(curl_exec($ch), TRUE);
        
        return $this->data_json;
    }

    public function picker($id_field, $key){
        /*
            Функция выбора значения из списков 
            Обязательные значения id и значения ключа который нам нужен
        */

        $json_de = $this->data_json['data'][0]['fields'];
        
        foreach($json_de as $v){
            foreach($v as $id => $k){
                if(!is_array($k)) {
                    if ($id == 'id' && $k == $id_field){
                        return $v[$key];
                        
                    }
                
                }/* 
                    Дополнительная вложоность в список Нужно доделать 
                    else { 
                        foreach($k as $l => $ll){
                            print_r($l." ".$ll);
                            echo '<br>'; 
                        }
                    }
                */
                
            }
        }

    }
}

    $url = 'https://api.neaktor.com/v1/tasks';
    $token = '4ef02rtpcc94ke74npsdasdadf';

    $id = 'createddate';
    $key = 'value';

    $Neaktor = new Neaktor();  
    $Neaktor->connect($url, $token);
    echo $Neaktor->picker($id, $key);
?>