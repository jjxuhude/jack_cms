<?php
/**
 * Created by PhpStorm.
 * User: Custom.Xu1
 * Date: 2021/11/27
 * Time: 20:12
 */

namespace Jack\Cms\Console\Command;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Product;
use Magento\Cms\Model\Page;
use Magento\Cms\Model\PageFactory;
use Magento\Cms\Model\ResourceModel\Page\CollectionFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\App\ObjectManager;


class Test extends Command
{
    const NAME="name";
    const METHOD="method";


    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * @var Product
     */
    protected $productModel;


    /**
     * @var CollectionFactory
     */
    protected $pageCollection;

    public function __construct()
    {
        parent::__construct();
        $this->objectManager= ObjectManager::getInstance();
        $this->productRepository=$this->objectManager->get(ProductRepositoryInterface::class);
        $this->productModel=$this->objectManager->get(Product::class);
        $this->pageCollection=$this->objectManager->get(CollectionFactory::class);
    }


    protected function configure()
    {
        $this->setName('my:test');
        $this->setDescription('测试');

        $this->addArgument(self::METHOD,InputArgument::REQUIRED,"方法名称");

        $this->addOption(
            self::NAME,
            null,
            InputOption::VALUE_REQUIRED,
        );
        parent::configure();

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $method= $input->getArgument(self::METHOD);
//        $name = $input->getOption(self::NAME);
        if ($method) {
            $product = $this->productModel->loadByAttribute("sku","demo01");
            $product->getResourceCollection();
            $product->getResource();
            $collection=$product->getCollection();
            $collection->addFieldToFilter("sku","demo01");
          //  dump($collection->getCurPage());
          //  dump($collection->toArray());
          //  dump($collection->getSelectSql(true));
            //dump($product->debug());

            dump($this->pageCollection->create()->getSelectSql(true));
        }else{
            $output->writeln("没有数据");
        }
    }

}