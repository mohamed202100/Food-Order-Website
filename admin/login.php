<?php include("partials/config.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Food Order Website</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="login">
        <h1 class="text-center">Login</h1><br><br>

        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if (isset($_SESSION['no-login-msg'])) {
            echo $_SESSION['no-login-msg'];
            unset($_SESSION['no-login-msg']);
        }
        ?>

        <form action="" method="POST" class="text-center">
            username: <br>
            <input type="text" name="username" placeholder="Enter Your username"><br><br>
            password: <br>
            <input type="password" name="password" placeholder="Enter Your Password"> <br><br>
            <input type="submit" value="Login" name="login" class="btn-primary"><br><br>
        </form>

        <p class="text-center">Created By - <a href="www.rafat.com">RAFAT</a></p>
    </div>
</body>

</html>

<?php
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password';";
    $result = mysqli_query($connection, $sql);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $_SESSION['login'] = "<div class='success text-center'>Login Successfully.</div>";
        $_SESSION['user'] = $username;
        header("location:" . SITEURL . "admin/");
    } else {
        $_SESSION['login'] = "<div class='error text-center'>Username or Password Error.</div>";
        header("location:" . SITEURL . "admin/");
    }
}
?>