<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Erfolgreich eingeloggt</title>
</head>
<h1>Du hast dich erfolgreich eingeloggt</h1>
<?php
include ("mysql.php");
global $mysql;
session_start();
$username = $_SESSION["username"];

echo "Willkommen $username";
?>

<br>
<br>
<br>
<button type="submit" name="submit">Ausloggen</button>
