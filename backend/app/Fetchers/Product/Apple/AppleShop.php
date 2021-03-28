<?php

namespace App\Fetchers\Product\Apple;

use App\Fetchers\Product\ProductParserInterface;
use App\Models\Product;
use PHPHtmlParser\Dom;
use PHPHtmlParser\Options;

class AppleShop implements ProductParserInterface
{
    private Dom $parser;

    private Options $options;

    public function __construct(Dom $parser, Options $options)
    {
        $this->parser = $parser;
        $this->options = $options;
    }

    /**
     * @inheritDoc
     */
    public function getParserName(): string
    {
        return 'apple';
    }

    /**
     * @inheritDoc
     */
    public function getProduct(string $data, string $productName): ?Product
    {
        $this->parser->loadStr($data, $this->options);
        $products = $this->parser->find('form.as-configuration-form');
        foreach ($products as $product) {
            if ($product->find('span.visuallyhidden', 0)->text === $productName) {
                return new Product($product->find('input[name=product]', 0)->value, $productName);
            }
        }
        return null;
    }
}
