<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Jack\Cms\Controller\Adminhtml\Custom\Cms;

use Jack\Cms\Controller\Adminhtml\Custom\AbstractAction;


class Upload extends AbstractAction
{
    /**
     *
     */
    public function execute()
    {
        $response=[
            'status' => true,
            //'file' => $new,
           // 'info' => getimagesize('.' . $new)
        ];
        dd($response);
        return $this->resultFactory->create('json')->setData($response);
    }
}
