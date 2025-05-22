<?php 
require_once "pdo.php";
session_start();

if (isset($_POST['cancel'])) {
    header("Location: index.php");
    return;
}

if (isset($_POST['delete']) && isset($_POST['profile_id'])) {
    $sql = "DELETE FROM Profile WHERE profile_id = :pi";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':pi' => $_POST['profile_id']]);

    $_SESSION['success'] = "Profile deleted";
    header("Location: index.php");
    return;
}

if (!isset($_GET['profile_id'])) {
    $_SESSION['error'] = "Could not load profile";
    header("Location: index.php");
    return;
}

$stmt = $pdo->prepare("SELECT * FROM Profile WHERE profile_id = :profile_id");
$stmt->execute([':profile_id' => $_GET["profile_id"]]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row === false) {
    $_SESSION['error'] = "Could not load profile";
    header("Location: index.php");
    return;
}

$profile_id = htmlentities($row["profile_id"]);
$last_name = htmlentities($row["last_name"]);
$email = htmlentities($row["email"]);
$headline = htmlentities($row["headline"]);
$summary = htmlentities($row["summary"]);
?>

<!DOCTYPE html>
<html>
<head>
   <title>Huong Dang 111574d6</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
         integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
         crossorigin="anonymous">
</head>
<body>
   <h1>Alan Dsilva's Resume Registry</h1>
   <p>
       <b>Note:</b> Your implementation should retain data across multiple
       logout/login sessions. This sample implementation clears all its
       data on logout - which you should not do in your implementation.
   </p>

   <a href="logout.php">Logout</a><br>

   <table border="1">
       <tbody>
           <tr> 
               <th>Name</th>
               <th>Headline</th>
               <th>Action</th>
           </tr>
           <tr>
               <td>42986856712 Deist</td>
               <td>blah@example.com</td>
               <td>
                   <a href="edit.php?profile_id=5">Edit</a>
                   <a href="delete.php?profile_id=5">Delete</a>
               </td>
           </tr>
           <!-- Các dòng khác -->
       </tbody>
   </table>

   <a href="add.php">Add New Entry</a>
</body>
</html>
