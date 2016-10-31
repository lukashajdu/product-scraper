<?php

namespace ProductScraper\DataSource;

/**
 * Data Source Interface
 *
 * @author Lukas Hajdu <hello@lukashajdu.com>
 * @copyright Lukas Hajdu <http://lukashajdu.com>, 2016
 * @package ProductScraper
 */
interface DataSourceInterface
{
    /**
     * Get data content
     *
     * @return string
     */
    public function getContent(): string;

    /**
     * Get data size in bytes
     *
     * @return int
     */
    public function getSizeInBytes(): int;
}
