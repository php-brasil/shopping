<?php
namespace PHPBr\Shopping;

class Cart implements \Countable, \IteratorAggregate, \Serializable
{
    /**
     * @var \PHPBr\Shopping\Product[]
     */
    private $items = [];

    /**
     * @var int[]
     */
    private $quantities = [];

    /**
     * @param \PHPBr\Shopping\Product $product
     * @param int $quantity
     */
    public function addItem(Product $product, $quantity)
    {
        $id = $product->getId();

        if (!isset($this->items[$id])) {
            $this->items[$id] = $product;
            $this->quantities[$id] = 0;
        }

        $this->quantities[$id] += $quantity * 1;
    }

    /**
     * @return int
     * @see \Countable::count()
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * @return \Iterator<\PHPBr\Shopping\Product>
     * @see \IteratorAggregate::getIterator()
     */
    public function getIterator()
    {
        foreach ($this->items as $id => $product) {
            yield $this->quantities[$id] => $product;
        }
    }

    /**
     * @param \PHPBr\Shopping\Product $product
     * @param int $quantity
     */
    public function removeItem(Product $product, $quantity = 0)
    {
        $id = $product->getId();

        if (!isset($this->items[$id])) {
            throw new \DomainException('Can\'t remove. Product not found.');
            return;
        }

        if ($quantity > 0) {
            $this->quantities[$id] -= $quantity * 1;
        }

        if ($this->quantities[$id] <= 0 || $quantity <= 0) {
            unset($this->items[$id]);
            unset($this->quantities[$id]);
        }
    }

    /**
     * @return string
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array('items' => $this->items,
                               'quantities' => $this->quantities));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        $data = unserialize($serialized);

        if (!is_array($data) || !isset($data['items']) || !isset($data['quantities'])) {
            throw new \UnexpectedValueException('Unexpected serialized data provided');
        }

        foreach ($data['items'] as $id => $product) {
            if (!isset($data['quantities'][$id])) {
                continue;
            }
            
            $this->addProduct($product, $data['quantities'][$id]);
        }
    }
}
