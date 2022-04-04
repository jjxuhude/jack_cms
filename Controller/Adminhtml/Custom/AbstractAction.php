<?php
/**
 * Created by PhpStorm.
 * User: Jack.Xu1
 * Date: 2022/2/18
 * Time: 13:00
 */

namespace Jack\Cms\Controller\Adminhtml\Custom;
use Magento\Backend\App\Action;

abstract class AbstractAction extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Jack_Cms::custom_cms';

    const CURRENT_MODEL = \Jack\Cms\Model\Cms::class;

    const ACTIVE_MENU= 'Jack_Cms::custom_cms';

    const BREADCRUMB= '联蔚Cms';

    const REREGISTRY_KEY="current_cms";

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * @var \Magento\Backend\Model\View\Result\ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @var \Magento\Framework\View\LayoutFactory
     */
    protected $layoutFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\View\LayoutFactory $layoutFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\View\LayoutFactory $layoutFactory
    ) {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
        $this->resultForwardFactory = $resultForwardFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->layoutFactory = $layoutFactory;
    }

    /**
     * Initialize Layout and set breadcrumbs
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function createPage()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu(self::ACTIVE_MENU)
            ->addBreadcrumb(__(self::BREADCRUMB), __(self::BREADCRUMB));
        return $resultPage;
    }

    /**
     * Initialize Cms object
     *
     * @return \Magento\Cms\Model\Variable
     */
    protected function _initModel($pk="id")
    {
        $id = $this->getRequest()->getParam($pk, null);
        /* @var $variable \Magento\Variable\Model\Variable */
        $model = $this->_objectManager->create(self::CURRENT_MODEL);
        if ($id) {
            $model->load($id);
        }
        $this->_coreRegistry->register(self::REREGISTRY_KEY, $model);
        return $model;
    }
}