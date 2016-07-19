<?php
class Tucillo_Menu_Block_Adminhtml_Renderer_Item_Url
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        if ($row->getData('link_type') == 1) {
            return $row->getData($this->getColumn()->getIndex());
        }

        $id = $row->getData('cms_page');
        if (empty($id)) {
            return '';
        }

        return '/' . Mage::getModel('cms/page')->load($id)->getIdentifier();
    }
}