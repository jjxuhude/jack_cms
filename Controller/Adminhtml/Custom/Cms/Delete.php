<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Jack\Cms\Controller\Adminhtml\Custom\Cms;

use Jack\Cms\Controller\Adminhtml\Custom\AbstractAction;

class Delete extends AbstractAction
{
    /**
     * Delete Action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $model = $this->_initModel();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($model->getId()) {
            try {
                $model->delete();
                $this->messageManager->addSuccess(__('You deleted the custom cms.'));
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('adminhtml/*/edit', ['_current' => true]);
            }
        }
        return $resultRedirect->setPath('adminhtml/*/');
    }
}
