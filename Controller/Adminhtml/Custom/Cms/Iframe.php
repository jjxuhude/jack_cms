<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Jack\Cms\Controller\Adminhtml\Custom\Cms;

use Jack\Cms\Controller\Adminhtml\Custom\AbstractAction;
use Jack\Cms\Model\Cms;
use Magento\Framework\Controller\ResultFactory;

/**
 * Display Variables list page
 * @api
 * @since 100.0.2
 */
class Iframe extends AbstractAction
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
        ini_set("display_errors",1);
        ini_set("error_reporting",E_ALL);
        ini_set("log_errors",1);
        //        ini_set("error_log","/data/www/docs/ebay_ers/runtime/log");
        ini_set("max_execution_time",3000);
        ini_set("memory_limit",'1024M');
        $resultRaw = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        return $resultRaw;
    }
}
