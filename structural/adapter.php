<?php

class OldDeliveryService {
    public function deliver($item) {
        echo "Доставка товару: " . $item;
    }
}

interface NewDeliveryService {
    public function ship($item);
}

class DeliveryAdapter implements NewDeliveryService {
    private $oldService;

    public function __construct(OldDeliveryService $oldService) {
        $this->oldService = $oldService;
    }

    public function ship($item) {
        $this->oldService->deliver($item);
    }
}

// Використання
$oldService = new OldDeliveryService();
$adapter = new DeliveryAdapter($oldService);
$adapter->ship("Футболка");
