<?php
$host = "localhost";
$name = "mydb";
$user = "justin";
$password = "test";
try{
    $mysql = new PDO("mysql:host=$host;dbname=$name", $user, $password);
} catch (PDOException $e) {
    echo "SQL Error: ".$e->getMessage();
}
?>
