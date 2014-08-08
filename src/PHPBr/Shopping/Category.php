<?php
namespace PHPBr\Shopping;

interface Category extends IteratorAggregate
{
    /**
     * @return boolean
     */
    public function hasParent();

    /**
     * @return boolean
     */
    public function hasChild();

    /**
     * @return \Iterator<\PHPBr\Shopping\Category>
     */
    public function getChildrenCategoryIterator();

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return \PHPBr\Shopping\Category
     */
    public function getParent();

    /**
     * @return \Iterator<\PHPBr\Shopping\Product>
     * @see \PHPBr\Shopping\Category::getIterator()
     */
    public function getProductIterator();
}
