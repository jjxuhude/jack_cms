<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Jack\Cms\Controller\Adminhtml\Custom\Cms;

use Jack\Cms\Controller\Adminhtml\Custom\AbstractAction;

/**
 * Create new variable form
 *
 * @api
 * @since 100.0.2
 */
class NewAction extends AbstractAction
{
    /**
     * New Action (forward to edit action)
     *
     * @return \Magento\Backend\Model\View\Result\Forward
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Forward $resultForward */
        $resultForward = $this->resultForwardFactory->create();
        return $resultForward->forward('edit');
    }
}
