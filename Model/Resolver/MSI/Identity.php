<?php

declare(strict_types=1);

namespace StorefrontX\CatalogGraphQlExtended\Model\Resolver\MSI;

use Magento\Catalog\Model\Product;
use Magento\Framework\GraphQl\Query\Resolver\IdentityInterface;

class Identity implements IdentityInterface {

    private $cacheTagProduct = Product::CACHE_TAG;

    /**
     * Get product ids for cache tag
     *
     * @param array $resolvedData
     * @return string[]
     */
    public function getIdentities(array $resolvedData): array
    {
        $ids = [];
        $items = $resolvedData['items'] ?? [];
        foreach ($items as $item) {
            $ids[] = sprintf('%s_%s', $this->cacheTagProduct, $item['id']);
        }
        if (!empty($ids)) {
            array_unshift($ids, $this->cacheTagProduct);
        }
        return $ids;
    }

}