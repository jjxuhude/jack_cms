<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Jack\Cms\Amqp;

use function Magento\NonComposerComponentRegistration\loger;

class ConsumerHandler
{
    /**
     * @param \Magento\TestModuleAsyncAmqp\Model\AsyncTestData $simpleDataItem
     */
    public function process($simpleDataItem)
    {
//        file_put_contents(
//            $simpleDataItem->getTextFilePath(),
//            'InvokedFromRequestHandler-' . $simpleDataItem->getValue() . PHP_EOL,
//            FILE_APPEND
//        );
        loger(   $simpleDataItem . PHP_EOL,"consumer.log");
    }
}
