<?php

class Animal {
    public $name;
    public $age;

    function say(){
        print $this->name . "です。" . $this->age . "歳です。" .PHP_EOL ;
    }
}