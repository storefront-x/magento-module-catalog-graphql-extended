<?php

namespace StorefrontX\CatalogGraphQlExtended\Model\Resolver\Product;

use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

/**
 * Class ProductFragment
 * @package  StorefrontX\CatalogGraphQlExtended\Plugin\Product
 */
class ProductFragment extends \Magento\CatalogGraphQl\Model\Resolver\Product\ProductFieldsSelector
{

    /**
     * Return field names for all requested product fields.
     *
     * @param ResolveInfo $info
     * @param string $productNodeName
     * @return string[]
     */
    public function getProductFieldsFromInfo(ResolveInfo $info, string $productNodeName = 'product') : array
    {
        return array_keys($info->getFieldSelection(0));
    }

}
