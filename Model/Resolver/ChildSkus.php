<?php

declare(strict_types=1);

namespace StorefrontX\CatalogGraphQlExtended\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Quote\Model\Quote;

class ChildSkus implements ResolverInterface
{

    /**
     * @inheritdoc
     */
    public function resolve(
        Field $field,
              $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ): array
    {
        $result = [];
        if (!empty($value['model']) && ($value['model'] instanceof Quote)) {
            /** @var Quote $cart */
            $cart = $value['model'];
            $items = $cart->getItems();

            foreach ($items as $item) {
                $addToResult['cart_item_id'] = $item->getItemId();
                $addToResult['sku'] = $item->getSku();
                $result[] = $addToResult;
            }
        }
        return $result;
    }
}
