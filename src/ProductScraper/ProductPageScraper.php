<?php

namespace ProductScraper;

use PHPHtmlParser\Dom;
use ProductScraper\DataSource\DataSourceInterface;

/**
 * Product Page Scraper
 *
 * @author Lukas Hajdu <hello@lukashajdu.com>
 * @copyright Lukas Hajdu <http://lukashajdu.com>, 2016
 * @package ProductScraper
 */
class ProductPageScraper
{
    /**
     * Page DOM
     *
     * @var Dom
     */
    private $pageDOM;

    /**
     * Page size in bytes
     *
     * @var int
     */
    private $pageSizeInBytes;

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
     * Get scraped page size in bytes
     *
     * @return int
     */
    public function getPageSizeInBytes(): int
    {
        return $this->pageSizeInBytes;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle(): string
    {
        $title = $this->pageDOM->find('.productTitleDescriptionContainer > h1')[0];

        return trim(strip_tags($title->innerhtml));
    }

    /**
     * Get price per unit
     *
     * @return float
     */
    public function getPricePerUnit(): float
    {
        $pricePerUnit = $this->pageDOM->find('.pricePerUnit')[0];
        preg_match('#&pound;([\d.]+)<.+>#', $pricePerUnit->innerhtml, $matches);

        return floatval($matches[1]);
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(): string
    {
        $description = $this->pageDOM->find('.productText')[0];

        return trim(strip_tags($description->innerhtml));
    }

    /**
     * Get scraped product
     *
     * @return Product
     */
    public function getProduct(): Product
    {
        $product =  (new Product())
            ->setTitle($this->getTitle())
            ->setDescription($this->getDescription())
            ->setPricePerUnit($this->getPricePerUnit())
            ->setPageSizeInBytes($this->pageSizeInBytes);

        return $product;
    }
}
