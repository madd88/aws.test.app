<?php

namespace Amazon;


interface IOutbondShipping
{

    /**
     * Need to realize logic that will sent command to Amazon FBA to ship order
     * and will return tracking number as string for this order.
     * if operation cannot be performed please throw Exception with error message
     *
     * @param  \Amazon\Data\Order  $oOrder
     * @param  \Amazon\Data\Buyer  $oBuyer
     *
     * @return string Tracking number must be returned
     * @throws Exception
     */
    public function ship(\Amazon\Data\Order $oOrder, \Amazon\Data\Buyer $oBuyer);
}
