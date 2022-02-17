<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://kit.fontawesome.com/a8405fb4e9.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src=js/ajaxIndex.js></script>
    <script src=js/passshowhide.js></script>
    <title>Signup!</title>

</head>
<body>
<div class="wrapper" id="signup-container">
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
                        ?><div class="error"><i class="fas fa-times-circle"></i><p> Email is not valid</p></div>
                    <?php
                        break;
                    case 2:
                        ?>
                         ?><div class="error"><i class="fas fa-times-circle"></i><p> SQL database error</p></div><?php
                        break;
                    case 3:
                        ?><div class="error"><i class="fas fa-times-circle"></i><p> Email is already taken</p></div>
                    <?php
                        break;
                    case 4:
                        ?><div class="error"><i class="fas fa-times-circle"></i><p> Image type is invalid</p></div>
                    <?php
                        break;
                    case 5:
                        ?><div class="error"><i class="fas fa-times-circle"></i><p>  Image size exceeds the limt </p></div>
                    <?php
                        break;
                }
            }
               ?>
                <form action="includes/signup.php" method="post" enctype="multipart/form-data">
                <div class="input-wrapper">
                    <label for="fname-input">First Name</label>
                    <label name="label-lname" for="lname-input">Last Name</label>
                    <div class="firstLast">
    
                    <div class="input-fname">
                    <input type="text" id="fname-input" name="fname" placeholder="First Name"></input>
                    </div>
    
    
                    <div class="input-lname">
                    <input type="text" id="lname-input" name="lname" placeholder="Last Name"></input>
                    </div>
                </div>
                    <label for="email-input">Email Address</label>
                    <div class="input-email">
                    <input type="text" id="email-input" name="email"
                    placeholder="Enter your email"></input>
                    </div>
                    <label for="pass-input">Password</label>
                    <div class="input-pass">
                    <input type="password" id="pass-input" name="password" placeholder="Enter new password"></input>
                    <i id="eye" class="fas fa-eye" ></i>
    
                    </div>
                    <label for="image-upload">Select Image</label>
                    <div class="upload-img">
    
                    <input type="file" id="image-upload" name="profilePic"></input>
                    </div>
    
                    <div class="input-button">
                        <button type="submit" name="submit-signup" >Continue To Chat</button>
                    </div>
                    <div class="link-signin">
                        <p>Already signed up? <a href="loginStatic.php">Login now</a></p>
                    </div>
                </div>
                </div>
                <form>
            </section>
        </div>
</body>
</html>
<html>
      