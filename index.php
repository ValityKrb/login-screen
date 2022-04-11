<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Erstelle einen Account</title>
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
        if($count == 1){
            $row = $stmt->fetch();
            if(password_verify($_POST["pw"], $row["PASSWORD"])){
                session_start();
                $_SESSION["username"] = $row["USERNAME"];
                header("Location: login.php");
            } else {
                echo "Der Login ist fehlgeschlagen";
            }
        } else {
            echo "Der Login ist fehlgeschlagen";
        }
    }
    ?>
    <h1>Melde dich an</h1>
    <form action="index.php" method="post">
        <label>
            <input type="text" name="username" required>
        </label>
        <br>
        <label>
            <input type="password" name="password" required>
        </label>
        <br>
        <label>
            <input type="password" name="pw" required>
        </label>
        <button type="submit" name="submit">Logge dich ein</button>
    </form>
    <br>
    </body>
</html>
