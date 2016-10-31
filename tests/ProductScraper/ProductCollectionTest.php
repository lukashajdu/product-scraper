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
        $product = (new Product())->setTitle('Avocado');
        $collection = new ProductCollection();

        $this->assertTrue($collection->add($product));
        $this->assertEquals($product, $collection->getProducts()[0]);
    }
}
