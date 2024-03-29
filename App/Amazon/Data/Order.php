<?php

namespace Amazon\Data;

class Order
{

    protected $id;
    public $data;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function load($data = [])
    {
        $this->data = $data;
    }

}

class MockOrder extends Order
{

    public function __construct()
    {
        parent::__construct(16400);
    }

    public function load($data = [])
    {
        parent::load(
            [
                'order_id'         => '16400',
                'order_unique'     => '191507268019',
                'site_client_id'   => '16',
                'account_id'       => '0',
                'client_id'        => '29664',
                'currency'         => 'USD',
                'store_name'       => 'ebay_store',
                'tracking_number'  => '',
                'shipping_adress'  => 'Maria Garlick
    37 Baird Rd
    Lock Haven
    PA
    17745 United States
    
    ',
                'shipping_city'    => 'Lock Haven',
                'shipping_state'   => 'PA',
                'shipping_country' => 'US',
                'shipping_street'  => '37 Baird Rd',
                'shipping_zip'     => '17745',
                'lang_id'          => '0',
                'order_date'       => '2015-04-14',
                'due_date'         => '2015-04-24',
                'discount_rate'    => '0',
                'discount_sum'     => '0',
                'shipping_type_id' => '1',
                'shiping_name'     => 'Economy Shipping from outside US',
                'shipping_price'   => '0',
                'final_price'      => '98',
                'status'           => '6',
                'hide_recieved'    => '1',
                'comments'         => 'Could you please make the Red Garnet ring a size 10.5 ????',
                'recipents'        => '',
                'update_date'      => '0000-00-00 00:00:00',
                'archived'         => '0',
                'data'             => [],
                'id'               => '16400',
                'buyer_name'       => 'Maria Garlick',
                'shop_username'    => 'mamagarlick',
                'calculated_price' => 98,
                'products'         =>
                    [
                        0 =>
                            [
                                'order_product_id'    => '18770',
                                'site_client_id'      => '16',
                                'order_id'            => '16400',
                                'product_id'          => '40262',
                                'external'            => '0',
                                'title'               => 'Red Garnet Ring 925 Sterling Silver Band Lady Stylish Fashion Jewelry Size 10',
                                'payment_id'          => '291420391872-1157104689019',
                                'product_code'        => 'RIMN02SI0GRRDRIMN02SGR-10',
                                'buying_price'        => '49.00',
                                'original_price'      => '49.00',
                                'ammount'             => '1',
                                'comment'             => 'size 10.5',
                                'listing_id'          => '456850',
                                'stock_action_status' => '1',
                                'stock_action_code'   => 'revise_qty',
                                'lang_id'             => '0',
                                'update_date'         => '2015-04-14 06:10:12',
                                'sku'                 => 'RIMN02SGR-10',
                            ],
                        1 =>
                            [
                                'order_product_id'    => '18771',
                                'site_client_id'      => '16',
                                'order_id'            => '16400',
                                'product_id'          => '39696',
                                'external'            => '0',
                                'title'               => '925 Sterling Silver Ring FLOWERS Cherry Quartz Cocktail trendy design Size 10',
                                'payment_id'          => '301573586818-1110996005020',
                                'product_code'        => 'RIWF04SI0QUCHRIWF04SCQ-10',
                                'buying_price'        => '49.00',
                                'original_price'      => '49.00',
                                'ammount'             => '1',
                                'comment'             => '',
                                'listing_id'          => '448072',
                                'stock_action_status' => '1',
                                'stock_action_code'   => 'revise_qty',
                                'lang_id'             => '0',
                                'update_date'         => '2015-04-14 06:10:19',
                                'sku'                 => 'RIWF04SCQ-10',
                            ],
                    ],
            ]
        );
    }

}