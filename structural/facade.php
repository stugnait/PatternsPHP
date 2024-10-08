<?php

// Клас для оплати
class PaymentService {
    public function processPayment($amount) {
        echo "Оплата на суму: $amount грн.\n";
    }
}

// Клас для доставки
class ShippingService {
    public function shipItem($item) {
        echo "Відправка товару: $item\n";
    }
}

// Фасад
class ShopFacade {
    private $paymentService;
    private $shippingService;

    public function __construct() {
        $this->paymentService = new PaymentService();
        $this->shippingService = new ShippingService();
    }

    public function buyItem($item, $amount) {
        $this->paymentService->processPayment($amount);
        $this->shippingService->shipItem($item);
    }
}

// Використання
$shop = new ShopFacade();
$shop->buyItem("Футболка", 200);
