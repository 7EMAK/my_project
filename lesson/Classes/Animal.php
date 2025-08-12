<?php

namespace Classes;

include 'Thing.php';

class Animal extends Thing
{
    // Svoistva
    private string $name;
    private string $weight;
    private string $height;
    private string $speed;

    // Magicheskiy metod __construct
    public function __construct(string $name, string $weight, string $height, string $speed) {
        $this->name = $name;
        $this->weight = $weight;
        $this->height = $height;
        $this->speed = $speed;
    }

//  Magicheskiy metod
    public function getInfoAboutAnimal(): void
    {
        $this->getName();
        $this->getWeight();
        $this->getHeight();
        $this->getSpeed();
    }

    public function getShortInfo(): void
    {
        $this->getName();
        $this->getHeight();
    }

    private function getName(): void
    {
        echo $this->name . PHP_EOL;
    }

    private function getWeight(): void
    {
        echo $this->weight . PHP_EOL;
    }

    private function getHeight(): void
    {
        echo $this->height . PHP_EOL;
    }

    private function getSpeed(): void
    {
        echo $this->speed . PHP_EOL;
    }
}

//// Sozdanie ekzemplyara klassa  - object
$cat = new Animal('Kotik','5 kg', '50 sm', '100 km/s');
//
//$dog = new Animal('Sabaka','10 kg', '150 sm', '200 km/s');
//
////    var_dump($cat);
////
////    var_dump($dog);
//
$cat->getShortInfo();
//
//$cat->
//var_dump();

//    $dog->getInfoAboutAnimal();