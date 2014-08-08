<?php
namespace PHPBr\Shopping;

class ProductDimensions
{
    /**
     * @var float
     */
    private $height = 0.0;

    /**
     * @var float
     */
    private $length = 0.0;

    /**
     * @var float
     */
    private $weight = 0.0;

    /**
     * @var float
     */
    private $width = 0.0;

    /**
     * @param float $height
     * @param float $length
     * @param float $weight
     * @param float $width
     */
    public function __construct($height, $length, $weight, $width)
    {
        $this->setHeight($height);
        $this->setLength($length);
        $this->setWeight($weight);
        $this->setWidth($width);
    }

    /**
     * @return float
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @return float
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @return float
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param float $height
     */
    public function setHeight($height)
    {
        $this->height = $height * 1.0;
    }

    /**
     * @param float $length
     */
    public function setLength($length)
    {
        $this->length = $length * 1.0;
    }

    /**
     * @param float $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight * 1.0;
    }

    /**
     * @param float $width
     */
    public function setWidth($width)
    {
        $this->width = $width * 1.0;
    }
}
