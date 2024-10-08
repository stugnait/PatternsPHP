<?php

// Інтерфейс одягу
interface Clothing {
    public function getType(): string;
}

// Реалізація конкретних типів одягу
class TShirt implements Clothing {
    public function getType(): string {
        return "Футболка";
    }
}

class Jeans implements Clothing {
    public function getType(): string {
        return "Джинси";
    }
}

// Flyweight фабрика
class ClothingFactory {
    private $clothingPool = [];

    public function getClothing($type): Clothing {
        if (!isset($this->clothingPool[$type])) {
            switch ($type) {
                case "TShirt":
                    $this->clothingPool[$type] = new TShirt();
                    break;
                case "Jeans":
                    $this->clothingPool[$type] = new Jeans();
                    break;
            }
        }
        return $this->clothingPool[$type];
    }
}

// Використання
$factory = new ClothingFactory();
$tshirt = $factory->getClothing("TShirt");
$jeans = $factory->getClothing("Jeans");

echo $tshirt->getType();  // Виведе: Футболка
echo $jeans->getType();   // Виведе: Джинси
