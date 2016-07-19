<?php

class Tucillo_Menu_Adminhtml_ItemController extends Mage_Adminhtml_Controller_Action
{
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('tucillo_menu/item');
    }

    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }
    public function editAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
    
    public function saveAction()
    {
        $data = $this->getRequest()->getPost();
        $data['id'] = $this->getRequest()->getParam('id');

        switch ($data['link_type']) {
            case 1  :
                $data['category_id']    = null;
                $data['cms_page']       = null;
                break;
            case 2  :
                $data['category_id']    = null;
                $data['link_url']       = null;
                break;
            case 3  :
                $data['cms_page']       = null;
                $data['link_url']       = null;
                break;
        }

        if (empty($data['parent_item'])) {
            $data['parent_item'] = null;
        }

        if (isset($data['customer_group'])) {
            $data['customer_group'] = serialize($data['customer_group']);
        } else {
            $data['customer_group'] = serialize(array());
        }

        Mage::getModel('menu/item')
            ->setData($data)
            ->save();
        
        Mage::getSingleton('adminhtml/session')
            ->addSuccess($this->__("Item saved!"));
        
        return $this->_redirect('*/*/');
    }
    
    public function deleteAction()
    {
        $id = $this->getRequest()->getParam('id');
        Mage::getModel('menu/item')->load($id)->delete();
        
        Mage::getSingleton('adminhtml/session')
            ->addSuccess($this->__("Item deleted!"));
        
        return $this->_redirect('*/*/');
    }
}