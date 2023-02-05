<?php

declare(strict_types=1);

namespace StorefrontX\CatalogGraphQlExtended\Plugin\Model;

use Magento\Banner\Model\Banner;
use Magento\BannerGraphQl\Model\DynamicBlockFormatter;
use Magento\Store\Model\StoreManagerInterface;

class DynamicBlockFormatterPlugin
{
    private StoreManagerInterface $storeManager;

    /**
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        StoreManagerInterface $storeManager
    ) {
        $this->storeManager = $storeManager;
    }

    /**
     * Modify media url address in dynmic block content
     *
     * @param DynamicBlockFormatter $subject
     * @param array $result
     * @param Banner $dynamicBlock
     * @return array
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function afterFormat(
        DynamicBlockFormatter $subject,
        array $result,
        Banner $dynamicBlock
    ) {
        $absoluteUrl = "media url=".$storeUrl = $this->storeManager->getStore()->getBaseUrl()."media/";
        $dynamicBannerContent = preg_replace("/media url=/",$absoluteUrl,$dynamicBlock->getBannerContent());

        $result['content']['html'] = $dynamicBannerContent;

        return $result;
    }
}
