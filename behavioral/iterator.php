<?php

interface IteratorInterface {
    public function hasNext(): bool;
    public function next();
}

interface Collection {
    public function getIterator(): IteratorInterface;
}

class Product {
    public $name;

    public function __construct($name) {
        $this->name = $name;
    }
}

class ProductCollection implements Collection {
    private $products = [];

    public function addProduct(Product $product) {
        $this->products[] = $product;
    }

    public function getIterator(): IteratorInterface {
        return new ProductIterator($this->products);
    }
}

class ProductIterator implements IteratorInterface {
    private $products;
    private $position = 0;

    public function __construct(array $products) {
        $this->products = $products;
    }

    public function hasNext(): bool {
        return $this->position < count($this->products);
    }

    public function next() {
        return $this->products[$this->position++];
    }
}

// Використання
$collection = new ProductCollection();
$collection->addProduct(new Product("Футболка"));
$collection->addProduct(new Product("Джинси"));
$collection->addProduct(new Product("Куртка"));

$iterator = $collection->getIterator();
while ($iterator->hasNext()) {
    $product = $iterator->next();
    echo $product->name . "\n";
}
