<?php

namespace App\Http\Web\Product\Controllers;

use App\Fetchers\ProductAvailability\ProductAvailabilityFetcherComposite;
use App\Fetchers\ProductAvailability\ProductAvailabilityFetcherInterface;
use App\Http\Web\Product\Request\AvailabilityRequest;
use App\Http\Web\Product\Resources\ProductAvailability;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;

class Availability extends Controller
{
    private ProductAvailabilityFetcherInterface $fetcher;

    /**
     * @param ProductAvailabilityFetcherInterface $fetcher
     */
    public function __construct(ProductAvailabilityFetcherInterface $fetcher)
    {
        $this->fetcher = $fetcher;
    }

    /**
     * @param AvailabilityRequest $availabilityRequest
     * @return ProductAvailability[]|AnonymousResourceCollection
     */
    public function __invoke(AvailabilityRequest $availabilityRequest): AnonymousResourceCollection
    {
        return ProductAvailability::collection(
            $this->fetcher->getProductAvailability(
                $availabilityRequest->get('product')
            )
        );
    }
}
