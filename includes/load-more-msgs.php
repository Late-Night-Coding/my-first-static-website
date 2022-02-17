<?php
    require_once 'usersDatabase.php';
    require_once 'login.php';
    $senderID = $_POST['seshID'];
    $msgsTilldisplayed = $_POST['msgs']-1;
    $recieverID = 18;
    $img  = $_POST['img'];
   
    $sql = "SELECT * from messages where (recieverID = ? AND senderID = ?) OR (recieverID = ? AND senderID =?) LIMIT 1  OFFSET ? " ;
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("Location: ../chat.php?index=0");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"iiiii", $recieverID,$senderID,$senderID,$recieverID, $msgsTilldisplayed);
    mysqli_stmt_execute($stmt);
    $_SESSION['msgs'] = array();
    $_SESSION['ids'] = array();
    $_SESSION['assoc'] = array();
    $_SESSION['msgscount'] =0;
    $_SESSION['timestamp'] =array();
    
    $results = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($results)) {
        $msg = $row['message'];
        $msgSenderid = $row['senderID'];   
        $msgRecieverid = $row['recieverID'];
        $timestamp = $row['timestamp'];
        
        array_push($_SESSION['msgs'],$msg);
        array_push($_SESSION['assoc'],$msgSenderid);
        array_push($_SESSION['timestamp'],$timestamp);
        $_SESSION['msgscount']++;
        
    }
    
    $_SESSION['lastMsgKey'] = array_key_last($_SESSION['msgs']);
    if ($msgsTilldisplayed <0 ) {
        echo "<p>No Older messages.</p>";
    }
    else {
        if ($_SESSION['assoc'][0] == $senderID){
       echo  "<div class='sentMore'><p>" . $_SESSION['msgs'][0] . "</p>  ";
       echo  "<!--Sent--><small>" . $_SESSION['timestamp'][0] . "</small> </div>";
        }
        else {
                echo  "<div class='recievedMore'> <img src=$img>";
                echo  "<p>" . $_SESSION['msgs'][0] . "</p>  </div> ";
                echo  "<div class='time-stamp-recieved'> <small>" . $_SESSION['timestamp'][0] . "</small> </div> ";
        }
    }

?>