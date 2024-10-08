<?php

// Інтерфейс компоненту
interface Product {
    public function getPrice(): float;
}

// Простий товар
class TShirt implements Product {
    public function getPrice(): float {
        return 20.0;
    }
}

// Композитний товар (набір)
class ProductBundle implements Product {
    private $products = [];

    public function addProduct(Product $product) {
        $this->products[] = $product;
    }

    public function getPrice(): float {
        $total = 0;
        foreach ($this->products as $product) {
            $total += $product->getPrice();
        }
        return $total;
    }
}

// Використання
$bundle = new ProductBundle();
$bundle->addProduct(new TShirt());
$bundle->addProduct(new TShirt());
echo "Ціна набору: " . $bundle->getPrice();
