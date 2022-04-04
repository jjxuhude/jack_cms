<?php
/**
 * Created by PhpStorm.
 * User: Custom.Xu1
 * Date: 2021/11/25
 * Time: 18:10
 */

namespace Jack\Cms\Test\Unit;


namespace Magento\Catalog\Test\Unit\Helper;

use Magento\Catalog\Helper\Product;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit\Framework\TestCase;

class CmsTest extends TestCase
{

    /**
     * @var \Magento\Catalog\Model\Product
     */
    protected $_model;

    protected $_objectManager;

    protected function setUp(): void
    {
        $this->_objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);
        $this->_model = $this->_objectManager->getObject(\Magento\Catalog\Model\Product::class);
    }

    public function testDemo01(){

        dump(111);
    }

    public function testDemo02(){
      $product=$this->_model->load(6);
      dump($product);
    }


}