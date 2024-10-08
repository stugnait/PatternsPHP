<?php

class TShirt {
    private $size;
    private $color;
    private $material;

    public function setSize(string $size){
        $this->size = $size;
    }

    public function setColor(string $color){
        $this->color = $color;
    }

    public function setMaterial(string $material) {
        $this->material = $material;
    }

    public function show()
    {
        echo $this->size . ' ' . $this->color . ' ' . $this->material;
    }
}


interface TShirtBuilderInterface
{
    public function setSize(string $size);

    public function setColor(string $color);

    public function setMaterial(string $material);

    public function getResult(): TShirt;
}

class TShirtBuilder implements TShirtBuilderInterface {
    private $tShirt;

    public function __construct() {
        $this->tShirt = new TShirt();
    }

    public function setSize(string $size){
        $this->tShirt->setSize($size);
    }

    public function setColor(string $color){
        $this->tShirt->setColor($color);
    }

    public function setMaterial(string $material){
        $this->tShirt->setMaterial($material);
    }

    public function getResult(): TShirt {
        return $this->tShirt;
    }
}

class TShirtDirector
{
    private $builder;

    public function __construct(TShirtBuilderInterface $builder)
    {
        $this->builder = $builder;
    }

    public function buildCasualTShirt()
    {
        $this->builder->setSize('M');
        $this->builder->setColor('Blue');
        $this->builder->setMaterial('Cotton');
    }

    public function buildSportTShirt()
    {
        $this->builder->setSize('L');
        $this->builder->setColor('Black');
        $this->builder->setMaterial('Silk');
    }
}

$builder = new TShirtBuilder();
$director = new TShirtDirector($builder);

$director->buildCasualTShirt();

$casualTShirt = $builder->getResult();
$casualTShirt->show();

$director->buildSportTShirt();

$formalTShirt = $builder->getResult();
$formalTShirt->show();