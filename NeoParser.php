<?php

/*
    Класс парсера
*/

include 'phpQuery.php';

class NeoParser extends phpQuery
{
    public string $url;
    public string $dom_element;
    public array  $selectors;

    public function getHtml($url){

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $html = curl_exec($ch);
        curl_close($ch);
        return $html;
    }

    public function getUsdEur($data){
        // https://www.sauberbank.com/
        
        
        $data_rep = preg_replace('/[^0-9 .]/', '', $data);
        $data_list = explode(' ', $data_rep);
        $data_final = [
            'Покупка' => ['USD' => $data_list[0], 'EUR' => $data_list[2]], 
            'Продажа' => ['USD' => $data_list[1], 'EUR' => $data_list[3]]
        ];

        return $data_final;
        
    }

    public function getContent($url, $selector, $method){
        /*
            100 + 17 + 40
        */

        
        $html = $this->getHtml($url);

        $dom = phpQuery::newDocument($html);

        $data = $dom->find($selector)->$method();

        return $this->getUsdEur($data);


        //return $productHref;
    }

}    