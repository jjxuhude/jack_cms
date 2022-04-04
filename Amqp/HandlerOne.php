<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Jack\Cms\Amqp;

use function Magento\NonComposerComponentRegistration\loger;

/**
 * Class for testing queue handlers.
 */
class HandlerOne
{
    /**
     * Return true.
     *
     * @return bool
     */
    public function handlerMethodOne($data)
    {
        loger($data);
        return true;
    }


}
