<?php

class Tucillo_Menu_Helper_Menu extends Mage_Core_Helper_Abstract
{
    public function getOptionArray($firstEmpty = false)
    {
        $return = $firstEmpty ? array('' => '') : array();
        
        $model = Mage::getModel('menu/menu')->getCollection();
        
        foreach ($model as $menu) {
            $return[$menu->getId()] = $menu->getName();
        }
        
        return $return;
    }


}