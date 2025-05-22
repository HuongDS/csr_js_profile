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
</head>
<body>
    <h1>Deleting Profile</h1>

    <?php 
    if (isset($_SESSION['error'])) {
        echo "<p style='color: red'>".$_SESSION['error']."</p>";
        unset($_SESSION['error']);
    }
    ?>

    <p>First Name: <?= $profile_id ?></p>
    <p>Last Name: <?= $last_name ?></p>

    <form method="POST">
        <input type="hidden" name="profile_id" value="<?= htmlentities($_GET['profile_id']) ?>" />
        <input type="submit" name="delete" value="Delete" />
        <input type="submit" name="cancel" value="Cancel" />
    </form>
</body>
</html>
