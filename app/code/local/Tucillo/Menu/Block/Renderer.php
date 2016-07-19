<?php

/**
 * Created by PhpStorm.
 * User: luiztucillo
 * Date: 07/01/16
 * Time: 17:30
 */
class Tucillo_Menu_Block_Renderer extends Mage_Core_Block_Template
{
    private $_level     = 0;
    private $_childs    = null;
    private $_html      = '';

    protected function _construct()
    {
        $this->setTemplate('tucillo/menu/renderer.phtml');
    }

    public function setLevel($level)
    {
        $this->_level = $level;
        return $this;
    }

    public function getLevel()
    {
        return $this->_level;
    }

    public function hasChildMenu()
    {
        return $this->getChilds()->count();
    }

    public function renderChilds()
    {
        $nextLevel = $this->getLevel();
        $nextLevel ++;
        foreach ($this->getChilds() as $item) {
            $this->_html .= $this->getLayout()->createBlock('menu/renderer')
                ->setItem($item)
                ->setLevel($nextLevel)
                ->toHtml();
        }

        return $this->_html;
    }

    public function hasBanner()
    {
        if (!$this->getItem()->getCategory()) {
            return false;
        }

        return $this->getItem()->getCategory()->getBannerImage() ? 'true' : false;
    }

    public function getBannerUrl()
    {
        if (!$this->hasBanner()) {
            return false;
        }

        return $this->getItem()->getCategory()->getBannerUrl();
    }

    public function getBannerImage()
    {
        if (!$this->hasBanner()) {
            return false;
        }

        $image = $this->getItem()->getCategory()->getBannerImage();

        return Mage::getBaseUrl('media') . '/catalog/category/' . $image;
    }

    private function getChilds()
    {
        if (is_null($this->_childs)) {
            $this->_childs = Mage::getModel('menu/item')->getCollection()
                ->addFieldToFilter('parent_item', $this->getItem()->getid());

            foreach ($this->_childs as $key => $item) {
                if (!Mage::helper('menu')->checkCustomerGroup($item)) {
                    $this->_childs->removeItemByKey($key);
                }
            }
        }

        return $this->_childs;
    }
}
