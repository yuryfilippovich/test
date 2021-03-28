<?php

namespace App\Http\Web\Product\Controllers;

use App\Http\Web\Product\Resources\Product;
use App\Repository\ProductRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;

class Models extends Controller
{
    private ProductRepository $repository;

    /**
     * @param ProductRepository $repository
     */
    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return Product[]|AnonymousResourceCollection
     */
    public function __invoke()
    {
        return Product::collection($this->repository->getAll());
    }
}
