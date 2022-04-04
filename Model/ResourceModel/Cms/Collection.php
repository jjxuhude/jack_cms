<?php
/**
 * Created by PhpStorm.
 * User: Jack.Xu1
 * Date: 2022/2/18
 * Time: 21:55
 */

namespace Jack\Cms\Model\ResourceModel\Cms;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     *  Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init(\Jack\Cms\Model\Cms::class, \Jack\Cms\Model\ResourceModel\Cms::class);
    }




}