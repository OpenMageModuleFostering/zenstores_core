<?php
/**
 * Zenstores Controller
 *
 * @category    Zenstores
 * @package     Zenstores_Core
 * @copyright   Copyright (c) 2015 Mechfeed Ltd (Zenstores) (https://www.zenstores.com/)
 */
class Zenstores_Core_Adminhtml_ZenstoresController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        /** @var Zenstores_Core_Helper_Data $zenstoresHelper */
        $zenstoresHelper = Mage::helper('zenstores_core');

        $zenstoresHelper->generateApiKey();

        // Redirect back to Zenstores extension configuration
        Mage::app()->getResponse()->setRedirect(
            Mage::helper('adminhtml')->getUrl('adminhtml/system_config/edit/section/zenstores_core')
        );
    }
}
