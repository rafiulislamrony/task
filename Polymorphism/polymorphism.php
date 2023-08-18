<?php 
class Animal {
    public function makeSound() {
        return "Some sound";
    }
}

class Dog extends Animal {
    public function makeSound() {
        return "Woof woof!";
    }
}

class Cat extends Animal {
    public function makeSound() {
        return "Meow meow!";
    }
}
class Goat extends Animal {
    public function makeSound() {
        return "May May!";
    }
}

class Cow extends Animal {
    public function makeSound() {
        return "Moo moo!";
    }
}

$dog = new Dog();
$cat = new Cat();
$cow = new Cow();
$goat = new Goat();

echo "Dog Sound ". $dog->makeSound() . "<br> <br>";
echo "Cat Sound ". $cat->makeSound() . "<br><br>";
echo "Cow Sound ". $cow->makeSound() . "<br><br>";
echo "Goat Sound ". $goat->makeSound() . "<br><br>";
  
?>