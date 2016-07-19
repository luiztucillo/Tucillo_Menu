<?php

class Tucillo_Menu_Block_Adminhtml_Menu_Grid extends Mage_Adminhtml_Block_Widget_Grid
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
        $collection = Mage::getModel('menu/menu')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
    
    protected function _prepareColumns()
    {
        $this->addColumn(
            'id',
            array(
                'header'=> 'ID Menu',
                'type'  => 'number',
                'index' => 'id',
            )
        );

        $this->addColumn(
            'name',
            array(
                'header' => Mage::helper('menu')->__('Name'),
                'align' => 'left',
                'width' => '100px',
                'index' => 'name',
            )
        );

        $this->addColumn(
            'position',
            array(
                'header' => Mage::helper('menu')->__('Position'),
                'align' => 'left',
                'width' => '100px',
                'index' => 'position',
            )
        );
        
        return parent::_prepareColumns();
    }
    
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}