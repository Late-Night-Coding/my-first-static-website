<?php 
require_once 'includes/login.php';
?> 
<?php
session_start();
if (isset($_SESSION)) : ?>

<!DOCTYPE html>
<html lang="en"  >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="ajax.js"></script>
    <script src="https://kit.fontawesome.com/a8405fb4e9.js" crossorigin="anonymous"></script>        
    <title>Chat with alines!</title>
</head>
<body ontouchstart="">
<nav >
        <i class="fas fa-bars"></i>
        <div class="options-container" >
              <ul>
                  
                    <li onclick="showSettings()"><i class="fas fa-user-circle"></i><span>Account</span></li>
                        <li id="url"><i class="fas fa-question"></i><span>About</span></li>
                        <li><i class="fas fa-envelope-open-text"></i></a><span>Contact</span></li>
                        <li id="signout-option" onclick="signoutOption()"><i class="fas fa-sign-out-alt"></i><span>Signout</span></li>
              </ul>
            </div>
    </nav>
<div class="wrapper" id="user-container">
 <section class="users">
    <header>   <!-- !--> 
    <div class="content">
    <div class="msgs"></div>
      <i class="fas fa-cog" id="gear" onclick="showSettings()"></i>
    <div class="backArrow"  id="back-arrow">
  
        <button><a id="er"><i class="fas fa-arrow-left"></a></i></button>
    </div>
  
            <div class="imgContainer">
            
            <img src="<?= 'data:image/jpeg;base64,' . base64_encode ($_SESSION['pic'])?>" alt="">
            </div>
                <div class="details">
                    <span><?= $_SESSION['full-name-current'];?></span>
                    <p name="status"><?php echo $_SESSION['stat'];?></p>
                   
                    
                </div>
                <div class="logout">
                <form action="includes/signout.php" method="post"><button type="submit" name="signout">Logout</button></form>
                </div>
            </div>
            <!-- <div class="sendmsg">
            <div class="msg-input">
                <input type="text" name="msgContent" id="msg-content" placeholder="Say hi to >..." autofocus="autofocus"
                required="required">
            </div>
            <div class="send-arrow">
            </div>
        </div>
            <button  id="sendmsg" name="submitmsg"><i class="fab fa-telegram-plane"></i></button>
         -->
        </header>
        <section id="belowHeader">
        <div class="search">
            <!-- <span class="text">Select a user to start chat</span> -->
            <input oninput="usersSearch()" id="userSearch" type="text" placeholder="Enter name to search">
            <button><i id="test" class="fas fa-search"></i></button>
        </div>
    <section class="user-list">
        
        <?php
        $usersNum =0; 
        for ($i = 0; $i < $_SESSION['rowsNum']; $i++) : ?>

            <div class="usersList" onclick="showChat(<?=$i?>)" id="user<?=$i?>">
            <img src="<?= 'data:image/jpeg;base64,' . base64_encode ($_SESSION['Profile-Pics'][$i])?>" alt="" onerror=this.src="imgs/noImageDP.jpg">
            <div class="msgdetails">
                
                <a id="a<?=$i?>"><span><?=  $_SESSION['Full-Name'][$i];?></span></a>
                <p id="msgstatus<?=$usersNum?>"><script>setInterval(() => {
                lastMsg(<?=$i?>)
                }, 1000);</script></p>
                
                <div class="i"><i id= "i<?=$usersNum?>" class="<?php if ($_SESSION['stats'][$i]=="Active now") :?>fa fa-circle active<?php
                 else : ?>fa fa-circle"<?php endif;?> 
                    aria-hidden="true"></i>
                </div>
                </div>
                </div>
                <?php
            $usersNum++;
            endfor;?>
                
                <!-- <div class="usersList">
            <img src="" alt="">
            <div class="msgdetails">
                <span></span>
                <p name="msgstatus">This is a test message</p>
                <div class="i"><i class="fa fa-circle" aria-hidden="true"></i>
                </div>
                </div>
                </div>
         -->
         <div class="sent" style="display:none">      
         </div>
         <div class="recieved"  style="display:none">
         <div class="time-stamp-recieved">
    </div>
        </div>
        </div>
        </section>
    </section>

        </body>  
    </html>

  <?php
  else : 
      header("Location: loginStatic.php?GETattempt");
      exit();
    endif;?>
    