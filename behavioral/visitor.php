<?php

interface Visitor {
    public function visitTShirt(TShirt $tshirt);
    public function visitJeans(Jeans $jeans);
}

interface Product {
    public function accept(Visitor $visitor);
}

class TShirt implements Product {
    public function accept(Visitor $visitor) {
        $visitor->visitTShirt($this);
    }
}

class Jeans implements Product {
    public function accept(Visitor $visitor) {
        $visitor->visitJeans($this);
    }
}

class DiscountVisitor implements Visitor {
    public function visitTShirt(TShirt $tshirt) {
        echo "Знижка на футболку\n";
    }

    public function visitJeans(Jeans $jeans) {
        echo "Знижка на джинси\n";
    }
}

$tshirt = new TShirt();
$jeans = new Jeans();
$visitor = new DiscountVisitor();

$tshirt->accept($visitor);
$jeans->accept($visitor);
