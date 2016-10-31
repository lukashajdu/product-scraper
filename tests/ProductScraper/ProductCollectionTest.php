<?php

namespace ProductScraper;

use PHPUnit_Framework_TestCase as TestCase;

/**
 * Product Collection Test
 *
 * @author Lukas Hajdu <hello@lukashajdu.com>
 * @copyright Lukas Hajdu <http://lukashajdu.com>, 2016
 * @package ProductScraper
 */
class ProductCollectionTest extends TestCase
{
    /**
     * @covers \ProductScraper\ProductCollection::add
     * @covers \ProductScraper\ProductCollection::getProducts
     */
    public function testAdd()
    {
        $product = (new Product())->setTitle('Avocado')->setPricePerUnit(1);
        $collection = new ProductCollection();

        $this->assertTrue($collection->add($product));
        $this->assertEquals($product, $collection->getProducts()[0]);
    }

    /**
     * @covers \ProductScraper\ProductCollection::add
     * @covers \ProductScraper\ProductCollection::getTotalUnitPrice
     */
    public function testGetTotalUnitPrice()
    {
        $collection = new ProductCollection();
        $collection->add((new Product())->setPricePerUnit(0.50));
        $collection->add((new Product())->setPricePerUnit(80.21));
        $collection->add((new Product())->setPricePerUnit(19));

        $this->assertEquals((0.50 + 80.21 + 19), $collection->getTotalUnitPrice());
    }
}
