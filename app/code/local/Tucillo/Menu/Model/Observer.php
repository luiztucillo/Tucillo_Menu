<?php

class Tucillo_Menu_Model_Observer
{
    public function addHandle(Varien_Event_Observer $observer)
    {
        if (Mage::getStoreConfig('tucillo_menu/basic_info/enabled')) {
            $observer->getEvent()->getLayout()->getUpdate()->addHandle('tucillo_menu');
        }
    }
}