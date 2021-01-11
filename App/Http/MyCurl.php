<?php


namespace Http;


class MyCurl
{
    public $response = null;
    public $hasError = false;
    public $errorMessage = '';

    /**
     * @param  string  $url
     * @param  string  $data
     */
    public function send(string $url, string $data = '')
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (curl_errno($ch) || 200 != $httpCode) {
            $this->hasError = true;
            $this->errorMessage = 'Failed to send request: ' . curl_error($ch);
        }
        $response = curl_exec($ch);

        curl_close($ch);

        $this->response = $response;
    }
}