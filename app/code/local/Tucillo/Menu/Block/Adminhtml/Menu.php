<?php

class Tucillo_Menu_Block_Adminhtml_Menu extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct() 
    {
        parent::__construct();
        $this->_controller = 'adminhtml_menu';
        $this->_blockGroup = 'menu';
        $this->_headerText = Mage::helper('menu')->__('Menu');
        $this->_backButtonLabel = $this->__('Back');
    }
}