<?php

namespace ProductScraper;

/**
 * Product Collection
 *
 * @author Lukas Hajdu <hello@lukashajdu.com>
 * @copyright Lukas Hajdu <http://lukashajdu.com>, 2016
 * @package ProductScraper
 */
class ProductCollection
{
    /**
     * Collection of products
     *
     * @var Product[]
     */
    private $products = [];

    /**
     * Sum of unit prices of all products in the collection
     *
     * @var float
     */
    private $totalUnitPrice = 0;

    /**
     * Add product to the collection
     *
     * @param Product $product
     *
     * @return bool
     */
    public function add(Product $product): bool
    {
        $this->products[] = $product;
        $this->totalUnitPrice += $product->getPricePerUnit();

        return true;
    }

    /**
     * Get list of products
     *
     * @return Product[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * Get total unit price
     *
     * @return float
     */
    public function getTotalUnitPrice(): float
    {
        return $this->totalUnitPrice;
    }
}
