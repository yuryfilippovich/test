<?php

namespace App\Repository;

use App\Models\Product;

class ProductRepository
{
    private const STORAGE_DATA = [
        ['MYD82LL/A', 'Apple M1 Chip with 8-Core CPU and 8-Core GPU256GB Storage'],
        ['MYD92LL/A', 'Apple M1 Chip with 8-Core CPU and 8-Core GPU512GB Storage'],
        ['MGYN3AM/A', 'AirPods Max'],
    ];

    /**
     * @return Product[]
     */
    public function getAll(): array
    {
        //load from storage
        $products = [];
        foreach (self::STORAGE_DATA as $product) {
            $products[] = new Product($product[0], $product[1]);
        }
        return $products;
    }

    /**
     * @param Product $product
     * @return bool
     */
    public function save(Product $product): bool
    {
        //save to storage
        return true;
    }
}
