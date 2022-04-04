<?php
/**
 * Created by PhpStorm.
 * User: Custom.Xu1
 * Date: 2021/11/14
 * Time: 15:22
 */

namespace Jack\Cms\Controller\Page;

use Magento\Cms\Helper\Page as PageHelper;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\Controller\ResultInterface;
class Upload extends \Magento\Cms\Controller\Page\View
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
        $file=$this->getRequest()->getFiles("file");
        $ext = pathinfo($file['name']);
        $string = uniqid();
        $dir = substr($string, -1);

        $mediaDir = realpath('media');
        if(!is_dir($mediaDir.'/upload')){
            mkdir($mediaDir.'/upload', 0777, true);
        }
        $new = $mediaDir.'/upload/' . $dir . '/' . $string . '.' . $ext['extension'];
        $filePath = '/media/upload/' . $dir . '/' . $string . '.' . $ext['extension'];

        if (!is_dir($mediaDir.'/upload/'. $dir)) {
            mkdir($mediaDir.'/upload/'. $dir, 0777, true);
        }
        move_uploaded_file($file['tmp_name'],  $new);
        $response=[
            'status' => true,
            'file' => $filePath,
            'info' => $file
        ];
        return $this->resultFactory->create('json')->setData($response);
    }

    public function ajaxUpload(){
        $file=$_FILES['file'];
        if(isset($file['tmp_name'])){
            if($file['tmp_name']){
                $result= $this->curl('shopImgUpload',["img_url"=>$file['tmp_name']]);
            }
        }
    }


}