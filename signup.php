<!DOCTYPE html>
<html>
<head>
    <title>SIGN UP</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form action="signup-check.php" method="post">
        <h2>SIGN UP</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php } ?>
        <?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo htmlspecialchars($_GET['success']); ?></p>
        <?php } ?>
        <label>First Name</label>
        <input type="text" name="first_name" placeholder="First Name">
        <label>Last Name</label>
        <input type="text" name="last_name" placeholder="Last Name">
        <label>Email</label>
        <input type="email" name="email" placeholder="Email">
        <label>Password</label>
        <input type="password" name="password" placeholder="Password">
        <label>Re-enter Password</label>
        <input type="password" name="re_password" placeholder="Re-enter Password">
        <button type="submit">Sign Up</button>
    </form>
</body>
</html>
