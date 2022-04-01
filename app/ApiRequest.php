<?php

require_once 'Config.php';

trait ApiRequest
{
    public $token = Config::TOKEN;
    public $url   = Config::URL_API;
  
    public function get(string $actionParam = ''): string
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "{$this->url}?token={$this->token}&acao={$actionParam}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }
}
