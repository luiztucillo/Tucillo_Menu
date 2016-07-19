<?php

class Tucillo_Menu_Block_Adminhtml_Menu_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(
            array(
                'id'        => 'edit_form',
                'action'    => $this->getUrl(
                    '*/*/save',
                    array('id' => $this->getRequest()->getParam('id'))
                ),
                'method'    => 'post'
            )
        );
        
        $fieldset = $form->addFieldset(
            'main',
            array(
                'legend' => Mage::helper('menu')->__('Basic Information')
            )
        );

        $fieldset->addField(
            'name',
            'text',
            array(
                'label' => Mage::helper('menu')->__('Name'),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'name',
            )
        );
        
        $fieldset->addField(
            'position',
            'text',
            array(
                'label' => Mage::helper('menu')->__('Position'),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'position',
            )
        );
        
        $id = $this->getRequest()->getParam('id');
        if (!empty($id)) {
            $form->setValues($this->_getModelData($id));
        }
        
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
    
    private function _getModelData($id)
    {
        return Mage::getModel('menu/menu')->load($id)->getData();
    }
}