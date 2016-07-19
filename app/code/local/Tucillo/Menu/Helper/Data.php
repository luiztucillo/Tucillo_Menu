<?php

class Tucillo_Menu_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function checkCustomerGroup($item)
    {
        $customerGroup = $item->getCustomerGroup();
        if (empty($customerGroup)) {
            return true;
        }

        $customerGroup = unserialize($customerGroup);
        if (empty($customerGroup)) {
            return true;
        }

        $currentCustomerGroup = Mage::helper('customer')->isLoggedIn() ?
            Mage::helper('customer')->getCustomer()->getGroupId()
            : 0;

        if (!in_array($currentCustomerGroup, $customerGroup)) {
            return false;
        }

        return true;
    }
}