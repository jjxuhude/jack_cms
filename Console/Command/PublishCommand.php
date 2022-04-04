<?php
/**
 * Created by PhpStorm.
 * User: Custom.Xu1
 * Date: 2021/11/27
 * Time: 20:12
 */

namespace Jack\Cms\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\MessageQueue\PublisherInterface;


/**
 * php magento my:publish user13
 * Class PublishCommand
 * @package Custom\Cms\Console\Command
 */
class PublishCommand extends Command
{

    const ARGUMENT= "username";

    public $publish;

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

    public function __construct(PublisherInterface $publish,$name = null)
    {
        parent::__construct($name);
        $this->objectManager= ObjectManager::getInstance();
        $this->publish = $publish;
    }


    protected function configure()
    {
        $this->setName('my:publish');
        $this->setDescription('RabbitMQ测试');
        parent::configure();

        $this->addArgument(self::ARGUMENT,InputArgument::REQUIRED,"用户名称");

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $username= $input->getArgument(self::ARGUMENT);
        $this->publish->publish('magento2.customer',$username);
        $output->writeln(sprintf("<info>%s</info>",$username));
    }

}