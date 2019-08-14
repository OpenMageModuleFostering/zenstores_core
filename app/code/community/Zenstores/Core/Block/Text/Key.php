<?php
/**
 * Zenstores API Key Text Block
 *
 * @category    Zenstores
 * @package     Zenstores_Core
 * @copyright   Copyright (c) 2015 Mechfeed Ltd (Zenstores) (https://www.zenstores.com/)
 */
class Zenstores_Core_Block_Text_Key extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    protected function _getElementHtml($element)
    {
        $element->setReadonly(true);

        $apiKey      = Mage::getStoreConfig('zenstores_core/config/apikey');
        $keyModified = Mage::getStoreConfig('zenstores_core/config/apikey_modified');

        $element->setValue($apiKey);

        /** @var Zenstores_Core_Helper_Data $zenstoresHelper */
        $zenstoresHelper = Mage::helper('zenstores_core');

        $apiUser = $zenstoresHelper->getApiUser();

        // Check whether a user has not changed API user directly from Magento interface
        if (strtotime($apiUser->getModified()) > strtotime($keyModified)) {
            $element->setComment('API Key is not guaranteed to be correct');
        }

        return parent::_getElementHtml($element);
    }
}
