<?php
class Product {
    public $name;
    public $category;
    public $price;
    public $isCloned;

    public function show()
    {
        echo $this->name . "\n" . $this->category . "\n" . $this->price . "\n" . $this->isCloned . "\n";

    }
    public function __construct($name, $category, $price) {
        $this->name = $name;
        $this->category = $category;
        $this->price = $price;
        $this->isCloned = false;
    }

    public function __clone() {
        $this->isCloned = true;
    }
}

$originalProduct = new Product("Shirt", "Clothing", 29.99);
$clonedProduct = clone $originalProduct;

$clonedProduct->name = "Coat";
$clonedProduct->price = 19.99;

$originalProduct->show();
$clonedProduct->show();
