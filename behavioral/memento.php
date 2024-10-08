<?php

class Memento {
    private $state;

    public function __construct($state) {
        $this->state = $state;
    }

    public function getState() {
        return $this->state;
    }
}

class Originator {
    private $state;

    public function setState($state) {
        echo "Збереження стану: $state\n";
        $this->state = $state;
    }

    public function saveStateToMemento() {
        return new Memento($this->state);
    }

    public function getStateFromMemento(Memento $memento) {
        $this->state = $memento->getState();
        echo "Відновлення стану: $this->state\n";
    }
}

class Caretaker {
    private $mementos = [];

    public function addMemento(Memento $memento) {
        $this->mementos[] = $memento;
    }

    public function getMemento($index) {
        return $this->mementos[$index];
    }
}

$originator = new Originator();
$caretaker = new Caretaker();

$originator->setState("Стан #1");
$caretaker->addMemento($originator->saveStateToMemento());

$originator->setState("Стан #2");
$caretaker->addMemento($originator->saveStateToMemento());

$originator->setState("Стан #3");
$originator->getStateFromMemento($caretaker->getMemento(1));
