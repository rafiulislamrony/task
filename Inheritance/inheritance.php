<?php

class Shape
{
    public $width;
    public $height;
    public $radius;
 
}

class Circle extends Shape
{
    public function __construct($radius)
    {
        $this->radius = $radius;
    }

    public function calculateArea()
    {
        return pi() * $this->radius * $this->radius;
    }
}

class Rectangle extends Shape
{
    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function calculateArea()
    {
        return  $this->width * $this->height;
    }
}
 
// Object Circle   
$obj1 = new Circle(3);
echo "Circle Area: ". $obj1->calculateArea() . "<br>";

// Object Circle   
$obj2 = new Rectangle(3, 3);
echo "Rectangle Area: ". $obj2->calculateArea();

?>