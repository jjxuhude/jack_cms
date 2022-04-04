<?php
/**
 * Created by PhpStorm.
 * User: Jack.Xu1
 * Date: 2022/2/18
 * Time: 21:53
 */

namespace Jack\Cms\Model\ResourceModel;


class Cms extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('cms', 'page_id');
    }










}