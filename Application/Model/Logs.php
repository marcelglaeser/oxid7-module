<?php

namespace pi\ratepay\Application\Model;

use OxidEsales\Eshop\Core\Model\BaseModel;

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
 * Model class for pi_ratepay_logs table
 * @extends BaseModel
 */
class Logs extends BaseModel
{

    /**
     * Current class name
     *
     * @var string
     */
    protected $_sClassName = Logs::class;

    /**
     * Class constructor
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->init('pi_ratepay_logs');
    }

    protected function _getFormattedXml($oField)
    {
        $oSimpleXml = simplexml_load_string($oField->rawValue);
        if ($oSimpleXml === false) {
            return $oField->value;
        }

        $dom = dom_import_simplexml($oSimpleXml);
        if (!$dom) {
            return $oField->value;
        }

        $dom = $dom->ownerDocument;
        $dom->formatOutput = true;
        return $dom->saveXML();
    }

    public function getFormattedRequest()
    {
        return htmlentities($this->_getFormattedXml($this->pi_ratepay_logs__request));
    }

    public function getFormattedResponse()
    {
        return htmlentities($this->_getFormattedXml($this->pi_ratepay_logs__response));
    }

}
