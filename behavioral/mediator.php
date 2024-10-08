<?php

// Інтерфейс посередника
interface Mediator {
    public function notify($sender, $event);
}

// Клас посередника, що координує компоненти
class ShopMediator implements Mediator {
    private $customer;
    private $product;
    private $order;

    public function setCustomer(Customer $customer) {
        $this->customer = $customer;
    }

    public function setProduct(Product $product) {
        $this->product = $product;
    }

    public function setOrder(Order $order) {
        $this->order = $order;
    }

    public function notify($sender, $event) {
        if ($event === "buy") {
            $this->product->checkAvailability();
            $this->order->createOrder();
            $this->customer->sendNotification();
        }
    }
}

// Клас клієнта
class Customer {
    private $mediator;

    public function __construct(Mediator $mediator) {
        $this->mediator = $mediator;
    }

    public function buyProduct() {
        echo "Клієнт хоче купити товар\n";
        $this->mediator->notify($this, "buy");
    }

    public function sendNotification() {
        echo "Клієнту надіслано повідомлення про покупку\n";
    }
}

// Клас товару
class Product {
    private $mediator;

    public function __construct(Mediator $mediator) {
        $this->mediator = $mediator;
    }

    public function checkAvailability() {
        echo "Товар є в наявності\n";
    }
}

// Клас замовлення
class Order {
    private $mediator;

    public function __construct(Mediator $mediator) {
        $this->mediator = $mediator;
    }

    public function createOrder() {
        echo "Замовлення створено\n";
    }
}

// Використання
$mediator = new ShopMediator();

$customer = new Customer($mediator);
$product = new Product($mediator);
$order = new Order($mediator);

$mediator->setCustomer($customer);
$mediator->setProduct($product);
$mediator->setOrder($order);

$customer->buyProduct();
