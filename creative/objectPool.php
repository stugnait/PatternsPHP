<?php

interface IBuyingInterface
{
    public function buy();
}

class TShirt implements IBuyingInterface
{
    public function buy()
    {
        echo "Ви красавчік, літом кайфово\n";
    }
}

class Sweater implements IBuyingInterface
{
    public function buy()
    {
        echo "Ви дурачок, літом жарко\n";
    }
}

class ClothingPool
{
    private $availableTShirts = [];
    private $availableSweaters = [];
    private $inUse = [];

    public function getTShirt(): TShirt
    {
        if (!empty($this->availableTShirts)) {
            $tshirt = array_pop($this->availableTShirts);
        } else {
            $tshirt = new TShirt();
        }
        $this->inUse[] = $tshirt;
        return $tshirt;
    }

    public function getSweater(): Sweater
    {
        if (!empty($this->availableSweaters)) {
            $sweater = array_pop($this->availableSweaters);
        } else {
            $sweater = new Sweater();
        }
        $this->inUse[] = $sweater;
        return $sweater;
    }

    public function releaseClothing(IBuyingInterface $clothing)
    {
        if (($key = array_search($clothing, $this->inUse, true)) !== false) {
            unset($this->inUse[$key]);
            if ($clothing instanceof TShirt) {
                $this->availableTShirts[] = $clothing;
            } elseif ($clothing instanceof Sweater) {
                $this->availableSweaters[] = $clothing;
            }
        }
    }
}

// Використання Object Pool
$pool = new ClothingPool();

$tshirt1 = $pool->getTShirt();
$tshirt1->buy();

$sweater1 = $pool->getSweater();
$sweater1->buy();

$pool->releaseClothing($tshirt1);
$pool->releaseClothing($sweater1);

// Повторно використовуємо об'єкти
$tshirt2 = $pool->getTShirt();
$tshirt2->buy();

$sweater2 = $pool->getSweater();
$sweater2->buy();
