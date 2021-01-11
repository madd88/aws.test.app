<?php


namespace Amazon\OutbondShipping;

use Amazon\Data\Order;
use Amazon\Response;
use Http\MyCurl;


class Request
{

    const AWS_ACCESS_KEY_ID = '';
    const MWS_AUTH_TOKEN = '';
    const SELLER_ID = '';
    const VERSION = '2010-10-01';

    const ENDPOINTS = [
        'US' =>
            [
                'url'             => 'https://mws.amazonservices.com',
                'market_place_id' => 'ATVPDKIKX0DER',
            ],
    ];

    const ACTIONS = [
        'CreateFulfillmentOrder' => 'FulfillmentOutboundShipment',
    ];

    /**
     * @param  array  $data
     * @param  string  $action
     * @param  string  $code
     *
     * @return string
     * @throws \Exception
     */
    public function prepare(array $data, string $action, string $code)
    {
        if ( ! is_array($data) || 0 === count($data)) {
            throw new \Exception('Invalid data');
        }

        $params = [
            'AWSAccessKeyId'   => self::AWS_ACCESS_KEY_ID,
            'Action'           => $action,
            'Parameters'       => $data,
            'MWSAuthToken'     => self::MWS_AUTH_TOKEN,
            'SellerId'         => self::SELLER_ID,
            'SignatureMethod'  => 'HmacSHA256',
            'SignatureVersion' => 2,
            'Timestamp'        => date('c'),
        ];

        $data = http_build_query($params);
        $url = "POST\n".self::ENDPOINTS[$code]['url']."\n/".self::ACTIONS[$action]."/".self::VERSION."\n".$params;
        $params['Signature'] = hash_hmac('sha256', $url, self::AWS_ACCESS_KEY_ID);

        return http_build_query($params);
    }

    /**
     * @param $action
     * @param $code
     * @param $data
     *
     * @return null|\SimpleXMLElement
     * @throws \Exception
     */
    public function request($action, $code, $data)
    {
        $mch = new MyCurl();
        $url = self::ENDPOINTS[$code]['url'].'/'.self::ACTIONS[$action].'/'.self::VERSION;
        $mch->send($url, $data);
        $res = new Response($mch->response);
        if ($res->hasError()) {
            throw new \Exception("AWS error: ".$res->errorMessage);
        }

        return $mch->response;
    }
}