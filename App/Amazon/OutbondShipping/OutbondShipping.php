<?php


namespace Amazon\OutbondShipping;


use Amazon\Data\Order;
use Amazon\Data\Buyer;
use Amazon\OutbondShipping\Request;

class OutbondShipping implements \Amazon\IOutbondShipping
{
    /**
     * @param  Order  $oOrder
     * @param  Buyer  $oBuyer
     *
     * @return string
     * @throws \Exception
     */
    public function ship(Order $oOrder, Buyer $oBuyer)
    {
        $AwsClient = new \Amazon\OutbondShipping\Request();
        $items = [];
        foreach ($oOrder->data['products'] as $product) {
            $items[] = [
                'SellerSKU'                    => $oOrder->data['sku'],
                'SellerFulfillmentOrderItemId' => $oOrder->data['payment_id'],
                'Quantity'                     => $oOrder->data['ammount'],
                'DisplayableComment'           => $oOrder->data['comment'],
                'PerUnitDeclaredValue'         => $oOrder->data['original_price'],
                'PerUnitPrice'                 => $oOrder->data['buying_price'],
            ];
        }
        $data = [
            'MarketplaceId'            => $AwsClient::ENDPOINTS[$oBuyer->get_country_code()]['market_place_id'],
            'SellerFulfillmentOrderId' => $oOrder->data['order_unique'],
            'DisplayableOrderId'       => $oOrder->data['order_id'],
            'DisplayableOrderDateTime' => date('Y-m-d', strtotime($oOrder->data['order_date'])),
            'ShippingSpeedCategory'    => 'Standard',
            'DestinationAddress'       => $oOrder->data['shipping_adress'],
            'NotificationEmailList'    => $oBuyer->email,
            'Items'                    => $items,
        ];
        $data = $AwsClient->prepare($data, 'CreateFulfillmentOrder', $oBuyer->get_country_code());
        $response = $AwsClient->request('CreateFulfillmentOrder', $oBuyer->get_country_code(), $data, 'post');

        $data = [
            'SellerFulfillmentOrderId' => $oOrder->data['order_unique'],
        ];

        $data = $AwsClient->prepare($data, 'GetFulfillmentOrder', $oBuyer->get_country_code());
        $response = $AwsClient->request('GetFulfillmentOrder', $oBuyer->get_country_code(), $data, 'post');
        $trackingNumbers = [];
        foreach ($response->GetFulfillmentOrderResult->FulfillmentShipment->member as $item) {
            if (isset($item->FulfillmentShipmentPackage)) {
                foreach ($item->FulfillmentShipmentPackage->member as $member) {
                    if (isset($member->TrackingNumber)) {
                        $trackingNumbers[] = (string)$member->TrackingNumber;
                    }
                }
            }
        }

        return implode(', ', $trackingNumbers);
    }

}