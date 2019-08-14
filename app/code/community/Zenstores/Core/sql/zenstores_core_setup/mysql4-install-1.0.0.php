<?php
/**
 * Zenstores Setup for Magento <= 1.5
 *
 * @category    Zenstores
 * @package     Zenstores_Core
 * @copyright   Copyright (c) 2015 Mechfeed Ltd (Zenstores) (https://www.zenstores.com/)
 */

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

/** @var Zenstores_Core_Helper_Data $zenstoresHelper */
$zenstoresHelper = Mage::helper('zenstores_core');

$zenstoresHelper->createApiUser();

$installer->endSetup();
