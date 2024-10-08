<?php


abstract class OrderProcessTemplate {
    public final function processOrder() {
        $this->selectItem();
        $this->makePayment();
        $this->deliver();
    }

    protected abstract function selectItem();
    protected abstract function makePayment();
    protected abstract function deliver();
}


class OnlineOrder extends OrderProcessTemplate {
    protected function selectItem() {
        echo "Товар обрано в онлайн магазині\n";
    }

    protected function makePayment() {
        echo "Оплата здійснена через онлайн банкінг\n";
    }

    protected function deliver() {
        echo "Товар доставлений кур'єром\n";
    }
}


$order = new OnlineOrder();
$order->processOrder();
