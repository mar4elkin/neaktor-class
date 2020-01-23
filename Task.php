<?php

include 'Neaktor.php';

class Task extends Neaktor {

    public string $id_field;
    public string $key;
    public array  $data_json;

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