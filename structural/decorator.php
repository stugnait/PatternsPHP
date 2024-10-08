<?php

interface Product {
    public function getPrice(): float;
    public function getDescription(): string;
}

class TShirt implements Product {
    public function getPrice(): float {
        return 20.0;
    }

    public function getDescription(): string {
        return "Футболка";
    }
}

abstract class ProductDecorator implements Product {
    protected $product;

    public function __construct(Product $product) {
        $this->product = $product;
    }

    public function getPrice(): float {
        return $this->product->getPrice();
    }

    public function getDescription(): string {
        return $this->product->getDescription();
    }
}

// Подарункова упаковка
class GiftWrap extends ProductDecorator {
    public function getPrice(): float {
        return $this->product->getPrice() + 5.0;
    }

    public function getDescription(): string {
        return $this->product->getDescription() . " у подарунковій упаковці";
    }
}

// Використання
$tshirt = new TShirt();
$giftWrapped = new GiftWrap($tshirt);
echo $giftWrapped->getDescription() . " коштує " . $giftWrapped->getPrice();
