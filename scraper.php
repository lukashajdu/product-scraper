#!/usr/bin/env php

<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use ProductScraper\DataSource\GuzzleUrlSource;
use ProductScraper\ProductCollection;
use ProductScraper\ProductListPageScraper;
use ProductScraper\ProductPageScraper;
use ProductScraper\ProductResponseHandler;

require_once 'vendor/autoload.php';

if (!isset($argv[1])) {
    echo <<<TXT
Missing product list URL!

Usage: 
    ./scraper.php <scraped product list url>\n\n
TXT;
    die();
}

$url = $argv[1];
$client = new Client();

try {
    $source = new GuzzleUrlSource($url, $client);
} catch (ConnectException $e) {
    die("Invalid URL\n\n");
}

$productCollection = new ProductCollection();
$productList = new ProductListPageScraper($source);

foreach ($productList->getProductURLs() as $productURL) {
    $source = new GuzzleUrlSource($productURL, $client);
    $productCollection->add((new ProductPageScraper($source))->getProduct());
}

echo (new ProductResponseHandler($productCollection))->JSON() . "\n\n";
