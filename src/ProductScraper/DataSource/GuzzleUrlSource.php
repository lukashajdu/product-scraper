<?php

namespace ProductScraper\DataSource;

use GuzzleHttp\ClientInterface;
use ProductScraper\Exception\InvalidSourceContentException;

/**
 * Guzzle URL Source
 *
 * @author Lukas Hajdu <hello@lukashajdu.com>
 * @copyright Lukas Hajdu <http://lukashajdu.com>, 2016
 * @package ProductScraper
 */
class GuzzleUrlSource implements DataSourceInterface
{
    /**
     * Page content
     *
     * @var string
     */
    private $pageContent;

    /**
     * Page size
     *
     * @var int
     */
    private $pageSizeInBytes;

    /**
     * Constructor
     *
     * @param string $url
     * @param ClientInterface $client
     *
     * @throws InvalidSourceContentException
     */
    public function __construct(string $url, ClientInterface $client)
    {
        $response = $client->request('GET', $url);
        if ($response->getStatusCode() !== 200) {
            throw new InvalidSourceContentException(sprintf(
                'Unable to get a data from the URL: "%s"',
                $url
            ));
        }

        $this->pageContent = $response->getBody()->getContents();
        $this->pageSizeInBytes = $response->getBody()->getSize();
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(): string
    {
        return $this->pageContent;
    }

    /**
     * {@inheritdoc}
     */
    public function getSizeInBytes(): int
    {
        return $this->pageSizeInBytes;
    }
}
