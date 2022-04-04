<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Jack\Cms\Controller\Adminhtml\Custom\Cms;

use Jack\Cms\Controller\Adminhtml\Custom\AbstractAction;

/**
 * Display Variables edit form page
 *
 * @api
 * @since 100.0.2
 */
class Edit extends AbstractAction
{
    /**
     * Edit Action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $model = $this->_initModel("page_id");

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->createPage();
        $resultPage->setActiveMenu('Jack_Cms::custom_cms');
        $resultPage->getConfig()->getTitle()->prepend(__('Custom Cms'));
        $resultPage->getConfig()->getTitle()->prepend(
            $model->getId() ? $model->getTitle() : __('New Custom Cms')
        );
        $resultPage->addBreadcrumb(__('Custom Cms'), __('Manage Cms'));
        return $resultPage;
    }
}
