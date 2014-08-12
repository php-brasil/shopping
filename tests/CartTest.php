<?php
namespace PHPBr\Shopping;

class CartTest extends \PHPUnit_Framework_TestCase
{
    private function createProduct($id, $price)
    {
        $product = $this->getMockBuilder('\PHPBr\Shopping\Product')
            ->setMethods(array('getCategory',
                               'getDescription',
                               'getId',
                               'getName',
                               'getPrice'))
            ->getMock();

        $product->method('getId')
            ->will($this->returnValue($id));

        $product->method('getPrice')
                ->will($this->returnValue($price));

        return $product;
    }

    /**
     * @testdox Add different items to the cart will increase the item count
     */
    public function testAddItemWillChangeItemCount()
    {
        $cart = new Cart();

        $this->assertCount(0, $cart);

        $cart->addItem($this->createProduct(1, 100), 1);

        $this->assertCount(1, $cart);

        $cart->addItem($this->createProduct(2, 100), 1);

        $this->assertCount(2, $cart);
    }

    /**
     * @testdox Add the same item to the cart will not increase the item count
     */
    public function testAddSameItemWillNotChangeItemCount()
    {
        $cart = new Cart();

        $this->assertCount(0, $cart);

        $product = $this->createProduct(1, 100);

        $cart->addItem($product, 1);

        $this->assertCount(1, $cart);

        $cart->addItem($product, 2);

        $this->assertCount(1, $cart);
    }

    /**
     * @testdox Add the same item to the cart will increase its quantity
     */
    public function testAddSameItemWillIncreaseItsQuantity()
    {
        $cart = new Cart();

        $product = $this->createProduct(1, 100);
        $quantity = 1;

        $cart->addItem($product, $quantity);

        $this->assertCount(1, $cart);
        $this->assertSame($product, $cart->getIterator()->current());
        $this->assertEquals($quantity, $cart->getIterator()->key());

        $cart->addItem($product, $quantity);

        $this->assertCount(1, $cart);
        $this->assertSame($product, $cart->getIterator()->current());
        $this->assertEquals($quantity * 2, $cart->getIterator()->key());
    }

    /**
     * @testdox getIterator will return an iterator with all items in the cart
     */
    public function testGetIteratorWillReturnAnIteratorOfCartItems()
    {
        $cart = new Cart();

        $products = [$this->createProduct(1, 100),
                     $this->createProduct(2, 100),
                     $this->createProduct(3, 100)];

        $productCount = count($products);

        foreach ($products as $product) {
            $cart->addItem($product, 1);
        }

        $this->assertCount($productCount, $cart);

        $iterator = $cart->getIterator();

        for ($i = 0; $i < $productCount; ++$i) {
            $current = $iterator->current();

            $this->assertSame($products[$i], $current);

            $iterator->next();
        }

        $this->assertFalse($iterator->valid());
    }

    /**
     * @expectedException \DomainException
     * @expectedExceptionMessage Can't remove. Product not found.
     * @testdox removeItem before add it will throw a DomainException
     */
    public function testRemoveItemBeforeAddItWillThrowAnException()
    {
        $cart = new Cart();
        $cart->removeItem($this->createProduct(1, 100));
    }

    /**
     * @testdox removeItem without specify quantity will completely remove item from cart
     */
    public function testRemoveItemWithZeroWillRemoveItemFromCart()
    {
        $product = $this->createProduct(1, 100);
        $cart = new Cart();

        $cart->addItem($product, 1);

        $this->assertCount(1, $cart);

        $cart->removeItem($product);

        $this->assertCount(0, $cart);
    }

    /**
     * @testdox removeItem will decrease its quantity
     */
    public function testRemoveItemWillDecreaseItsQuantity()
    {
        $quantity = 10;
        $product = $this->createProduct(1, 100);
        $cart = new Cart();

        $cart->addItem($product, $quantity);
        $cart->removeItem($product, $quantity / 2);

        $this->assertEquals($quantity / 2, $cart->getIterator()->key());
    }

    /**
     * @testdox removeItem with quantity grater than has in the cart, will remove the item
     */
    public function testRemoveItemWithGreaterQuantityWillRemoveItem()
    {
        $cart = new Cart();
        $product = $this->createProduct(1, 100);

        $cart->addItem($product, 10);

        $this->assertCount(1, $cart);

        $cart->removeItem($product, 20);

        $this->assertCount(0, $cart);
    }
}
