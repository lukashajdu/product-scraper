<?php

namespace ProductScraper;

use PHPHtmlParser\Dom;
use PHPUnit_Framework_TestCase as TestCase;
use ProductScraper\DataSource\FileSource;

/**
 * Product Page Scraper Test
 *
 * @author Lukas Hajdu <hello@lukashajdu.com>
 * @copyright Lukas Hajdu <http://lukashajdu.com>, 2016
 * @package ProductScraper
 */
class ProductPageScraperTest extends TestCase
{
    /**
     * Scraper
     *
     * @var ProductPageScraper
     */
    private $scraper;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $source = new FileSource(__DIR__ . '/documents/product.html');
        $this->scraper = new ProductPageScraper($source);
        parent::setUp();
    }

    /**
     * @covers \ProductScraper\ProductPageScraper::__construct
     * @covers \ProductScraper\ProductPageScraper::getPageDOM
     * @covers \ProductScraper\ProductPageScraper::getPageSizeInBytes
     */
    public function testConstructor()
    {
        $this->assertInstanceOf(Dom::class, $this->scraper->getPageDOM());
        $this->assertTrue($this->scraper->getPageSizeInBytes() > 0);
    }

    /**
     * @covers \ProductScraper\ProductPageScraper::getTitle
     */
    public function testGetTitle()
    {
        $this->assertEquals(
            'Sainsbury\'s Apricot Ripe & Ready x5',
            $this->scraper->getTitle()
        );
    }

    /**
     * @covers \ProductScraper\ProductPageScraper::getPricePerUnit
     */
    public function testGetPricePerUnit()
    {
        $this->assertEquals(3.50, $this->scraper->getPricePerUnit());
    }

    /**
     * @covers \ProductScraper\ProductPageScraper::getDescription
     */
    public function testGetDescription()
    {
        $this->assertEquals('Apricots', $this->scraper->getDescription());
    }

    /**
     * @covers \ProductScraper\ProductPageScraper::getProduct
     */
    public function testGetProducts()
    {
        $product = (new Product())
            ->setTitle('Sainsbury\'s Apricot Ripe & Ready x5')
            ->setPricePerUnit(3.50)
            ->setDescription('Apricots')
            ->setPageSizeInBytes($this->scraper->getPageSizeInBytes());

        $this->assertEquals($product, $this->scraper->getProduct());
    }
}
