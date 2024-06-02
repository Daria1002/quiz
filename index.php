<!DOCTYPE html>
<html>
<head>
    <title>LOGIN</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form action="login-check.php" method="post">
        <h2>LOGIN</h2>
        <?php if(isset($_GET['error'])) { ?>
            <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php } ?>
        <label>Email</label>
        <input type="email" name="uname" placeholder="Email">
        <label>Password</label>
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Login</button>
        <a href="signup.php" class="ca">Create an account</a>
    </form>
</body>
</html>
