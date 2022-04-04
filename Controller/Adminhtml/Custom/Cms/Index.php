<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Jack\Cms\Controller\Adminhtml\Custom\Cms;

use Jack\Cms\Controller\Adminhtml\Custom\AbstractAction;
use Jack\Cms\Model\Cms;

/**
 * Display Variables list page
 * @api
 * @since 100.0.2
 */
class Index extends AbstractAction
{
    private $cms;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\View\LayoutFactory $layoutFactory,
        \Jack\Cms\Model\Cms $cms
    ) {
        parent::__construct($context, $coreRegistry, $resultForwardFactory, $resultJsonFactory, $resultPageFactory, $layoutFactory);
        $this->cms = $cms;



    }

    /**
     * Index Action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->createPage();
        $resultPage->getConfig()->getTitle()->prepend(__('联蔚CMS'));
        return $resultPage;
    }
}
