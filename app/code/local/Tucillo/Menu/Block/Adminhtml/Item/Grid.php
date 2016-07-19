<?php

class Tucillo_Menu_Block_Adminhtml_Item_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('id');
        $this->setDefaultSort('id');
        $this->setDefaultDir('ASC');
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('menu/item')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
    
    protected function _prepareColumns()
    {
        $this->addColumn(
            'id',
            array(
                'header'=> $this->__('ID Item'),
                'type'  => 'number',
                'index' => 'id',
            )
        );

        $this->addColumn(
            'parent_menu',
            array(
                'header'    => Mage::helper('menu')->__('Menu'),
                'align'     => 'left',
                'width'     => '100px',
                'index'     => 'parent_menu',
                'type'      => 'options',
                'options'   => Mage::helper('menu/menu')->getOptionArray()
            )
        );

        $this->addColumn(
            'title_type',
            array(
                'header' => Mage::helper('menu')->__('Title Type'),
                'align' => 'left',
                'width' => '100px',
                'index' => 'title_type',
                'type'      => 'options',
                'options'   => Mage::helper('menu/item')->getTitleTypes()
            )
        );
        
        $this->addColumn(
            'title_text',
            array(
                'header'    => Mage::helper('menu')->__('Title Text'),
                'align'     => 'left',
                'width'     => '100px',
                'index'     => 'id',
                'renderer'  => 'Tucillo_Menu_Block_Adminhtml_Renderer_Item_Title'
            )
        );

        $this->addColumn(
            'parent',
            array(
                'header'    => Mage::helper('menu')->__('Parent'),
                'align'     => 'left',
                'width'     => '100px',
                'index'     => 'parent_item',
                'type'      => 'options',
                'options'   => Mage::helper('menu/item')->getOptionArray()
            )
        );
        
        $this->addColumn(
            'link_type',
            array(
                'header' => Mage::helper('menu')->__('Link Type'),
                'align' => 'left',
                'width' => '100px',
                'index' => 'link_type',
                'type'      => 'options',
                'options'   => Mage::helper('menu/item')->getLinkTypes()
            )
        );
        
        $this->addColumn(
            'link_url',
            array(
                'header' => Mage::helper('menu')->__('Link URL'),
                'align' => 'left',
                'width' => '100px',
                'index' => 'link_url',
                'renderer'  => 'Tucillo_Menu_Block_Adminhtml_Renderer_Item_Url'
            )
        );
        
        return parent::_prepareColumns();
    }
    
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}