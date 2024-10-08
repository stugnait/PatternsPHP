<?php

// Інтерфейс Стратегії
interface DiscountStrategy {
    public function getDiscount($price);
}

// Конкретні стратегії
class NoDiscount implements DiscountStrategy {
    public function getDiscount($price) {
        return $price;
    }
}

class PercentageDiscount implements DiscountStrategy {
    private $percentage;

    public function __construct($percentage) {
        $this->percentage = $percentage;
    }

    public function getDiscount($price) {
        return $price - ($price * $this->percentage / 100);
    }
}

// Контекст
class Product {
    private $strategy;

    public function __construct(DiscountStrategy $strategy) {
        $this->strategy = $strategy;
    }

    public function setStrategy(DiscountStrategy $strategy) {
        $this->strategy = $strategy;
    }

    public function getPrice($price) {
        return $this->strategy->getDiscount($price);
    }
}

// Використання
$product = new Product(new NoDiscount());
echo "Ціна без знижки: " . $product->getPrice(100) . "\n";

$product->setStrategy(new PercentageDiscount(10));
echo "Ціна зі знижкою 10%: " . $product->getPrice(100) . "\n";
