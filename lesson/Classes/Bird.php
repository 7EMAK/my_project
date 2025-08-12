<?php

namespace Classes;
require 'Animal.php';

class Bird extends Animal
{

}

$penguin = new Bird('Chaika', '123', '14124', '124124');

$penguin->getInfoAboutAnimal();