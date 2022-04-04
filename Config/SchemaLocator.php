<?php
/**
 * Created by PhpStorm.
 * User: Jack.Xu1
 * Date: 2022/2/26
 * Time: 18:08
 */

namespace Jack\Cms\Config;


class SchemaLocator implements \Magento\Framework\Config\SchemaLocatorInterface
{

    /**
     * Path to corresponding XSD file with validation rules for merged config
     *
     * @var string
     */
    private $schema;

    /**
     * @param \Magento\Framework\Module\Dir\Reader $moduleReader
     */
    public function __construct(\Magento\Framework\Module\Dir\Reader $moduleReader)
    {
        $this->schema = $moduleReader->getModuleDir('etc', 'Jack_Cms') . '/' . 'ui_definition.xsd';
    }

    /**
     * @inheritdoc
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * @inheritdoc
     */
    public function getPerFileSchema()
    {
        return null;
    }
}