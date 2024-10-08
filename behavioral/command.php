<?php

// Інтерфейс команди
interface Command {
    public function execute(): void;
}

// Рецепт (Receiver) — клас для операцій з кошиком
class ShoppingCart {
    private $items = [];

    public function addItem($item) {
        $this->items[] = $item;
        echo "Товар $item додано в кошик.\n";
    }

    public function removeItem($item) {
        $index = array_search($item, $this->items);
        if ($index !== false) {
            unset($this->items[$index]);
            echo "Товар $item видалено з кошика.\n";
        }
    }

    public function purchase() {
        if (empty($this->items)) {
            echo "Кошик порожній, нічого купувати.\n";
        } else {
            echo "Товари " . implode(", ", $this->items) . " придбані.\n";
            $this->items = [];
        }
    }
}

// Команда для додавання товару
class AddItemCommand implements Command {
    private $cart;
    private $item;

    public function __construct(ShoppingCart $cart, $item) {
        $this->cart = $cart;
        $this->item = $item;
    }

    public function execute(): void {
        $this->cart->addItem($this->item);
    }
}

// Команда для видалення товару
class RemoveItemCommand implements Command {
    private $cart;
    private $item;

    public function __construct(ShoppingCart $cart, $item) {
        $this->cart = $cart;
        $this->item = $item;
    }

    public function execute(): void {
        $this->cart->removeItem($this->item);
    }
}

// Команда для здійснення покупки
class PurchaseCommand implements Command {
    private $cart;

    public function __construct(ShoppingCart $cart) {
        $this->cart = $cart;
    }

    public function execute(): void {
        $this->cart->purchase();
    }
}

// Використання
$cart = new ShoppingCart();
$addTShirt = new AddItemCommand($cart, "Футболка");
$addJeans = new AddItemCommand($cart, "Джинси");
$removeJeans = new RemoveItemCommand($cart, "Джинси");
$purchase = new PurchaseCommand($cart);

// Виконання команд
$addTShirt->execute();
$addJeans->execute();
$removeJeans->execute();
$purchase->execute();
