<?php

namespace App\Fetchers\ProductAvailability;

class ProductAvailabilityFetcherComposite implements ProductAvailabilityFetcherInterface
{
    /**
     * @var ProductAvailabilityFetcherInterface[]
     */
    private array $fetchers;

    /**
     * @param ProductAvailabilityFetcherInterface[] $fetchers
     */
    public function __construct(array $fetchers)
    {
        $this->fetchers = $fetchers;
    }

    /**
     * @inheritDoc
     */
    public function getProductAvailability(string $product): array
    {
        $availability = [];

        foreach ($this->fetchers as $fetcher) {
            $availability = array_merge($availability, $fetcher->getProductAvailability($product));
        }
        return $availability;
    }
}
