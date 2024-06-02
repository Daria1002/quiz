<?php
session_start();
include "db_conn.php";

if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) 
    && isset($_POST['password']) && isset($_POST['re_password'])) {

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $first_name = validate($_POST['first_name']);
    $last_name = validate($_POST['last_name']);
    $email = validate($_POST['email']);
    $pass = validate($_POST['password']);
    $re_pass = validate($_POST['re_password']);

    if (empty($first_name) || empty($last_name) || empty($email) || empty($pass) || empty($re_pass)) {
        header("Location: signup.php?error=All fields are required");
        exit();
    } else if ($pass !== $re_pass) {
        header("Location: signup.php?error=The confirmation password does not match");
        exit();
    } else {
        // Hashing the password using password_hash
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

        // Check if the email is already taken
        $sql = "SELECT * FROM users WHERE email=?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt === false) {
            header("Location: signup.php?error=Database error: failed to prepare statement");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            header("Location: signup.php?error=The email is already taken, try another");
            mysqli_stmt_close($stmt);
            exit();
        } else {
            $sql2 = "INSERT INTO users(`first-name`, `last-name`, `email`, `password`) VALUES(?, ?, ?, ?)";
            $stmt2 = mysqli_prepare($conn, $sql2);
            if ($stmt2 === false) {
                header("Location: signup.php?error=Database error: failed to prepare statement");
                exit();
            }
            mysqli_stmt_bind_param($stmt2, "ssss", $first_name, $last_name, $email, $hashed_pass);
            $result2 = mysqli_stmt_execute($stmt2);

            if ($result2) {
                header("Location: login.php?success=Your account has been created successfully. You can now log in.");
                exit();
            } else {
                header("Location: signup.php?error=An unknown error occurred");
                exit();
            }
            mysqli_stmt_close($stmt2);
        }
        mysqli_stmt_close($stmt);
    }
} else {
    header("Location: signup.php");
    exit();
}
?>







