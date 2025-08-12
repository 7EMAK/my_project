<?php

namespace Classes;

require 'Animal.php';

class Dog extends Animal
{
    public function __construct()
    {
        parent::__construct('Barbik', '123', '14124', '124124');
        $this->bark = 'Gav';
    }

    public function getBark(): void
    {
        echo $this->bark . PHP_EOL;
    }

    public function getInfoAboutAnimal(): void
    {
        echo 'Name: ' . $this->name . PHP_EOL;
    }
}

$barbos = new Dog('Barbik', '123', '14124', '124124');

$barbos->getInfoAboutAnimal();

$barbos->getBark();