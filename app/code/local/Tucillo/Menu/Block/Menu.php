<?php

class Tucillo_Menu_Block_Menu extends Mage_Core_Block_Template
{
    private $_position;
    private $_html = '';
    
    public function setPosition($position)
    {
        if (empty($this->_position)) {
            $this->_position = $position;
        }
        
        return $this;
    }
    
    public function getPosition()
    {
        return $this->_position;
    }
    
    public function getItems($parentId = null)
    {
        if (empty($this->_position)) {
            return false;
        }

        $filter = empty($parentId) ? array('null' => true) : $parentId;
        
        $items = Mage::getModel('menu/item')
            ->getCollection()
            ->addFieldToFilter('parent_menu', $this->getPositionId())
            ->addFieldToFilter('parent_item', $filter)
            ->setOrder('sort_order', 'ASC');

        foreach ($items as $key => $item) {
            if (!Mage::helper('menu')->checkCustomerGroup($item)) {
                $items->removeItemByKey($key);
            }
        }

        return $items;
    }

    public function renderMenu()
    {
        foreach ($this->getItems() as $item) {
            $this->_html .= $this->getLayout()->createBlock('menu/renderer', 'tucillo_menu')
                ->setItem($item)
                ->toHtml();
        }

        return $this->_html;
    }

    private function getPositionId()
    {
        $menu = Mage::getModel('menu/menu')
            ->load($this->_position, 'position');
        
        return $menu->getId();
    }
}