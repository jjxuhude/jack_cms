<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Jack\Cms\Setup;

use Magento\Customer\Model\Customer;
use Magento\Framework\Indexer\IndexerRegistry;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class UpgradeData implements UpgradeDataInterface
{
    /**
     * Customer setup factory
     *
     * @var CustomerSetupFactory
     */
    protected $customerSetupFactory;

    /**
     * @var IndexerRegistry
     */
    protected $indexerRegistry;

    /**
     * @var \Magento\Eav\Model\Config
     */
    protected $eavConfig;

    /**
     * @param CustomerSetupFactory $customerSetupFactory
     * @param IndexerRegistry $indexerRegistry
     * @param \Magento\Eav\Model\Config $eavConfig
     */
    public function __construct(
        \Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory,
        IndexerRegistry $indexerRegistry,
        \Magento\Eav\Model\Config $eavConfig
    ) {
        $this->customerSetupFactory = $customerSetupFactory;
        $this->indexerRegistry = $indexerRegistry;
        $this->eavConfig = $eavConfig;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        /** @var CustomerSetup $customerSetup */
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);
       
        if (version_compare($context->getVersion(), '3.0.0', '<')) {
            $customerSetup->removeAttribute(Customer::ENTITY, 'phone') ;
            $customerSetup->addAttribute(
                Customer::ENTITY,
                'phone',
                [
                    'type' => 'varchar',
                    'label' => '手机',
                    'input' => 'text',
                    'system'=> 0,
                    'required' => false,
                    'sort_order' => 87,
                    'visible' => true,
                ]
                );
            $customerSetup->getEavConfig()->getAttribute('customer', 'phone')
            ->setData('used_in_forms', ['adminhtml_customer','customer_account_edit','customer_account_create'])
            ->setData("is_used_for_customer_segment", true)
            ->setData("is_system", 0)
            ->setData("is_user_defined", 1)
            ->setData("is_visible", 1)
            ->setData("sort_order", 100)
            ->save();
            
            $customerSetup->getEavConfig()->getAttribute('customer', 'phone')
            ->addData([
                'attribute_set_id' => 1,
                'attribute_group_id' => 1,
                'is_user_defined'=>true,
                'is_used_for_customer_segment'=>true , 
            ])->save() ;


            $customerSetup->removeAttribute('customer_address', 'district') ;
            $customerSetup->addAttribute(
                'customer_address',
                'district',
                [
                    'type' => 'varchar',
                    'label' => '区县',
                    'input' => 'text',
                    'system'=> 0,
                    'required' => false,
                    'sort_order' => 100,
                    'visible' => true,
                ]
            );

            $customerSetup->getEavConfig()->getAttribute('customer_address', 'district')
                ->setData('used_in_forms', ['adminhtml_customer_address', 'customer_address_edit', 'customer_register_address'])
                ->setData("is_system", 0)
                ->setData("is_user_defined", 1)
                ->setData("is_visible", 1)
                ->setData("sort_order", 100)
                ->save();

            $customerSetup->getEavConfig()->getAttribute('customer_address', 'district')
                ->addData([
                    'attribute_set_id' => 1,
                    'attribute_group_id' => 1,
                    'is_user_defined'=>true,
                    'is_used_for_customer_segment'=>true ,
                ])->save() ;
            
        }

        if (version_compare($context->getVersion(), '4.0.0', '<')) {
            $customerSetup->removeAttribute('customer_address', 'district1') ;
            $customerSetup->addAttribute(
                'customer_address',
                'district1',
                [
                    'type' => 'varchar',
                    'label' => '区县1',
                    'input' => 'text',
                    'system'=> 0,
                    'required' => false,
                    'sort_order' => 100,
                    'visible' => true,
                ]
            );
            $customerSetup->getEavConfig()->getAttribute('customer_address', 'district1')
                ->setData('used_in_forms', ['adminhtml_customer_address', 'customer_address_edit', 'customer_register_address'])
                ->setData("is_system", 0)
                ->setData("is_user_defined", 1)
                ->setData("is_visible", 1)
                ->setData("sort_order", 100)
                ->save();

            $customerSetup->getEavConfig()->getAttribute('customer_address', 'district1')
                ->addData([
                    'attribute_set_id' => 1,
                    'attribute_group_id' => 1,
                    'is_user_defined'=>true,
                    'is_used_for_customer_segment'=>true ,
                ])->save() ;

        }
        $indexer = $this->indexerRegistry->get(Customer::CUSTOMER_GRID_INDEXER_ID);
        $indexer->reindexAll();
        $this->eavConfig->clear();
        $setup->endSetup();
    }



}
