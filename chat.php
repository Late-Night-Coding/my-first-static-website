<?php 
include 'includes/loadmsgs.php';
?>
    <div class="wrapper" id="chat-container">
 <section class="users">
    <header>    
    <div class="content">
        <div class="backArrow">
        <button><i id="back-arrow" onclick="backArrows()" class="fas fa-arrow-left"></i></button>
    </div>
            <div class="chatImg">
                <?php
                $image = imagecreatefromstring($_SESSION['Profile-Pics'][$_GET['reciever']]);
                $image = imagescale($image, 50, 50);
                ob_start();
                imagejpeg($image);
                $contents = ob_get_contents();
                ob_end_clean();
                
                echo "<img src='data:image/jpeg;base64,".base64_encode($contents)."' />";
                
                imagedestroy($image);
                
                ?>
        
            </div>
                <div class="details">
                    <span><?= $_SESSION['Full-Name'][$_GET['reciever']]?></span>
                    <p name="status">
                        <?php if ($_SESSION['stats'][$_GET['reciever']] == 'Active now') : ?>
                            <?=($_SESSION['stats'][$_GET['reciever']])?>
                        </p>
                        <?php else : ?><p>Last seen at <?=($_SESSION['lastseen'][$_GET['reciever']])?>
                        </p>
                        <?php endif;?>
                </div>
            </div>
        
        </header>
        </section>
        <!-- <div class="load-more-sec">
        <button id="load-more-msgs">Load Older Messages</button>
        </div> 
        -->
        
        <section class="bubbles">
     
       <div class="bubblewrapper">
       <div class="recievedMore"></div>
       <div class="sentMore"></div> 
       
       <?php 
       if ($_SESSION['msgscount'] ==0) : ?>
       <div class="emptychat">
           <p id="No">No Messages yet.<p>
       </div>
       <?php else: ?>
       <?php $allMsgs = $_SESSION['msgscount']; 
    //    $currentMsgs = $allMsgs - 4;
       
       
       for ($j = 0; $j < $allMsgs; $j++) : ?> 
            <?php if ($_SESSION['assoc'][$j] == $_SESSION['sessionId']) : ?>

                
       <div class="sent">
       
            <p><?=$_SESSION['msgs'][$j]?></p>
            <small><?=$_SESSION['timestamp'][$j]?></small>
            
        </div>
        <?php  
        
        elseif ($_SESSION['assoc'][$j] == $_SESSION['userIDs'][$_GET['reciever']]): ?>
        
        <div class="recieved">
        <?php
         $image = imagecreatefromstring($_SESSION['Profile-Pics'][$_GET['reciever']]);
         $image = imagescale($image, 50, 50);
         ob_start();
         imagejpeg($image);
         $contents = ob_get_contents();
         ob_end_clean();
         
         echo "<img src='data:image/jpeg;base64,".base64_encode($contents)."' />";
         
         imagedestroy($image);
        ?>
        <p><?=$_SESSION['msgs'][$j]?></p>
        
        
    </div>
    <div class="time-stamp-recieved">
    <p><?=$_SESSION['timestamp'][$j]?></p>
    </div>
    <?php 
    endif; 
    endfor;
    endif;
    ?>
       </div>
   
       
    </section>
        <div class="sendmsg">
            <div class="msg-input">
                <input type="text" name="msgContent" id="msg-content" placeholder="Say hi to <?=$_SESSION['fname'][$_GET['reciever']]?>..." autofocus="autofocus"
                required="required">
            </div>
            <div class="send-arrow">
            <button  id="sendmsg" onclick="ajaxSendMsg(<?=$_GET['reciever']?>)" name="submitmsg"><i class="fab fa-telegram-plane"></i></button>
            </div>
        </div>
    </form>
