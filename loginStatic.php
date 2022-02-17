<?php
include 'includes/signup.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://kit.fontawesome.com/a8405fb4e9.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/ajaxIndex.js"></script>
    <script src="js/passshowhide.js"></script>
    <title>Login!</title>
</head>
<body>
<div class="wrapper" id="login-container">
    <header>
        <div class="header">
            <p>Realtime Chat App</p>
        </div>
    </header>
    <section>
    <div class="content">
    <?php 
     if (isset($_GET['err'])) {
        $errIndex = $_GET['err'];
        switch ($errIndex) {
            case 0:
                ?><div class="error"><i class="fas fa-times-circle"></i><p> Some feilds are empty</p></div>
            <?php
                break;
            case 1:
                ?><div class="error"><i class="fas fa-times-circle"></i><p> Sql database error</p></div>
            <?php
                break;
            case 2:
                ?>
                 <div class="error"><i class="fas fa-times-circle"></i><p> Password is invalid</p></div><?php
                break;
            case 4:
                ?><div class="error"><i class="fas fa-times-circle"></i><p> Email not found</p></div>
            <?php
                break;
        }
    }
    else if (isset($_GET['success'])) {
        $succIndex = $_GET['success'];
        if ($succIndex == 1)
        ?><div class="success"><i class="fas fa-check-circle"></i><p id="register-success">Registered Successfully</p></div>
        <?php }
        ?>
       
        <form action= "includes/login.php" method="post">
        <div class="input-wrapper">
            
            <label for="email-input">Email Address</label>
            <div class="input-email">
            <input type="text" id="email-input" name="email"
            placeholder="Enter your email" value="<?php isset($_GET['email']) ? print $_GET['email'] : "" ?>"></input>
            </div>
            <label for="pass-input">Password</label>
            <div class="input-pass">
            <input type="password" id="pass-input" name="password" placeholder="Enter your password"></input>
            <i class="fas fa-eye"></i> 
        </div>
            
            <div class="input-button">
                <button type="submit" name="submit-login">Continue To Chat</button>
                <p>Want to sign up?<a href="signupStatic.php"> Signup</a> </p>
            </div>
</form>
        </div>
        </div>
    </section>
</div>
</body>
</html>