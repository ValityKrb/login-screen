<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Account erstellen</title>
</head>
<body>
<?php
if(isset($_POST["submit"])){
    include("mysql.php");
    global $mysql;
    $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :user");
    $stmt->bindParam(":user", $_POST["username"]);
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count == 0){
        $stmt = $mysql->prepare("SELECT * FROM accounts WHERE email = :email");
        $stmt->bindParam(":email", $_POST["email"]);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count == 0){
            if($_POST["pw"] == $_POST["pw2"]){
                $stmt = $mysql->prepare("INSERT INTO accounts (USERNAME, PASSWORD, email, TOKEN) VALUES (:user, :pw, :email, null)");
                $stmt->bindParam(":user", $_POST["username"]);
                $hash = password_hash($_POST["pw"], PASSWORD_BCRYPT);
                $stmt->bindParam(":pw", $hash);
                $stmt->bindParam(":email", $_POST["email"]);
                $stmt->execute();
                echo "Dein Account wurde angelegt";
                header("Location: index.php");
            } else {
                echo "Die Passwörter stimmen nicht überein";
            }
        } else {
            echo "Email bereits vergeben";
        }
    } else {
        echo "Der Username ist bereits vergeben";
    }
}
?>
<h1>Account erstellen</h1>
<form action="register.php" method="post">
    <label>
        <input type="text" name="username" placeholder="Username" required>
    </label><br>
    <label>
        <input type="password" name="pw" placeholder="Passwort" required>
    </label><br>
    <label>
        <input type="password" name="pw2" placeholder="Passwort wiederholen" required>
    </label><br>
    <button type="submit" name="submit">Erstellen</button>
</form>
<br>
</body>
</html>
