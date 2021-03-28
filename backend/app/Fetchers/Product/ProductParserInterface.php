<?php

namespace App\Fetchers\Product;

use App\Models\Product;

interface ProductParserInterface
{
    /**
     * @return string
     */
    public function getParserName(): string;

    /**
     * @param string $data
     * @param string $product
     * @return Product|null
     */
    public function getProduct(string $data, string $product): ?Product;
}
