<?php
namespace PHPBr\Shopping;

interface DeliverableProduct extends Product
{
    /**
     * @return \PHPBr\Shopping\ProductDimensions
     */
    public function getDimensions();
}
