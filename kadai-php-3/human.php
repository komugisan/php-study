<?php

require_once('animal.php');
require_once('thinkable.php');

class Human extends Animal{
    use Thinkable;

    public $hobby;

    function __construct($name,$age,$hobby = ''){
        $this->name = $name;
        $this->age = $age;
        $this->hobby = $hobby;
    }

}