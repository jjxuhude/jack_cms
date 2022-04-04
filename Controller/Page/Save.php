<?php
/**
 * Created by PhpStorm.
 * User: Custom.Xu1
 * Date: 2021/11/14
 * Time: 15:22
 */

namespace Jack\Cms\Controller\Page;

use Jack\Cms\Model\Cms;
use Magento\Cms\Helper\Page as PageHelper;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\Controller\ResultInterface;
class Save extends \Magento\Cms\Controller\Page\View
{

    /**
     * @var ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var PageHelper
     */
    private $pageHelper;

    /**
     * @param Context $context
     * @param RequestInterface $request
     * @param PageHelper $pageHelper
     * @param ForwardFactory $resultForwardFactory
     */
    public function __construct(Context $context, RequestInterface $request, PageHelper $pageHelper, ForwardFactory $resultForwardFactory)
    {
        parent::__construct($context, $request, $pageHelper, $resultForwardFactory);
        $this->pageHelper=$pageHelper;
        $this->request=$request;
    }



    /**
     * View CMS page action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $data= $this->getRequest()->getParams();
        $id = $this->getRequest()->getParam("page_id");
        $model=$this->_objectManager->create(Cms::class);
        $data=[
            "title"=>$this->getRequest()->getParam("title"),
            "content"=>json_encode($this->getRequest()->getParam("content"))
        ];
        if($id){
            $model->load($id);
            $data['page_id']=$id;
        }

        $model->setData($data)->save();
        $response=[
            'status' => true,
            'data'=>$model->toArray()
        ];
        return $this->resultFactory->create('json')->setData($response);
    }




}