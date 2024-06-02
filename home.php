<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['uname'])) {
    include "db_conn.php";
    ?>
<!DOCTYPE html>
<html>
<head>
    <title>HOME</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Hello, <?php echo htmlspecialchars($_SESSION['name']); ?></h1>
    <p><?php echo "Connected successfully to the database."; ?></p>
    <a href="logout.php">Logout</a>
</body>
</html>
<?php
} else {
    header("Location: index.php");
    exit();
}
?>
