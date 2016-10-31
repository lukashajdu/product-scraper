Product Scraper
===============

Simple application to scrape a product list.

## Running the scraper

1. Install [Composer](https://getcomposer.org/download/) dependencies:

 ```
 $ composer.phar install
 ```
1. Mark the `scraper.php` file as executable:

 ```
 $ chmod +X scraper.php
 ```
1. Run the scraper

 ```
 $ ./scraper.php <scraped product list url>
 ```

## Running tests

Tests can be run from the project root with the following script:

```
./vendor/bin/phpunit
```
