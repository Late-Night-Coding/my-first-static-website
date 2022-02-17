<?php
    include 'login.php';
    session_start(); 
    $senderID = $_SESSION['sessionId'];
    $reciever = $_GET['reciever'];
    $recieverID = $_SESSION['userIDs'][$reciever];
    
    if ($recieverID == 'nobody'){
        header("Location: ./users.php");
        exit();
    } 
    $sql = "SELECT * from messages where (recieverID = ? AND senderID = ?) OR (recieverID = ? AND senderID =?)";
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
            if (($_SESSION['msgscount'] - 1) < 0 ) 
                echo "No New Messages";
            else {    
                if ($_SESSION['assoc'][$_SESSION['lastMsgKey']] == $_SESSION['sessionId'])
                echo "You: " . $_SESSION['msgs'][$_SESSION['msgscount'] - 1];
            else {
                echo $_SESSION['fname'][$reciever] .  ": " . $_SESSION['msgs'][$_SESSION['msgscount'] - 1];
            }
        }
?>