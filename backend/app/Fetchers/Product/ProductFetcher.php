<?php

namespace App\Fetchers\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Http;

class ProductFetcher
{
    /**
     * @var ProductParserInterface[]
     */
    private array $parsers;

    /**
     * @param ProductParserInterface[] $parsers
     */
    public function __construct(array $parsers)
    {
      foreach ($parsers as $parser) {
          $this->setParser($parser);
      }
    }

    /**
     * @param ProductParserInterface $parser
     */
    private function setParser(ProductParserInterface $parser)
    {
        $this->parsers[$parser->getParserName()] = $parser;
    }

    /**
     * @param string $parserName
     * @param string $url
     * @param string $product
     * @return Product|null
     */
    public function getProduct(string $parserName, string $url, string $product): ?Product
    {
        if (!array_key_exists($parserName, $this->parsers)) {
            return null;
        }

        try {
            return $this->parsers[$parserName]->getProduct(Http::get($url)->body(), $product);
        } catch (\Exception $e) {
            return null;
        }
    }
}
