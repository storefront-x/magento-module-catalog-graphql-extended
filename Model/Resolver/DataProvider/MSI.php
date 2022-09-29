<?php
declare(strict_types=1);

namespace StorefrontX\CatalogGraphQlExtended\Model\Resolver\DataProvider;

use Magento\InventoryApi\Api\GetSourceItemsBySkuInterface;
use Magento\InventoryApi\Api\SourceRepositoryInterface;
use Psr\Log\LoggerInterface;

class MSI
{

    private GetSourceItemsBySkuInterface $sourceItemsBySku;
    protected LoggerInterface $logger;
    protected SourceRepositoryInterface $sourceRepository;

    public function __construct(
        GetSourceItemsBySkuInterface $sourceItemsBySku,
        SourceRepositoryInterface $sourceRepository,
        LoggerInterface $logger
    )
    {
        $this->sourceItemsBySku = $sourceItemsBySku;
        $this->sourceRepository = $sourceRepository;
        $this->logger = $logger;
    }

    /**
     * @params string $sku
     * this function return all the MSI Data for product sku
     * @returns array
     */
    public function getMSI(string $sku): array
    {
        return $this->getSourceItemBySku($sku);
    }

    /**
     * @params string $sku
     * this function return all the MSI Data for product sku
     * @returns array
     */
    public function getSourceItemBySku($sku): array
    {

        $sources = [];
        $sourceData = $this->sourceRepository->getList();
        $productSourceData = $this->sourceItemsBySku->execute($sku);

        foreach($productSourceData as $source) {

            $sourceName = null;
            $latitude = null;
            $longitude = null;
            $country_id = null;
            $street = null;
            $postcode = null;
            $enabled = null;

            foreach($sourceData->getItems() as $so) {
                $sourceCode = $so->getSourceCode();
                if ($so->getSourceCode() === $source->getSourceCode()) {
                    $sourceName = $so->getName();
                    $latitude = $so->getLatitude();
                    $longitude = $so->getLongitude();
                    $country_id = $so->getCountryId();
                    $street = $so->getStreet();
                    $postcode = $so->getPostcode();
                    $enabled = $so->isEnabled();
                }
            }

            $sources[] = ['source_code' => $source->getSourceCode(),
                'quantity' => $source->getQuantity(),
                'sku' => $source->getSku(),
                'status' => $source->getStatus(),
                'name' => $sourceName,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'country_id' => $country_id,
                'street' => $street,
                'postcode' => $postcode,
                'enabled' => $enabled
            ];
        }

        return $sources;
    }

}
