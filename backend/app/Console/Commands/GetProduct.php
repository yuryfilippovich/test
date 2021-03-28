<?php

namespace App\Console\Commands;

use App\Fetchers\Product\ProductFetcher;
use App\Repository\ProductRepository;
use Illuminate\Console\Command;

class GetProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:get {parser} {url} {product}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param ProductFetcher $fetcher
     * @param ProductRepository $repository
     * @return int
     */
    public function handle(ProductFetcher $fetcher, ProductRepository $repository)
    {
        $product = $fetcher->getProduct(
            (string)$this->argument('parser'),
            (string)$this->argument('url'),
            (string)$this->argument('product')
        );
        if ($product) {
            $repository->save($product);
        }
        return 0;
    }
}
