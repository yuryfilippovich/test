<?php

namespace App\Fetchers\ProductAvailability\Apple;

use App\Fetchers\ProductAvailability\ProductAvailabilityFetcherInterface;
use App\Models\ProductAvailability;
use Illuminate\Support\Facades\Http;

class AppleShopFetcher implements ProductAvailabilityFetcherInterface
{
    private const API_URL = 'https://www.apple.com/shop/retail/pickup-message';

    private string $location;

    public function __construct(string $location)
    {
        $this->location = $location;
    }

    /**
     * @inheritDoc
     */
    public function getProductAvailability(string $product): array
    {
        try {
            $data = Http::get($this->buildUrl($product))->json();
            $result = [];
            if (
                array_key_exists('body', $data)
                && array_key_exists('stores', $data['body'])
                && is_array($data['body']['stores'])
            ) {
                foreach ($data['body']['stores'] as $storeData) {
                    $result[] = new ProductAvailability(
                        $storeData['storeName'],
                        implode(', ', array_filter($storeData['address'])),
                        $storeData['pickupTypeAvailabilityText']
                    );
                }
            }
            return $result;
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * @param string $product
     * @return string
     */
    private function buildUrl(string $product): string
    {
        return self::API_URL . "?" . http_build_query(['parts.0' => $product, 'location' => $this->location]);
    }
}
