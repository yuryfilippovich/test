<?php

namespace App\Providers;

use App\Fetchers\Product\Apple\AppleShop;
use App\Fetchers\Product\ProductFetcher;
use App\Fetchers\ProductAvailability\Apple\AppleShopFetcher;
use App\Fetchers\ProductAvailability\ProductAvailabilityFetcherComposite;
use App\Fetchers\ProductAvailability\ProductAvailabilityFetcherInterface;
use Illuminate\Support\ServiceProvider;
use PHPHtmlParser\Options;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AppleShopFetcher::class, function ($app) {
            return new AppleShopFetcher('New York, NY');
        });
        $this->app->tag([AppleShopFetcher::class], ['productAvailabilityFetchers']);

        $this->app->singleton(ProductAvailabilityFetcherInterface::class, function ($app) {
            $fetchers = [];
            foreach ($this->app->tagged('productAvailabilityFetchers') as $fetcher) {
                $fetchers[] = $fetcher;
            }
            return new ProductAvailabilityFetcherComposite($fetchers);
        });

        $this->app->singleton(AppleShop::class, function ($app) {
            $options = new Options();
            $options->setRemoveScripts(false);
            return new AppleShop(new \PHPHtmlParser\Dom(), $options);
        });
        $this->app->tag([AppleShop::class], ['productParsers']);

        $this->app->singleton(ProductFetcher::class, function ($app) {
            $parsers = [];
            foreach ($this->app->tagged('productParsers') as $parser) {
                $parsers[] = $parser;
            }
            return new ProductFetcher($parsers);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
