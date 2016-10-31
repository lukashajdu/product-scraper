<?php

namespace ProductScraper\DataSource;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use PHPUnit_Framework_TestCase as TestCase;
use ProductScraper\Exception\InvalidSourceContentException;

/**
 * Guzzle URL Source Test
 *
 * @author Lukas Hajdu <hello@lukashajdu.com>
 * @copyright Lukas Hajdu <http://lukashajdu.com>, 2016
 * @package ProductScraper
 */
class GuzzleUrlSourceTest extends TestCase
{
    /**
     * @covers \ProductScraper\DataSource\GuzzleUrlSource::__construct
     */
    public function testConstructorException()
    {
        $response = $this->createMock(Response::class);
        $response->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(404);
        $client = $this->createMock(Client::class);
        $client->expects($this->once())
            ->method('request')
            ->will($this->returnValue($response));

        $this->expectException(InvalidSourceContentException::class);
        $this->expectExceptionMessage('Unable to get a data from the URL: "url"');

        new GuzzleUrlSource('url', $client);
    }

    /**
     * @covers \ProductScraper\DataSource\GuzzleUrlSource::__construct
     * @covers \ProductScraper\DataSource\GuzzleUrlSource::getContent
     * @covers \ProductScraper\DataSource\GuzzleUrlSource::getSizeInBytes
     */
    public function testConstructorAndGetter()
    {
        $body = 'content body';
        $size = strlen($body);

        $stream = $this->createMock(Stream::class);
        $stream->expects($this->once())
            ->method('getContents')
            ->willReturn($body);
        $stream->expects($this->once())
            ->method('getSize')
            ->willReturn($size);
        $response = $this->createMock(Response::class);
        $response->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(200);
        $response->expects($this->exactly(2))
            ->method('getBody')
            ->willReturn($stream);
        $client = $this->createMock(Client::class);
        $client->expects($this->once())
            ->method('request')
            ->will($this->returnValue($response));

        $source = new GuzzleUrlSource('url', $client);

        $this->assertEquals($body, $source->getContent());
        $this->assertEquals($size, $source->getSizeInBytes());
    }
}
