<?php

namespace ProductScraper;

use PHPUnit_Framework_TestCase as TestCase;
use ProductScraper\Exception\UndefinedPropertyException;

/**
 * Product Test
 *
 * @author Lukas Hajdu <hello@lukashajdu.com>
 * @copyright Lukas Hajdu <http://lukashajdu.com>, 2016
 * @package ProductScraper
 */
class ProductTest extends TestCase
{
    /**
     * @covers \ProductScraper\Product::getTitle
     */
    public function testGetTitleException()
    {
        $this->expectException(UndefinedPropertyException::class);
        (new Product())->getTitle();
    }

    /**
     * @covers \ProductScraper\Product::getDescription
     */
    public function testGetDescriptionException()
    {
        $this->expectException(UndefinedPropertyException::class);
        (new Product())->getDescription();
    }

    /**
     * @covers \ProductScraper\Product::getPageSizeInBytes
     */
    public function testGetPageSizeInBytesException()
    {
        $this->expectException(UndefinedPropertyException::class);
        (new Product())->getPageSizeInBytes();
    }

    /**
     * @covers \ProductScraper\Product::getPageSizeInKiloBits
     */
    public function testGetPageSizeInKiloBitsException()
    {
        $this->expectException(UndefinedPropertyException::class);
        (new Product())->getPageSizeInKiloBits();
    }

    /**
     * @covers \ProductScraper\Product::getPageSizeInKiloBits
     */
    public function testGetPageSizeInKiloBits()
    {
        $product = (new Product())->setPageSizeInBytes(1000);
        $this->assertEquals(8, $product->getPageSizeInKiloBits());

        $product = (new Product())->setPageSizeInBytes(10);
        $this->assertEquals(0.08, $product->getPageSizeInKiloBits());
    }

    /**
     * @covers \ProductScraper\Product::getPricePerUnit
     */
    public function testGetPricePerUnitException()
    {
        $this->expectException(UndefinedPropertyException::class);
        (new Product())->getPricePerUnit();
    }
}
