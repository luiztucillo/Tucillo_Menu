<?php
class Tucillo_Menu_Block_Adminhtml_Item_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'menu';
        $this->_controller = 'adminhtml_item';
        $this->_mode = 'edit';
    }
    
    public function getHeaderText()
    {
        return Mage::helper('menu')->__('Edit Item');
    }
}