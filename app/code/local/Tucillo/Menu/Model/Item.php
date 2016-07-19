<?php

class Tucillo_Menu_Model_Item extends Mage_Core_Model_Abstract
{
    private $_cms;
    private $_category;
    
    protected function _construct()
    {
        $this->_init('menu/item');
    }
    
    public function getTitle()
    {
        switch ($this->getTitleType()) {
            case 1 :
                return $this->getTitleText();
                break;
            case 2 :
                return $this->getLinkType() == 2 ? $this->getCms()->getTitle() : $this->getCategory()->getName();
        }

        return $this->getTitleText();
    }
    
    public function getUrl()
    {
        switch ($this->getLinkType()) {
            case 1 :
                $url = $this->getLinkUrl();
                return empty($url) ? 'javascript: return false;' : $url;
                break;
            case 2 :
                return Mage::getUrl($this->getCms()->getIdentifier());
                break;
            case 3 :
                return $this->getCategory()->getUrl();
        }

        return 'javascript: return false;';
    }

    public function getCms()
    {
        if ($this->getLinkType() != 2) {
            return false;
        }

        if (empty($this->_cms)) {
            $this->_setCms();
        }


        return $this->_cms;
    }

    private function _setCms()
    {
        $cmsPageId = $this->getCmsPage();
        if (empty($cmsPageId)) {
            return false;
        }
        
        $this->_cms = Mage::getModel('cms/page')->load($cmsPageId);
    }

    public function getCategory()
    {
        if ($this->getLinkType() != 3) {
            return Mage::getModel('catalog/category');
        }

        if (empty($this->_category)) {
            $this->_setCategory();
        }

        return $this->_category;
    }

    private function _setCategory()
    {
        $this->_category = Mage::getModel('catalog/category');

        $categoryId = $this->getCategoryId();

        if (empty($categoryId)) {
            return false;
        }

        $this->_category->load($categoryId);
    }
}