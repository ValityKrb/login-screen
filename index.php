<form action="prozess.php" id="ContactUs100" method="post" >
    <script type="text/javascript">
    </script>
    <table style="width:100%;max-width:550px;border:0;" cellpadding="8" cellspacing="0">
        <tr> <td>
                <label for="Username">Username:</label>
                <br/>
                <input name=Username type="text" maxlength="60" style="width:100%;max-width:250px;" />
                <br/>
                <label for="Password">Password:</label>
                <br/>
                <input n="Password" type="text" maxlength="60" style="width:100%;max-width:250px;" />
        <td/>
    </table>
    <input type="submit" name="submit"
</form>

<?php
if(isset($_POST["submit"])){
    require("mysql.php");
    $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :user"); //Datenbank
    $stmt->bindParam(":user", $_POST["username"]);
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count == 1){
        $row = $stmt->fetch();
        if(password_verify($_POST["pw"], $row["PASSWORD"])){
            session_start();
            $_SESSION["username"] = $row["USERNAME"];
            header("Location: geheim.php");
        } else {
            echo "Der Login ist fehlgeschlagen";
        }
    } else {
        echo "Der Login ist fehlgeschlagen";
    }
}
?>