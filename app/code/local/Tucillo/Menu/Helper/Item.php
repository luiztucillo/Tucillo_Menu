<?php

class Tucillo_Menu_Helper_Item extends Mage_Core_Helper_Abstract
{
    public function getOptionArray($firstEmpty = false)
    {
        $return = $firstEmpty ? array('' => '') : array();

        $model = Mage::getModel('menu/item')->getCollection();

        foreach ($model as $item) {
            $return[$item->getId()] = $item->getTitle();
        }

        return $return;
    }

    public function getTitleTypes($firstEmpty = false)
    {
        $return = $firstEmpty ? array('' => '') : array();
        
        $return[1] = Mage::helper('menu')->__('Custom');
        $return[2] = Mage::helper('menu')->__('Item Title');
        
        return $return;
    }
    
    public function getLinkTypes($firstEmpty = false)
    {
        $return = $firstEmpty ? array('' => '') : array();
        
        $return[1] = Mage::helper('menu')->__('Custom');
        $return[2] = Mage::helper('menu')->__('CMS');
        $return[3] = Mage::helper('menu')->__('Category');

        return $return;
    }
    
    public function getCmsPages($firstEmpty = false)
    {
        $return = $firstEmpty ? array('' => '') : array();

        $pages = Mage::getModel('cms/page')->getCollection();
        
        foreach ($pages as $page) {
            $return[$page->getId()] = $page->getTitle();
        }
        
        return $return;
    }
    
    public function getHierarchyArray($parentId = null, $firstEmpty = false, $level = 0)
    {
        $return = $firstEmpty ? array('' => '') : array();
        
        $filter = empty($parentId) ? array('null' => true) : $parentId;
        
        $items = Mage::getModel('menu/item')->getCollection()
            ->addFieldToFilter('parent_item', $filter);
        
        foreach ($items as $item) {
            $return[$item->getId()] = $this->getPreCharacters($level) . $item->getTitle();
            $tmp = $this->getHierarchyArray($item->getId(), false, $level + 3);
            foreach ($tmp as $k => $v) {
                $return[$k] = $v;
            }
        }
        
        return $return;
    }
    
    public function getPreCharacters($qtd)
    {
        $fill = '';
        for ($i = 0; $i < $qtd; $i ++) {
            $fill .= '-';
        }
        
        return $fill;
    }
}