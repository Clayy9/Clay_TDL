<?php
$bg = "./assets/bg_login.png";
?>

<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/2c04a65836.js" crossorigin="anonymous"></script>
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="./assets/faviconTK.ico">
    <link rel="stylesheet" href="./assets/css/style_login.css">
    <style type="text/css">
        body {
            background-image: url('<?php echo $bg; ?>');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            height: 100%;
            image-rendering: -webkit-optimize-contrast;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form_container"><br>
            <h1>Login</h1>
            <form method="post" action="sv_login.php">
                <h3>Email</h3>
                <div class="inputText">
                    <input class="textField" type="text" name="email" id="email" placeholder="Type your email..."
                        required />
                </div>
                <h3>Password</h3>
                <div class="inputText">
                    <input class="textField" type="password" name="password" id="password"
                        placeholder="Type your password..." required />
                </div>
                <div class="button_submit">
                    <td colspan="2"><input class="form_button" type="submit" value="Login" name="submit"></td>
                </div>
            </form>
            <div class="register">Don't have an account? <a href="register.php" style="font-weight: bold">Sign up
                    now!</a></div><br>
        </div>
    </div>
</body>

</html>