<?php
class Tucillo_Menu_Block_Adminhtml_Renderer_Item_Title
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $id = $row->getData($this->getColumn()->getIndex());

        $model = Mage::getModel('menu/item')->load($id);
        return $model->getTitle();
    }
}