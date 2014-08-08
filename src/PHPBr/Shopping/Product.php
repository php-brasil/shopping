<?php
namespace PHPBr\Shopping;

interface Product
{
    /**
     * @return \PHPBr\Shopping\Category
     */
    public function getCategory();

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return float
     */
    public function getPrice();
}
