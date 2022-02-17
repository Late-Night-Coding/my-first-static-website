<?php 
require 'usersDatabase.php';

if (isset($_POST['msgContent'])){
    session_start();
    $msg = $_POST['msgContent'];
    $reciever = $_POST['friendID'];
    $senderID = $_SESSION['sessionId']; //$_SESSION['sessionId'];
    $recieverID = $_SESSION['userIDs'][$reciever]; 
    date_default_timezone_set("America/Chicago");
    // A for AM/PM
    $timestamp = date("h:i A");
             $sql = "INSERT INTO messages (senderID,recieverID,message,timestamp) VALUES (?,?,?,?)";
             $stmt = mysqli_stmt_init($conn);
             if (!mysqli_stmt_prepare($stmt,$sql)) {
                 header("Location: ../chat.php?index=Error=SQL");
                 exit();
             }
            echo $reciever;
            echo $recieverID;
            mysqli_stmt_bind_param($stmt, "iiss", $senderID, $recieverID, $msg,$timestamp);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            }
?>