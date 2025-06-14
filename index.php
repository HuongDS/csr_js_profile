<?php
   require "pdo.php";
   session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
   <title>Huong Dang 111574d6 cd6da2a3 06b4c7d3</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
   <h1>Alan Dsilva's Resume Registry</h1>
   <p>
            <b>Note:</b> Your implementation should retain data across multiple
            logout/login sessions. This sample implementation clears all its
            data on logout - which you should not do in your implementation.
        </p>
</head>
<body>
    <?php
        if (isset($_SESSION['success'])) {
            echo "<p style='color: green'>".$_SESSION['success']."</p>";
            unset($_SESSION['success']);
        }
        if ( isset($_SESSION['name'])) {
            echo "<a href='logout.php'>Logout</a><br />";
           
        } else {
            echo "<a href='login.php'>Please log in</a>";
        }

        $statement = $pdo->query("SELECT * FROM Profile");

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if ($row != false) {

            $statement = $pdo->query("SELECT * FROM Profile");
            
            echo "<table border='1'>
            <tbody>
            <tr> 
            <th>Name</th>
            <th>Headline</th>";

            if (isset($_SESSION['name'])) {
                echo "<th>Action</th>";
            }
            
            echo "</tr>";
            while ( $row = $statement->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>".$row['first_name']." ".$row['last_name']."</td>";
                echo "<td>".$row['email']."</td>";
                if (isset($_SESSION['name'])) {
                    echo "<td>
                        <a href='edit.php?profile_id=".$row['profile_id']."'>Edit </a>
                        <a href='delete.php?profile_id=".$row['profile_id']."'>Delete</a>
                    </td>";
                }
                echo "</tr>";
            }
            echo "</tbody></table>";
        }
        

        if ( isset($_SESSION['name'])) {
            echo "<a href='add.php'>Add New Entry</a>";
        } 

    ?>
</body>

</html>
