<?php

class Tucillo_Menu_Block_Adminhtml_Item extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct() 
    {
        parent::__construct();
        $this->_controller = 'adminhtml_item';
        $this->_blockGroup = 'menu';
        $this->_headerText = Mage::helper('menu')->__('Item');
        $this->_backButtonLabel = $this->__('Back');
    }
}