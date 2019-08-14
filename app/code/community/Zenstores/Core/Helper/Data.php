<?php
/**
 * Zenstores
 *
 * @category    Zenstores
 * @package     Zenstores_Core
 * @copyright   Copyright (c) 2015 Mechfeed Ltd (Zenstores) (https://www.zenstores.com/)
 */
class Zenstores_Core_Helper_Data extends Mage_Payment_Helper_Data
{
    /**
     * Get zenstores user
     *
     * @return Mage_Api_Model_User
     */
    public function getApiUser()
    {
        /** @var Mage_Api_Model_User $apiUser */
        $apiUser = Mage::getModel('api/user');

        $apiUser->loadByUsername('zenstores');

        return $apiUser;
    }

    /**
     * Generate new API Key for zenstores user
     *
     * @return string
     */
    public function generateApiKey()
    {
        /** @var Mage_Core_Helper_Data $coreHelper */
        $coreHelper = Mage::helper('core');

        $apiKey = $coreHelper->getRandomString(40);

        /** @var Mage_Core_Model_Config $coreConfig */
        $coreConfig = Mage::getModel('core/config');

        $apiUser = $this->getApiUser();

        if ($apiUser->getId()) {
            $apiUser->setApiKey($apiKey)->save();
        }

        $modifiedDateTime = Mage::getModel('core/date')->gmtDate();

        $coreConfig->saveConfig('zenstores_core/config/apikey', $apiKey);
        $coreConfig->saveConfig('zenstores_core/config/apikey_modified', $modifiedDateTime);

        // Clean config cache
        Mage::app()->getCacheInstance()->cleanType('config');

        return $apiKey;
    }

    /**
     * Create API Role and related rules
     *
     * @return Mage_Api_Model_Role
     * @throws Exception
     */
    protected function createApiRole()
    {
        /** @var Mage_Api_Model_Role $apiRole */
        $apiRole = Mage::getModel('api/role');

        $apiRole->setRoleName('Zenstores API')
            ->setParentId(0)
            ->setRoleType('G')
            ->save();

        /** @var Mage_Api_Model_Rules $apiRules */
        $apiRules = Mage::getModel('api/rules');

        $apiRules->setRoleId($apiRole->getId())
            ->setResources(array(
                'customer',
                'customer/create',
                'customer/update',
                'customer/delete',
                'customer/info',
                'customer/address',
                'customer/address/create',
                'customer/address/update',
                'customer/address/delete',
                'customer/address/info',
                'sales',
                'sales/order',
                'sales/order/change',
                'sales/order/info',
                'sales/order/shipment',
                'sales/order/shipment/create',
                'sales/order/shipment/comment',
                'sales/order/shipment/track',
                'sales/order/shipment/info',
                'sales/order/shipment/send',
                'sales/order/invoice',
                'sales/order/invoice/create',
                'sales/order/invoice/comment',
                'sales/order/invoice/capture',
                'sales/order/invoice/void',
                'sales/order/invoice/cancel',
                'sales/order/invoice/info',
                'sales/order/creditmemo',
                'sales/order/creditmemo/create',
                'sales/order/creditmemo/comment',
                'sales/order/creditmemo/cancel',
                'sales/order/creditmemo/info',
                'sales/order/creditmemo/list',
            ))
            ->saveRel();

        return $apiRole;
    }

    /**
     * Create API User
     *
     * @return Mage_Api_Model_User
     */
    public function createApiUser()
    {
        $apiUser = $this->getApiUser();

        if ($apiUser->getId()) {
            return $apiUser;
        }

        $apiRole = $this->createApiRole();

        $apiUser->setData(array(
            'username'  => 'zenstores',
            'firstname' => 'zenstores',
            'lastname'  => 'zenstores',
            'email'     => 'support@zenstores.com',
            'is_active' => 1,
        ));

        $apiUser->save();

        $apiUser->setRoleIds(array($apiRole->getId()))
            ->setRoleUserId($apiUser->getUserId())
            ->saveRelations();

        $this->generateApiKey();

        return $apiUser;
    }
}
