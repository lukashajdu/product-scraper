<?php

namespace ProductScraper\DataSource;

/**
 * File Source
 *
 * @author Lukas Hajdu <hello@lukashajdu.com>
 * @copyright Lukas Hajdu <http://lukashajdu.com>, 2016
 * @package ProductScraper
 */
class FileSource implements DataSourceInterface
{
    /**
     * Name of the file to read
     *
     * @var string
     */
    private $filename;

    /**
     * Constructor
     *
     * @param string $filename
     */
    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(): string
    {
        $content = file_get_contents($this->filename);

        return $content !== false ? $content : '';
    }

    /**
     * {@inheritdoc}
     */
    public function getSizeInBytes(): int
    {
        return strlen($this->getContent());
    }
}
