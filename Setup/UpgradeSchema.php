<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Jack\Cms\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();


        if (version_compare($context->getVersion(), '3.0.0', '<')) {

            $setup->getConnection()->dropColumn(
                $setup->getTable('customer_entity'),
                'phone'
            );
            $setup->getConnection()->addColumn(
                $setup->getTable('customer_entity'),
                'phone',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 150,
                    'nullable' => true,
                    'comment' => '手机'
                ]
            );

            $setup->getConnection()->dropColumn(
                $setup->getTable('customer_address_entity'),
                'district'
            );
            $setup->getConnection()->addColumn(
                $setup->getTable('customer_address_entity'),
                'district',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 150,
                    'nullable' => true,
                    'comment' => 'district'
                ]
            );


        }

        $setup->endSetup();
    }
}
