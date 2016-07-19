<?php

class Tucillo_Menu_Adminhtml_MenuController extends Mage_Adminhtml_Controller_Action
{
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('tucillo_menu/menumod');
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
        
        $model = Mage::getModel('menu/menu')
            ->setData($data);
        
        if (!$this->_validatePosition($data)) {
            Mage::getSingleton('adminhtml/session')
                ->addError($this->__('The position "'.$data['position'].'" is already in use'));
            return $this->_redirect('*/*/');
        }
        
        $model->save();
        
        Mage::getSingleton('adminhtml/session')
            ->addSuccess($this->__("Menu saved!"));
        
        return $this->_redirect('*/*/');
    }
    
    public function deleteAction()
    {
        $id = $this->getRequest()->getParam('id');
        Mage::getModel('menu/menu')->load($id)->delete();
        
        Mage::getSingleton('adminhtml/session')
            ->addSuccess($this->__("Menu deleted!"));
        
        return $this->_redirect('*/*/');
    }
    
    private function _validatePosition($data)
    {
        $model = Mage::getModel('menu/menu')->getCollection()
            ->addFieldToFilter('position', $data['position'])
            ->addFieldToFilter('id', array('neq' => $data['id']));
        
        return !$model->getSize();
    }
}