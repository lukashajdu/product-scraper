<?php

namespace ProductScraper;

use PHPHtmlParser\Dom;
use PHPUnit_Framework_TestCase as TestCase;
use ProductScraper\DataSource\FileSource;

/**
 * Product List Page Scraper Test
 *
 * @author Lukas Hajdu <hello@lukashajdu.com>
 * @copyright Lukas Hajdu <http://lukashajdu.com>, 2016
 * @package ProductScraper
 */
class ProductListPageScraperTest extends TestCase
{
    /**
     * Scraper
     *
     * @var ProductListPageScraper
     */
    private $scraper;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $source = new FileSource(__DIR__ . '/documents/product-list.html');
        $this->scraper = new ProductListPageScraper($source);
        parent::setUp();
    }

    /**
     * @covers \ProductScraper\ProductListPageScraper::__construct
     * @covers \ProductScraper\ProductListPageScraper::getPageDOM
     */
    public function testConstructor()
    {
        $this->assertInstanceOf(Dom::class, $this->scraper->getPageDOM());
    }

    /**
     * @covers \ProductScraper\ProductListPageScraper::getProductURLs
     */
    public function testGetProductURLs()
    {
        $expected = array (
            0 => 'http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/sainsburys-apricot-ripe---ready-320g.html',
            1 => 'http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/sainsburys-avocado-xl-pinkerton-loose-300g.html',
            2 => 'http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/sainsburys-avocado--ripe---ready-x2.html',
            3 => 'http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/sainsburys-avocados--ripe---ready-x4.html',
            4 => 'http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/sainsburys-conference-pears--ripe---ready-x4-%28minimum%29.html',
            5 => 'http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/sainsburys-golden-kiwi--taste-the-difference-x4-685641-p-44.html',
            6 => 'http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/sainsburys-kiwi-fruit--ripe---ready-x4.html',
        );

        $this->assertEquals($expected, $this->scraper->getProductURLs());
    }
}
