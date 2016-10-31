<?php

namespace ProductScraper;

use PHPUnit_Framework_TestCase as TestCase;
use ProductScraper\Exception\InvalidProductException;

/**
 * Product Response Handler Test
 *
 * @author Lukas Hajdu <hello@lukashajdu.com>
 * @copyright Lukas Hajdu <http://lukashajdu.com>, 2016
 * @package ProductScraper
 */
class ProductResponseHandlerTest extends TestCase
{
    /**
     * @covers \ProductScraper\ProductResponseHandler::JSON
     */
    public function testJSONNoData()
    {
        $collection = new ProductCollection();
        $handler = new ProductResponseHandler($collection);

        $this->assertEquals(json_encode([
            'results' => [],
            'total' => 0,
        ]), $handler->JSON());
    }

    /**
     * @covers \ProductScraper\ProductResponseHandler::JSON
     */
    public function testJSONException()
    {
        $collection = new ProductCollection();
        $collection->add((new Product())->setTitle('Avocado')->setPricePerUnit(1));
        $handler = new ProductResponseHandler($collection);

        $this->expectException(InvalidProductException::class);
        $this->expectExceptionMessage('Product collection contains invalid product');

        $handler->JSON();
    }

    /**
     * @covers \ProductScraper\ProductResponseHandler::JSON
     */
    public function testJSON()
    {
        $product1 = (new Product())
            ->setPricePerUnit(0.50)
            ->setTitle('Avocado')
            ->setDescription('Tasty avocado')
            ->setPageSizeInBytes(110);
        $product2 = (new Product())
            ->setPricePerUnit(1.50)
            ->setTitle('Banana')
            ->setDescription('Tasty banana')
            ->setPageSizeInBytes(124);

        $collection = new ProductCollection();
        $collection->add($product1);
        $collection->add($product2);
        $handler = new ProductResponseHandler($collection);
        $this->assertEquals([
            'results' => [
                [
                    'title' => $product1->getTitle(),
                    'size' => $product1->getPageSizeInKiloBits() . 'kb',
                    'unit_price' => $product1->getPricePerUnit(),
                    'description' => $product1->getDescription(),
                ],
                [
                    'title' => $product2->getTitle(),
                    'size' => $product2->getPageSizeInKiloBits() . 'kb',
                    'unit_price' => $product2->getPricePerUnit(),
                    'description' => $product2->getDescription(),
                ],
            ],
            'total' => 2,
        ], json_decode($handler->JSON(), true));
    }
}
