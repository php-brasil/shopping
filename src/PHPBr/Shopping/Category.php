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
     * @return \Iterator<Category>
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
     * @return \Neto\Shopping\Category
     */
    public function getParent();

    /**
     * @return \Iterator<Product>
     * @see Category::getIterator()
     */
    public function getProductIterator();
}
