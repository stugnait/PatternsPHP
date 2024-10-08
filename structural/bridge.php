<?php

interface Color {
    public function applyColor(): string;
}

class RedColor implements Color {
    public function applyColor(): string {
        return "Червоний";
    }
}

class BlueColor implements Color {
    public function applyColor(): string {
        return "Синій";
    }
}

abstract class Clothing {
    protected $color;

    public function __construct(Color $color) {
        $this->color = $color;
    }

    abstract public function getDescription(): string;
}

class TShirt extends Clothing {
    public function getDescription(): string {
        return "Футболка кольору " . $this->color->applyColor();
    }
}

$tshirt = new TShirt(new RedColor());
echo $tshirt->getDescription();
