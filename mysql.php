<?php
$host = "localhost";
$name = "mydb";
$user = "justin";
$password = "test";
try{
    $mysql = new PDO("ysql:host=$host;dbname=$name", $user, $password);
} catch (PDOException $e) {
    echo "SQL Error: ".$e->getMessage();
}
?>
