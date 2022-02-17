<?php
session_start();
require_once 'includes/login.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="css/style.css"
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add friends</title>
</head>
<body>
     
<section class="user-list" id="add-friends-container">
        
        <?php
        $usersNum =0; 
        for ($i = 0; $i < $_SESSION['rowsNum']; $i++) : ?>

            <div class="usersList" onclick="showChat(<?=$i?>)" id="user<?=$i?>">
            <img src="includes/<?=  $_SESSION['Profile-Pics'][$i];?>" alt="" onerror=this.src="imgs/noImageDP.jpg">
            <div class="msgdetails">
                
                <a id="a<?=$i?>"><span><?=  $_SESSION['Full-Name'][$i];?></span></a>
                <p id="msgstatus<?=$usersNum?>"></p>
                
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
</body>
</html>