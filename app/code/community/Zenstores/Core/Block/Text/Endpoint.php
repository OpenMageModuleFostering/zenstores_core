<?php
/**
 * Zenstores API Endpoint Text Block
 *
 * @category    Zenstores
 * @package     Zenstores_Core
 * @copyright   Copyright (c) 2015 Mechfeed Ltd (Zenstores) (https://www.zenstores.com/)
 */
class Zenstores_Core_Block_Text_Endpoint extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    protected function _getElementHtml($element)
    {
        $element->setReadonly(true);

        // SOAP API Endpoint
        $element->setValue(Mage::getUrl('api/v2_soap', array('_query' => array('wsdl' => 1))));

        return parent::_getElementHtml($element);
    }
}
