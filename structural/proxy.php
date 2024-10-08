<?php

// Інтерфейс товару
interface Product    {
    public function getPrice(): float;
}

// Реальний товар
class RealTShirt implements Product {
    public function getPrice(): float {
        return 20.0;
    }
}

// Замісник товару
class TShirtProxy implements Product {
    private $realTShirt;

    public function getPrice(): float {
        if ($this->realTShirt == null) {
            $this->realTShirt = new RealTShirt();
        }
        return $this->realTShirt->getPrice();
    }
}

// Використання
$proxy = new TShirtProxy();
echo $proxy->getPrice();
