<?php

namespace ProductScraper;

use PHPHtmlParser\Dom;
use PHPHtmlParser\Dom\HtmlNode;
use ProductScraper\DataSource\DataSourceInterface;

/**
 * Product List Page Scraper
 *
 * @author Lukas Hajdu <hello@lukashajdu.com>
 * @copyright Lukas Hajdu <http://lukashajdu.com>, 2016
 * @package ProductScraper
 */
class ProductListPageScraper
{
    /**
     * Page DOM
     *
     * @var Dom
     */
    private $pageDOM;

    /**
     * Constructor
     *
     * @param DataSourceInterface $source
     */
    public function __construct(DataSourceInterface $source)
    {
        $this->pageDOM = (new Dom())->load($source->getContent());
        $this->pageSizeInBytes = $source->getSizeInBytes();
    }

    /**
     * Get scraped page DOM
     *
     * @return Dom
     */
    public function getPageDOM(): Dom
    {
        return $this->pageDOM;
    }

    /**
     * Get list of product URLs
     *
     * @return array
     */
    public function getProductURLs(): array
    {
        $url = [];
        $products = $this->pageDOM->find('div.productInfo > h3 > a');
        /** @var HtmlNode $product */
        foreach ($products as $product) {
            $url[] = $product->getAttribute('href');
        }

        return $url;
    }
}
