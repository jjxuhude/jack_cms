<?php
/**
 * Created by PhpStorm.
 * User: Custom.Xu1
 * Date: 2021/11/14
 * Time: 15:22
 */

namespace Jack\Cms\Controller\Page;



use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\RequestInterface;

class Deferred extends \Magento\Framework\App\Action\Action implements HttpGetActionInterface, HttpPostActionInterface
{

    /**
     * @var RequestInterface
     */
    private $request;

    function __construct(
        Context $context,
        RequestInterface $request
    ) {
        parent::__construct($context);
        $this->request = $request;
    }


    public function execute()
    {
        $id = $this->request->getParam("id");
        $fullActionName = $this->request->getFullActionName();
       // dump($id,$fullActionName);
        $data=[
            "id"=>$id
        ];
        dump($data);
    }


}