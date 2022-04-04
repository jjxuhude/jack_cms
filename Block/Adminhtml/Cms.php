<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Jack\Cms\Block\Adminhtml;

/**
 * Custom Cms Block
 *
 * @api
 * @since 100.0.2
 */
class Cms extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Block constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_blockGroup = 'Jack_CMS';
        $this->_controller = 'custom_cms';
        $this->_headerText = __('Custom CMS');
        parent::_construct();
        $this->buttonList->update('add', 'label', __('Add New Cms'));
    }
}
