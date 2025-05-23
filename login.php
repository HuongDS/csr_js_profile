<?php
require "pdo.php";
session_start();
if (isset($_POST['email']) && isset($_POST['pass'])) {
    $sql = "SELECT * FROM users WHERE email = :email AND password = :pass";

    $statement = $pdo->prepare($sql);

    $statement->execute(array(
        ":email" => $_POST['email'],
        ":pass" => $_POST['pass']
    ));

    $row = $statement->fetch(PDO::FETCH_ASSOC);

    if ($row == false) {
        $_SESSION['error'] = "Incorrect Password";
        header("Location: login.php");
        return;
    }

    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['name'] = $row['name'];
    header("Location: index.php");
    return;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Huong Dang 111574d6 cd6da2a3 b3d29210</title>
    <h1>Please Log In</h1>
    <?php 
        if (isset($_SESSION['error'])) {
            echo "<p style='color: red'>".$_SESSION['error']."</p>";
            unset($_SESSION['error']);
        }
    ?>
</head>
<body>
    <form method="post">
        <p>Email:
            <input type="text" name="email" id="email" />
        </p>

        <p>Password:
            <input type="password" name="pass" id="pass" />
        </p>

        <button type="submit" onclick="return sub();">Log In</button>
    </form>
    <p>
For a password hint, view source and find an account and password hint
in the HTML comments.
<!-- Hint: 
The account is umsi@umich.edu
The password is the three character name of the 
programming language used in this class (all lower case) 
followed by 123. -->
</p>

    <script>
    function sub() {
        try {
            console.log("HERE");
            let email = document.getElementById("email").value;
            let password = document.getElementById("pass").value;

            if (email == null || password == null || email == "" || password == "") {
                alert("Both fields are necessary");
                return false;
            }
            if (email.indexOf("@") == -1) {
                alert("Enter valid email");
                return false;
            }
            console.log("HERE");
            return true;
        } catch (e) {
            alert(e);
            return false;
        }
        return false;
    }
    </script>
</body>
</html>
