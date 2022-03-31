<?php

namespace pi\ratepay\Core;

use OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Application\Model\User;

/**
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * @category  PayIntelligent
 * @package   PayIntelligent_RatePAY
 * @copyright (C) 2011 PayIntelligent GmbH  <http://www.payintelligent.de/>
 * @license	http://www.gnu.org/licenses/  GNU General Public License 3
 */

/**
 * Data provider for backend operation.
 * @extends RequestAbstract
 */
class RequestDataBackend extends RequestAbstract
{
    /**
     * Order Object
     * @var Order
     */
    private $_order;

    /**
     * Class constructor
     * @param Order $order
     */
    public function __construct($order)
    {
        $this->_order = $order;
    }

    /**
     * Generate oxuser from order user.
     * @inheritdoc
     * @return User
     */
    public function getUser()
    {
        $ratepayOrder = oxNew(Orders::class);
        $ratepayOrder->loadByOrderNumber($this->_order->getId());
        $orderUser = $this->_order->getOrderUser();
        $orderUser->oxuser__oxbirthdate = clone $ratepayOrder->pi_ratepay_orders__userbirthdate;

        return $orderUser;
    }
}
