<?php
/**
 * Created by PhpStorm.
 * User: Jack.Xu1
 * Date: 2022/2/18
 * Time: 21:48
 */

namespace Jack\Cms\Model;


class Cms extends \Magento\Framework\Model\AbstractModel
{
    const TYPE_TEXT = 'text';

    const TYPE_HTML = 'html';

    /**
     * @var int
     */
    protected $_storeId = 0;

    /**
     * @var \Magento\Framework\Escaper
     */
    protected $_escaper = null;

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Escaper $escaper
     * @param \Magento\Variable\Model\ResourceModel\Variable $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Jack\Cms\Model\ResourceModel\Cms $resource,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Internal Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init(\Jack\Cms\Model\ResourceModel\Cms::class);
    }









}
