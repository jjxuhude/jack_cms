<?php
/**
 * Created by PhpStorm.
 * User: Custom.Xu1
 * Date: 2021/12/8
 * Time: 16:38
 */
namespace Jack\Cms\Event;


use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ProductRepository;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\DataObject;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\SalesRule\Model\Rule;

/**
 * Class AfterCollectTotals
 */
class AfterCollectTotals implements ObserverInterface
{
    /**
     * @var \Magento\Checkout\Model\Session
     */
    private $session;


    private $collection;


    /**
     * AfterCollectTotals constructor.
     * @param \Magento\Checkout\Model\Session $messageManager
     */
    public function __construct(
        \Magento\Checkout\Model\Session $messageManager,
        \Magento\SalesRule\Model\ResourceModel\Rule\CollectionFactory $collction,
        Rule $rule
    ) {
        $this->session = $messageManager;
        $this->collection = $collction;
        $this->rule = $rule;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $observer->getEvent();
//        $quote=$this->session->getQuote();
        $rules=$this->rule->getCollection()
            ->addFieldToFilter("simple_action",'gift')
            ->addFieldToFilter("is_active",'1')
            ->load()
        ;
        foreach($rules as $rule){
            $this->calculate($rule);
        }
    }

    public function calculate($rule)
    {

        $discount_step= (int)$rule->getData('discount_step');
        $discount_amount=(int) $rule->getData('discount_amount');
        $product_sku=$rule->getData('product_sku');
        $gift_sku=$rule->getData('gift_sku');
        $quote=$this->session->getQuote();
        $quoteSkuArr=[];
        $itemIdArr=[];
        foreach($quote->getAllItems() as $item){
          $quoteSkuArr[$item->getSku()]=$item->getQty();
          $itemIdArr[$item->getSku()]=$item->getId();
        }

        $om= ObjectManager::getInstance();
       if(isset($quoteSkuArr[$product_sku]) && $quoteSkuArr[$product_sku]>=$discount_step){
            $request = new DataObject(["qty"=>$discount_amount]);
            if(isset($quoteSkuArr[$gift_sku])){
                $quote->updateItem($itemIdArr[$gift_sku],$request);
            }else{
                /**
                 * @var $product Product
                 */
                $product= $om->create(ProductRepository::class)->get($gift_sku);
                $product->setCustomPrice(0);
                $product->setOriginalCustomPrice(0);
                $quoteItem=$quote->addProduct($product,$request);
                $quoteItem->setCustomPrice(0);
                $quoteItem->setOriginalCustomPrice(0);

            }
       }else{
           foreach($quote->getAllItems() as $item){
                if($item->getSku()==$gift_sku){
                    $quote->removeItem($item->getId());
                }
            }
       }



    }
}