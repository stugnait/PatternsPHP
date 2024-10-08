<?php

interface State {
    public function handle();
}

// Конкретні стани
class AvailableState implements State {
    public function handle() {
        echo "Товар доступний для замовлення.\n";
    }
}

class OutOfStockState implements State {
    public function handle() {
        echo "Товар недоступний, немає в наявності.\n";
    }
}

class Product {
    private $state;

    public function __construct(State $state) {
        $this->setState($state);
    }

    public function setState(State $state) {
        $this->state = $state;
    }

    public function request() {
        $this->state->handle();
    }
}

$product = new Product(new AvailableState());
$product->request();

$product->setState(new OutOfStockState());
$product->request();
