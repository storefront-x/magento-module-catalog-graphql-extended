<?php

declare(strict_types=1);

namespace StorefrontX\CatalogGraphQlExtended\Plugin\Model;

use Magento\Framework\DataObject;
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
     * Modify media url address in dynamic block content
     *
     * @param object $subject
     * @param array $result
     * @param DataObject $dynamicBlock
     * @return array
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function afterFormat(
        object $subject,
        array $result,
        DataObject $dynamicBlock
    ) {
        $absoluteUrl = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);

        $dynamicBannerContent = preg_replace("/(}}\" alt)/", "\" alt", $dynamicBlock->getData('banner_content'));
        $dynamicBannerContent = preg_replace("/src=\"{{media url=/", "src=\"" . $absoluteUrl, $dynamicBannerContent);
        $dynamicBannerContent = preg_replace("/}}\\\&quot;}\"/", "\\&quot;}\"", $dynamicBannerContent);
        $dynamicBannerContent = preg_replace(
            "/images=\"{\\\&quot;desktop_image\\\&quot;:\\\&quot;{{media url=/",
            "images=\"{\\&quot;desktop_image\\&quot;:\\&quot;" . $absoluteUrl,
            $dynamicBannerContent
        );

        $result['content']['html'] = $dynamicBannerContent;

        return $result;
    }
}
