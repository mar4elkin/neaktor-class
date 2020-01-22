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


            $header = array(
                'Authorization:'. $Token .' ',
                'Content-Type: application/json',
                'Content-Length: ' . strlen($body_request)
            );
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body_request);

        } else {
            // GET method
            $header = array('Authorization:'. $Token .' ');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        
        $this->data_json = json_decode(curl_exec($ch), TRUE);
        
        return $this->data_json;
    }

    public function picker($id_field, $key){
        /*
            Функция выбора значения из списков 
            Обязательные значения id и значения ключа который нам нужен
            Работает только при использование id выбранной задачи
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

    $url = 'https://api.neaktor.com/v1/tasks/5385604';
    $token = 'TOKEN HERE';

    $id = 'createddate';
    $key = 'value';

    $json_string_post = '
    {
        "startDate": "18-10-2019T18:03:18",
        "endDate": "18-11-2019T18:30:25",
        "assignee": {
           "id": "529405",
           "type": "USER"
        },
        "fields": [
           {
              "id": "subject",
              "value": "Ntcn"
           }
  
        ]
     }
    
    ';

     $json_string_put = '
     {
        "startDate": "18-10-2019T18:03:18",
        "endDate": "18-11-2019T18:30:25",
        "assignee": {
           "id": "529405",
           "type": "USER"
        },
        "fields": [
           {
              "id": "tags",
              "value": "djopat"
           }
        ]
     }
     ';

     $json_string_delete = '
     {
        "deleted": true,
        "message": "101"
     }
     ';

    $Neaktor = new Neaktor();  
    $data = $Neaktor->neoconn($url, $token, $json_string_delete, 'DELETE');
    print_r($data);
    //echo $Neaktor->picker($id, $key);
?>