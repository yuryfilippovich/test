<?php

namespace App\Fetchers\ProductAvailability;

use App\Models\ProductAvailability;

interface ProductAvailabilityFetcherInterface
{
    /**
     * @param string $product
     * @return ProductAvailability[]
     */
    public function getProductAvailability(string $product): array;
}
