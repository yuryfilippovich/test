<?php

namespace App\Models;

class ProductAvailability
{
    private string $shop;

    private string $address;

    private string $available;

    /**
     * @param string $shop
     * @param string $address
     * @param string $available
     */
    public function __construct(string $shop, string $address, string $available)
    {
        $this->shop = $shop;
        $this->address = $address;
        $this->available = $available;
    }

    /**
     * @return string
     */
    public function getShop(): string
    {
        return $this->shop;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getAvailable(): string
    {
        return $this->available;
    }
}
