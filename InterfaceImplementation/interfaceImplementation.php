<?php

interface Logging
{
    public function log($name, $password);
}

class FileLogger implements Logging
{
    private $logtext;

    public function __construct($logtext)
    {
        $this->logtext = $logtext;
    }

    public function log($name, $password)
    {   $logMessage = "Name: $name, Password: $password\n";
        file_put_contents($this->logtext, $logMessage, FILE_APPEND);
    }
}

class DatabaseLogger implements Logging
{
    private $dbConnection;

    public function __construct($host, $dbname, $username, $password)
    {
        $dsn = "mysql:host=$host;dbname=$dbname";
        try {
            $this->dbConnection = new PDO($dsn, $username, $password);
            $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function log($name, $password)
    {
        if ($this->dbConnection) { 
            $sql = "INSERT INTO logintable (name, password) VALUES (?, ?)";
            $stmt = $this->dbConnection->prepare($sql);
            $stmt->execute([$name, $password]);
        } else {
            echo "Database connection is not available.";
        }
    }
}


// Usage
$fileLogger = new FileLogger('log.txt');
  
$fileLogger->log("Rafiul from Filelogger", "12345");

$host = "localhost";
$dbname = "authdb";
$username = "root";
$password = "";

$databaseLogger = new DatabaseLogger($host, $dbname, $username, $password);
$databaseLogger->log("Rafiul from DatabaseLogger", "12345"); 

?>