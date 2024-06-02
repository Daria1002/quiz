<?php
session_start();
include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['uname']); // assuming 'uname' is the email input
    $pass = validate($_POST['password']);

    if (empty($email)) {
        header("Location: index.php?error=Email is required");
        exit();
    } else if (empty($pass)) {
        header("Location: index.php?error=Password is required");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE email=?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt === false) {
            header("Location: index.php?error=Database error: failed to prepare statement");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($pass, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['uname'] = $row['email'];
                $_SESSION['name'] = $row['first-name'] . ' ' . $row['last-name'];
                header("Location: home.php");
                exit();
            } else {
                header("Location: index.php?error=Incorrect email or password");
                exit();
            }
        } else {
            header("Location: index.php?error=Incorrect email or password");
            exit();
        }
    }
} else {
    header("Location: index.php");
    exit();
}
?>
