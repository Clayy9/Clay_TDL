<?php
$bg = "./assets/bg_login.png";
?>

<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/2c04a65836.js" crossorigin="anonymous"></script>
    <title>Register - Teman Kanvas</title>
    <link rel="icon" type="image/x-icon" href="./assets/faviconTK.ico">
    <link rel="stylesheet" href="./assets/css/style_register.css">
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
        <div class="containerForm"><br>
            <h1>Sign Up</h1>
            <form action="sv_register.php" method="post">
                <div class="inputColumn">
                    <h3>Username</h3>
                    <div class="inputText">
                        <i class="fa-solid fa-user" style="color: #c0c0c2;"></i>
                        <input class="textField" type="text" name="username" id="username"
                            placeholder="Type your username..." required>
                    </div>
                    <h3>Full Name</h3>
                    <div class="inputText">
                        <i class="fa-solid fa-user" style="color: #c0c0c2;"></i>
                        <input class="textField" type="text" name="fullname" id="fullname"
                            placeholder="Type your fullname..." required>
                    </div>
                    <h3>Email</h3>
                    <div class="inputText">
                        <i class="fa-solid fa-envelope" style="color: #c0c0c2;"></i>
                        <input class="textField" type="text" name="email" id="email" placeholder="Type your email..."
                            required>
                    </div>
                    <h3>Password</h3>
                    <div class="inputText">
                        <i class="fa-solid fa-lock" style="color: #c0c0c2;"></i>
                        <input class="textField" type="password" name="password" id="password"
                            placeholder="Type your password..." required>
                    </div>
                </div>
                <div class="button_submit">
                    <center>
                        <td colspan="2"><input class="button" type="submit" value="Sign Up" name="submit"></td>
                    </center>
                </div>
            </form>
            <div class="register">Already have an account? <a href="index.php" style="font-weight: bold">Login now!</a>
            </div><br>
        </div>
    </div>
</body>

</html>