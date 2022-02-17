<?php
    include 'includes/login.php';
    session_start(); 
    $senderID = $_SESSION['sessionId'];
    $reciever = $_GET['reciever'];
    $recieverID = $_SESSION['userIDs'][$reciever];
    
    if ($recieverID == 'nobody'){
        header("Location: ./users.php");
        exit();
    } 
    $sql = "SELECT * from messages where (recieverID = ? AND senderID = ?) OR (recieverID = ? AND senderID =?) ORDER BY msg_id desc LIMIT 5";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("Location: ../chat.php?index=0");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"iiii", $recieverID,$senderID,$senderID,$recieverID);
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
    $counter = 0;
    // foreach ($_SESSION['msgs'] as $values) {
        
    //     if ($_SESSION['assoc'][$counter] == $senderID) {
    //         echo "<!--sent!--><div class ='sent'><p>" . $values . "</p>";
    //         echo "<small>" . $_SESSION['timestamp'][$counter] . "</small> </div>";
    //         $counter++;
    //     }
    //     else {
    //         echo "<!--recieved!--><div class ='recieved'><p>" . $values ."</p>  ";
    //         echo "<div class='time-stamp-recieved'> <p>" . $_SESSION['timestamp'][$counter] . "</p> </div></div>";
    //         $counter++;
    //     }
    // }
    
mysqli_stmt_close($stmt);
mysqli_close($conn);

?>