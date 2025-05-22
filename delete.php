<?php 
require_once "pdo.php";
session_start();

if (isset($_POST['cancel'])) {
    header("Location: index.php");
    return;
}

if (isset($_POST['delete']) && isset($_POST['first_name'])) {
    $sql = "DELETE FROM Profile WHERE first_name = :pi";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':pi' => $_POST['first_name']]);

    $_SESSION['success'] = "Profile deleted";
    header("Location: index.php");
    return;
}

if (!isset($_GET['first_name'])) {
    $_SESSION['error'] = "Could not load profile";
    header("Location: index.php");
    return;
}

$stmt = $pdo->prepare("SELECT * FROM Profile WHERE first_name = :first_name");
$stmt->execute([':first_name' => $_GET["first_name"]]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row === false) {
    $_SESSION['error'] = "Could not load profile";
    header("Location: index.php");
    return;
}

$first_name = htmlentities($row["first_name"]);
$last_name = htmlentities($row["last_name"]);
$email = htmlentities($row["email"]);
$headline = htmlentities($row["headline"]);
$summary = htmlentities($row["summary"]);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Huong Dang 111574d6</title>
</head>
<body>
    <h1>Deleting Profile</h1>

    <?php 
    if (isset($_SESSION['error'])) {
        echo "<p style='color: red'>".$_SESSION['error']."</p>";
        unset($_SESSION['error']);
    }
    ?>

    <p>First Name: <?= $first_name ?></p>
    <p>Last Name: <?= $last_name ?></p>

    <form method="POST">
        <input type="hidden" name="first_name" value="<?= htmlentities($_GET['first_name']) ?>" />
        <input type="submit" name="delete" value="Delete" />
        <input type="submit" name="cancel" value="Cancel" />
    </form>
</body>
</html>
