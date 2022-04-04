<?php
/**
 * Created by PhpStorm.
 * User: Jack.Xu1
 * Date: 2022/3/3
 * Time: 15:54
 */

namespace Jack\Cms\Model;

use Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider;

class CustomDataProvider extends DataProvider
{
    public function getData()
    {
        return [
            'items' => [
                [
                    'id' => 1,
                    'name' => 'First Item'
                ],
                [
                    'id' => 2,
                    'name' => 'Second Item'
                ],
                [
                    'id' => 3,
                    'name' => 'Third Item'
                ]
            ],
            'totalRecords' => 3
        ];
    }
}