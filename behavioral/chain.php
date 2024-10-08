<?php

// Інтерфейс обробника
interface DiscountHandler {
    public function setNext(DiscountHandler $handler): DiscountHandler;
    public function applyDiscount(float $price): float;
}

// Базовий клас обробника
abstract class BaseDiscountHandler implements DiscountHandler {
    private $nextHandler;

    public function setNext(DiscountHandler $handler): DiscountHandler {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function applyDiscount(float $price): float {
        if ($this->nextHandler) {
            return $this->nextHandler->applyDiscount($price);
        }
        return $price;
    }
}

// Обробник для звичайного клієнта
class RegularCustomerDiscountHandler extends BaseDiscountHandler {
    public function applyDiscount(float $price): float {
        if ($price > 100) {
            $price *= 0.95; // 5% знижка для звичайних клієнтів
        }
        return parent::applyDiscount($price);
    }
}

// Обробник для VIP клієнта
class VipCustomerDiscountHandler extends BaseDiscountHandler {
    public function applyDiscount(float $price): float {
        if ($price > 200) {
            $price *= 0.90; // 10% знижка для VIP клієнтів
        }
        return parent::applyDiscount($price);
    }
}

// Обробник для святкових знижок
class HolidayDiscountHandler extends BaseDiscountHandler {
    public function applyDiscount(float $price): float {
        $price *= 0.85; // 15% знижка на свята
        return parent::applyDiscount($price);
    }
}

// Використання
$regularHandler = new RegularCustomerDiscountHandler();
$vipHandler = new VipCustomerDiscountHandler();
$holidayHandler = new HolidayDiscountHandler();

// Створюємо ланцюг: Regular -> VIP -> Holiday
$regularHandler->setNext($vipHandler)->setNext($holidayHandler);

$price = 250;
echo "Оригінальна ціна: $price грн\n";
$finalPrice = $regularHandler->applyDiscount($price);
echo "Фінальна ціна зі знижкою: $finalPrice грн\n";
