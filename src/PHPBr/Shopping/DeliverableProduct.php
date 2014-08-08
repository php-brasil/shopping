<?php
namespace PHPBr\Shopping;

interface DeliverableProduct extends Product
{
    /**
     * @return \Neto\Shopping\ProductDimensions
     */
    public function getDimensions();
}
