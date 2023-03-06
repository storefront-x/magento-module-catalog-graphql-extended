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
        $absoluteUrl = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);

        $dynamicBannerContent = preg_replace("/(}}\" alt)/","\" alt",$dynamicBlock->getBannerContent());
        $dynamicBannerContent = preg_replace("/src=\"{{media url=/","src=\"".$absoluteUrl,$dynamicBannerContent);
        $dynamicBannerContent = preg_replace("/}}\\\&quot;}\"/","\\&quot;}\"",$dynamicBannerContent);
        $dynamicBannerContent = preg_replace("/images=\"{\\\&quot;desktop_image\\\&quot;:\\\&quot;{{media url=/","images=\"{\\&quot;desktop_image\\&quot;:\\&quot;".$absoluteUrl,$dynamicBannerContent);

        $result['content']['html'] = $dynamicBannerContent;

        return $result;
    }
}
