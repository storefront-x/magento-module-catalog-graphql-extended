<?php

namespace StorefrontX\CatalogGraphQlExtended\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use StorefrontX\CatalogGraphQlExtended\Model\Resolver\DataProvider\MSI as MSIDataProvider;
use Psr\Log\LoggerInterface;

class MSI implements ResolverInterface
{

    private MSIDataProvider $msiDataProvider;
    protected LoggerInterface $logger;

    /**
     * @param MSIDataProvider $msiDataProvider
     * @param LoggerInterface $logger
     */
    public function __construct(
        MSIDataProvider $msiDataProvider,
        LoggerInterface $logger
    ) {
        $this->msiDataProvider = $msiDataProvider;
        $this->logger = $logger;
    }

    /**
     * @inheritdoc
     */
    public function resolve(
        Field $field,
              $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {

        if (isset($args['sku'])) {
            $sku = $args['sku'];
        } elseif (!isset($value['sku'])) {
            $this->logger->error('Error - no sku', ['error' => $value]);
            $sku = null;
        } else {
            $sku = $value['sku'];
        }

        return $this->msiDataProvider->getMSI($sku);
    }

}
