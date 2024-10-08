<?php
interface TShirtInterface {
    public function buy();
}
interface SweaterInterface {
    public function buy();
}

class SportTShirt implements TShirtInterface {
    public function buy(){
        echo "SportTShirt\n";
    }
}
class ClassicTShirt implements TShirtInterface {
    public function buy(){
        echo "ClassicTShirt\n";
    }
}

class SportSweater implements SweaterInterface {
    public function buy(){
        echo "SportSweater.\n";
    }
}
class ClassicSweater implements SweaterInterface {
    public function buy(){
        echo "ClassicSweater.\n";
    }
}


interface ClothingFactoryInterface
{
    public function createTShirt(): TShirtInterface;

    public function createSweater(): SweaterInterface;
}

class SportClothingFactory implements ClothingFactoryInterface
{
    public function createTShirt(): TShirtInterface
    {
        return new SportTShirt();
    }

    public function createSweater(): SweaterInterface
    {
        return new SportSweater();
    }
}

class ClassicClothingFactory implements ClothingFactoryInterface
{
    public function createTShirt(): TShirtInterface
    {
        return new ClassicTShirt();
    }

    public function createSweater(): SweaterInterface
    {
        return new ClassicSweater();
    }
}

$sportFactory = new SportClothingFactory();
$classicFactory = new ClassicClothingFactory();

$sportTShirt = $sportFactory->createTShirt();
$sportSweater = $sportFactory->createSweater();

$sportTShirt->buy();
$sportSweater->buy();

$classicTShirt = $classicFactory->createTShirt();
$classicSweater = $classicFactory->createSweater();
$classicTShirt->buy();
$classicSweater->buy();