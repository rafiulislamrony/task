<?php  
class EmployeeData {
    private $name;
    private $id;
    private $salary;  

    public function __construct($name, $id, $salary) { 
        $this->name = $name; 
        $this->id = $id;
        $this->salary = $salary;
    }  

    public function displayInfo() {
        echo "Employee ID: " . $this->id . "<br>";
        echo "Name: " . $this->name .  "<br>";
        echo "Salary: $" . $this->salary .  "<br>";
    } 
}
 

$employee1 = new EmployeeData("Rafiul", "ID001", 50000); 
$employee1->displayInfo();
 
?>