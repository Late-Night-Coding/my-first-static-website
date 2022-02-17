<!-- <?php

require_once 'includes/usersDatabase.php';
require_once 'includes/login.php';
if (isset($seshId)){
    header("Location: users.php?logged-in");
    exit();
}

?> -->

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
    <title>Welcome Friend!</title>
</head>
<body ontouchstart="">
<nav >
        <i class="fas fa-bars"></i>
        <div class="options-container" >
              <ul>
                  
                    <li onclick="signupPage()"><i  class="fas fa-user-plus"></i><span>Signup</span></li>
                        <li id="url" onclick="loginPage()"><i class="fas fa-sign-in-alt"></i><span>Signin</span></li>
                        <li><i class="fas fa-envelope-open-text"></i></a><span>Contact</span></li>
                        <li><i class="fas fa-question"></i><span>About</span></li>
              </ul>
            </div>
    </nav>
<div id="title">
<div class="title-wrapper">
    <h1>Weclome To<h1> <em>Space</em>
</div>
<h2>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dignissimos, culpa? Soluta voluptatibus expedita, incidunt eligendi consequatur saepe sequi. Ab nam unde minima odit assumenda veniam nemo in voluptatem quod, possimus fuga optio, nihil officia error earum minus neque, dolor dolorem maxime et qui quo! Vero consectetur nisi, sapiente, quod a perferendis cupiditate dicta corporis facere maxime nulla inventore tempora aliquid officia dignissimos similique reprehenderit consequatur ratione deserunt unde numquam ipsum! Dignissimos sunt corporis cupiditate incidunt eum numquam, iste est quae sint quibusdam! Nobis officiis, dignissimos vitae aliquam repellat, harum quaerat sequi voluptates ab veritatis error praesentium necessitatibus accusantium soluta amet?</h2>
</div>
</body>
</html>