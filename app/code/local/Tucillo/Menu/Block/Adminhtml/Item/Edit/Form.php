<?php

class Tucillo_Menu_Block_Adminhtml_Item_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $id = $this->getRequest()->getParam('id');
        $data = empty($id) ? null : $this->_getModelData($id);
        
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

        $fieldset->addField('parent_menu', 'select', array(
            'label'     => Mage::helper('menu')->__('Parent Menu'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'parent_menu',
            'options'   => Mage::helper('menu/menu')->getOptionArray(true)
        ));
        
        $fieldset->addField('title_type', 'select', array(
            'label'     => Mage::helper('menu')->__('Title Type'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'title_type',
            'options'   => Mage::helper('menu/item')->getTitleTypes(true),
        ));
        
        $titleDisabled = isset($data['title_type']) && $data['title_type'] == 1
            ? false : true;
        
        $fieldset->addField(
            'title_text',
            'text',
            array(
                'label' => Mage::helper('menu')->__('Title Text'),
                'required' => true,
                'name' => 'title_text',
                'disabled'  => $titleDisabled
            )
        );
        
        $fieldset->addField('link_type', 'select', array(
            'label'     => Mage::helper('menu')->__('Link Type'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'link_type',
            'options'   => Mage::helper('menu/item')->getLinkTypes(true)
        ));
        
        $linkDisabled = isset($data['link_type']) && $data['link_type'] == 1
            ? false : true;
        
        $fieldset->addField(
            'link_url',
            'text',
            array(
                'label'     => Mage::helper('menu')->__('Link URL'),
                'name'      => 'link_url',
                'disabled'  => $linkDisabled
            )
        );
        
        $cmsDisabled = isset($data['link_type']) && $data['link_type'] != 1
            ? false : true;
        
        $fieldset->addField(
            'cms_page',
            'select',
            array(
                'label'     => Mage::helper('menu')->__('CMS Page'),
                'name'      => 'cms_page',
                'options'   => Mage::helper('menu/item')->getCmsPages(true),
                'disabled'  => $cmsDisabled
            )
        );

        $fieldset->addField(
            'category_id',
            'text',
            array(
                'label'     => Mage::helper('menu')->__('Category ID'),
                'name'      => 'category_id',
            )
        );
        
        $fieldset->addField(
            'sort_order',
            'text',
            array(
                'label' => Mage::helper('menu')->__('Sort Order'),
                'class' => 'required-entry validate-number',
                'required' => true,
                'name' => 'sort_order',
            )
        );
        
        $fieldset->addField(
            'target',
            'text',
            array(
                'label' => Mage::helper('menu')->__('Target'),
                'name' => 'target',
            )
        );
        
        $fieldset->addField(
            'parent_item',
            'select',
            array(
                'label'     => Mage::helper('menu')->__('Parent'),
                'name'      => 'parent_item',
                'options'   => Mage::helper('menu/item')->getHierarchyArray(null, true)
            )
        );

        $fieldset->addField('customer_group', 'multiselect', array(
            'label'     => Mage::helper('menu')->__('Customer Group'),
            'name'      => 'customer_group',
            'values'    => Mage::getModel('customer/group')->getCollection()->toOptionArray()
        ));
        
        if (!empty($data)) {
            if (isset($data['customer_group']) && !empty($data['customer_group'])) {
                $data['customer_group'] = unserialize($data['customer_group']);
            }
            $form->setValues($data);
        }
        
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
    
    private function _getModelData($id)
    {
        return Mage::getModel('menu/item')->load($id)->getData();
    }
}