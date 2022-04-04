<?php
/**
 * Created by PhpStorm.
 * User: Custom.Xu1
 * Date: 2021/11/25
 * Time: 17:38
 */

namespace Jack\Cms\Console\Command;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\ObjectManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

    /**
     * Class SomeCommand
     */
    class SomeCommand extends Command
    {
        const NAME = 'name';

        /**
         * @var ProductRepositoryInterface
         */
        protected $productRepository;


        public function __construct($name = null)
        {
            parent::__construct($name);
            $this->productRepository=ObjectManager::getInstance()->get(ProductRepositoryInterface::class);
        }

        /**
         * @inheritDoc
         */
        protected function configure()
        {
            $this->setName('my:first:command');
            $this->setDescription('This is my first console command.');
            $this->addOption(
                self::NAME,
                null,
                InputOption::VALUE_REQUIRED,
                'Name'
            );

            parent::configure();
        }

        /**
         * Execute the command
         *
         * @param InputInterface $input
         * @param OutputInterface $output
         *
         * @return null|int
         */
        protected function execute(InputInterface $input, OutputInterface $output)
        {
            if ($name = $input->getOption(self::NAME)) {
                $output->writeln('<info>Provided name is `' . $name . '`</info>');
            }

            $output->writeln('<info>Success Message.</info>');
            $output->writeln('<error>An error encountered.</error>');
            $output->writeln('<comment>Some Comment.</comment>');
            $output->writeln($this->productRepository->getById(5)->getName());
            $product = $this->productRepository->get("demo02")->debug();
            dump($product);


        }
    }
