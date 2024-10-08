<?php

interface Observer {
    public function update($message);
}

interface Subject {
    public function attach(Observer $observer);
    public function detach(Observer $observer);
    public function notify();
}

class Product implements Subject {
    private $observers = [];
    private $state;

    public function attach(Observer $observer) {
        $this->observers[] = $observer;
    }

    public function detach(Observer $observer) {
        $this->observers = array_filter($this->observers, function ($obs) use ($observer) {
            return $obs !== $observer;
        });
    }

    public function notify() {
        foreach ($this->observers as $observer) {
            $observer->update($this->state);
        }
    }

    public function setState($state) {
        $this->state = $state;
        $this->notify();
    }
}

class Customer implements Observer {
    public function update($message) {
        echo "Клієнт отримав повідомлення: $message\n";
    }
}

// Використання
$product = new Product();
$customer1 = new Customer();
$customer2 = new Customer();

$product->attach($customer1);
$product->attach($customer2);

$product->setState("Товар оновлено");
