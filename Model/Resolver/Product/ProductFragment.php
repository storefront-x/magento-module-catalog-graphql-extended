<?php

namespace StorefrontX\CatalogGraphQlExtended\Model\Resolver\Product;

use GraphQL\Language\AST\NodeKind;
use Magento\Framework\GraphQl\Query\FieldTranslator;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

/**
 * Class EntityUrlPlugin
 * @package  StorefrontX\CatalogGraphQlExtended\Plugin\Product
 */
class ProductFragment extends \Magento\CatalogGraphQl\Model\Resolver\Product\ProductFieldsSelector
{
    /**
     * @var FieldTranslator
     */
    private $fieldTranslator;

    /**
     * @param FieldTranslator $fieldTranslator
     */
    public function __construct(FieldTranslator $fieldTranslator)
    {
        parent::__construct($fieldTranslator);
    }


    /**
     * Return field names for all requested product fields.
     *
     * @param ResolveInfo $info
     * @param string $productNodeName
     * @return string[]
     */
    public function getProductFieldsFromInfo(ResolveInfo $info, string $productNodeName = 'product') : array
    {
        parent::getProductFieldsFromInfo($info, $productNodeName);
        return array_keys($info->getFieldSelection(0));
    }

}
