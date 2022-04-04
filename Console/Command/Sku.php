<?php
/**
 * Created by PhpStorm.
 * User: Custom.Xu1
 * Date: 2021/11/27
 * Time: 20:12
 */

namespace Jack\Cms\Console\Command;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\App\ObjectManager;

class Sku extends Command
{
    const SKU="sku";

    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->productRepository=ObjectManager::getInstance()->get(ProductRepositoryInterface::class);
    }


    protected function configure()
    {
        $this->setName('my:product');
        $this->setDescription('获取商品');
        $this->addOption(
            self::SKU,
            null,
            InputOption::VALUE_REQUIRED,
        );

        parent::configure();

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($sku = $input->getOption(self::SKU)) {
            $output->writeln('<info>Provided name is `' . $sku . '`</info>');
            $product = $this->productRepository->get($sku)->debug();
            dump($product);
        }
    }

}