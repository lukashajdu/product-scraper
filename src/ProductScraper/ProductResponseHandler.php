<?php

namespace ProductScraper;

use ProductScraper\Exception\InvalidProductException;
use ProductScraper\Exception\UndefinedPropertyException;

/**
 * Product Response Handler
 *
 * @author Lukas Hajdu <hello@lukashajdu.com>
 * @copyright Lukas Hajdu <http://lukashajdu.com>, 2016
 * @package ProductScraper
 */
class ProductResponseHandler
{
    /**
     * Product collection
     *
     * @var ProductCollection
     */
    private $productCollection;

    /**
     * Constructor
     *
     * @param ProductCollection $collection
     */
    public function __construct(ProductCollection $collection)
    {
        $this->productCollection = $collection;
    }

    /**
     * Get response data as a JSON string
     *
     * @return string
     * @throws InvalidProductException
     */
    public function JSON(): string
    {
        $results = [];
        foreach ($this->productCollection->getProducts() as $product) {
            try {
                $results[] = [
                    'title' => $product->getTitle(),
                    'size' => $product->getPageSizeInKiloBits() . 'kb',
                    'unit_price' => $product->getPricePerUnit(),
                    'description' => $product->getDescription(),
                ];
            } catch (UndefinedPropertyException $e) {
                throw new InvalidProductException(
                    'Product collection contains invalid product'
                );
            }
        }

        return json_encode([
            'results' => $results,
            'total' => $this->productCollection->getTotalUnitPrice(),
        ]);
    }
}
