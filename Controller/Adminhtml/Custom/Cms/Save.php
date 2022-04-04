<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Jack\Cms\Controller\Adminhtml\Custom\Cms;

use Jack\Cms\Controller\Adminhtml\Custom\AbstractAction;

/**
 * Save variable POST controller
 *
 * @api
 * @since 100.0.2
 */
class Save extends AbstractAction
{
    /**
     * Save Action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $model = $this->_initModel();
        $data = $this->getRequest()->getPost('cms');
        $back = $this->getRequest()->getParam('back', false);
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $data['page_id'] = $model->getId();
            $model->setData($data);
            try {
                $model->save();
                $this->messageManager->addSuccess(__('You saved the custom cms.'));
                if ($back) {
                    $resultRedirect->setPath(
                        'adminhtml/*/edit',
                        ['_current' => true, 'id' => $model->getId()]
                    );
                } else {
                    $resultRedirect->setPath('adminhtml/*/');
                }
                return $resultRedirect;
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('adminhtml/*/edit', ['_current' => true]);
            }
        }
        return $resultRedirect->setPath('adminhtml/*/');
    }
}
