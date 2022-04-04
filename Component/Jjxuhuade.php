<?php
/**
 * Created by PhpStorm.
 * User: Jack.Xu1
 * Date: 2022/2/26
 * Time: 15:30
 */

namespace Jack\Cms\Component;

use Magento\Ui\Component\Form\Element\AbstractElement;

/**
 * @api
 * @since 100.0.2
 */
class Jjxuhuade extends AbstractElement
{
    const NAME = 'jjxuhuade';

    /**
     * Get component name
     *
     * @return string
     */
    public function getComponentName()
    {
        return static::NAME;
    }
}
