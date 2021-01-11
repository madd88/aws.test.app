<?php


namespace Amazon;


class Response
{
    public $xml;
    public $errorMessage;

    public function __construct($data)
    {
        $this->xml = new \SimpleXMLElement($data);
    }

    /**
     * @return bool
     */
    public function hasError()
    {
        if ($this->xml->Error) {
            $this->errorMessage = $this->xml->Error->Message;

            return true;
        }

        return false;
    }
}