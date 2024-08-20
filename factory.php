<?php

interface IBuyingInterface {
    public function buy();
}
class TShirt implements IBuyingInterface {
    public function buy()
    {
        echo "Ви красавчік, літом кайфово";
    }
}
class Sweater implements IBuyingInterface {
    public function buy()
    {
        echo "Ви дурачок, літом жарко";
    }
}

class ClothingFactory
{
    public function createClothing(string $type): IBuyingInterface
    {
        if ($type === 'tshirt') {
            return new TShirt();
        }
        elseif ($type === 'sweater') {
            return new Sweater();
        }
        else {
            throw new Exception("Харош братуха, найс вибрав, лови ексепшн");
        }
    }
}


$factory = new ClothingFactory();

$tshirt = $factory->createClothing('tshirt');
$tshirt->buy();

$sweater = $factory->createClothing('sweater');
$sweater->buy();