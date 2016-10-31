<?php

namespace ProductScraper;

use ProductScraper\Exception\UndefinedPropertyException;

/**
 * Product
 *
 * @author Lukas Hajdu <hello@lukashajdu.com>
 * @copyright Lukas Hajdu <http://lukashajdu.com>, 2016
 * @package ProductScraper
 */
class Product
{
    /**
     * Title
     *
     * @var string
     */
    private $title;

    /**
     * Product page size in bytes
     *
     * @var int
     */
    private $pageSizeInBytes;

    /**
     * Price per unit
     *
     * @var float
     */
    private $pricePerUnit;

    /**
     * Description
     *
     * @var string
     */
    private $description;

    /**
     * Get title
     *
     * @return string
     * @throws UndefinedPropertyException
     */
    public function getTitle(): string
    {
        if ($this->title === null) {
            throw new UndefinedPropertyException();
        }

        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return $this
     */
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get page size in bytes
     *
     * @return int
     * @throws UndefinedPropertyException
     */
    public function getPageSizeInBytes(): int
    {
        if ($this->pageSizeInBytes === null) {
            throw new UndefinedPropertyException();
        }

        return $this->pageSizeInBytes;
    }

    /**
     * Set page size in bytes
     *
     * @param mixed $pageSizeInBytes
     *
     * @return $this
     */
    public function setPageSizeInBytes(int $pageSizeInBytes)
    {
        $this->pageSizeInBytes = $pageSizeInBytes;

        return $this;
    }

    /**
     * Get page size in kilobits
     *
     * @return float
     * @throws UndefinedPropertyException
     */
    public function getPageSizeInKiloBits(): float
    {
        if ($this->pageSizeInBytes === null) {
            throw new UndefinedPropertyException();
        }

        return ($this->pageSizeInBytes * 8) / 1000;
    }

    /**
     * Get price per unit
     *
     * @return float
     * @throws UndefinedPropertyException
     */
    public function getPricePerUnit(): float
    {
        if ($this->pricePerUnit === null) {
            throw new UndefinedPropertyException();
        }

        return $this->pricePerUnit;
    }

    /**
     * Set price per unit
     *
     * @param float $pricePerUnit
     *
     * @return $this
     */
    public function setPricePerUnit(float $pricePerUnit)
    {
        $this->pricePerUnit = $pricePerUnit;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     * @throws UndefinedPropertyException
     */
    public function getDescription(): string
    {
        if ($this->description === null) {
            throw new UndefinedPropertyException();
        }

        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return $this
     */
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }
}
