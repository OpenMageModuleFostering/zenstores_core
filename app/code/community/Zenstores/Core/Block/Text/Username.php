<?php
/**
 * Zenstores API Username Text Block
 *
 * @category    Zenstores
 * @package     Zenstores_Core
 * @copyright   Copyright (c) 2015 Mechfeed Ltd (Zenstores) (https://www.zenstores.com/)
 */
class Zenstores_Core_Block_Text_Username extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    protected function _getElementHtml($element)
    {
        $element->setReadonly(true);

        /** @var Zenstores_Core_Helper_Data $zenstoresHelper */
        $zenstoresHelper = Mage::helper('zenstores_core');

        $apiUser = $zenstoresHelper->getApiUser();

        $element->setValue($apiUser->getUsername());

        return parent::_getElementHtml($element);
    }
}
