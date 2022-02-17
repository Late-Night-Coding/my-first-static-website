
<?php
require 'includes/login.php';
session_start();
if (isset($_SESSION['userID'])){
    header("Location: users.php?logged-in?");
    exit();
}
?>

<div class="wrapper" id="login-container">
    <header>
        <div class="header">
            <p>Realtime Chat App</p>
        </div>
    </header>
    <section>
    <div class="content">
    
        <form action= "includes/login.php" method="post">
        <div class="input-wrapper">
            
            <label for="email-input">Email Address</label>
            <div class="input-email">
            <input type="text" id="email-input" name="email"
           ></input>
            </div>
            <label for="pass-input">Password</label>
            <div class="input-pass">
            <input type="password" id="pass-input" name="password"></input>
            <i class="fas fa-eye"></i> 
        </div>
            
            <div class="input-button">
                <button type="submit" name="submit-login">Continue To Chat</button>
                <p>Want to sign up?<a onclick="signupPage()" href="#"> Signup</a> </p>
            </div>
</form>
        </div>
        </div>
    </section>
</div>
<script>
var url = "js/passshowhide.js";
$.getScript(url);
</script>