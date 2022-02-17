<?php
include 'usersDatabase.php';
session_start(); // ..
$_SESSION['status-ajax'] = array();
$userNum = $_SESSION['rowsNum'];
    $sql = "SELECT status FROM users where user_id <> ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("Location: ../login.php?Error=SQLError");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $_SESSION['userID']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)){
        array_push($_SESSION['status-ajax'], $row['status']);
    }
    // $index = 0;
    // for ($i = 0; $i < $_SESSION['rowsNum']-1; $i++) {
    //     if ($_SESSION['stats-ajax'][$i] != $_SESSION['stats'][$i]){
    //         $index = $i;
    //         echo $index;
    //     }
    // }

    for ($i = 0; $i < $userNum; $i++){
        if ($_SESSION['stats'][$i] !== $_SESSION['status-ajax'][$i])
        {    
            $_SESSION['stats'][$i] = $_SESSION['status-ajax'][$i];
            echo $i;
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    

// $_SESSION['rowsNum'] // num of users

// for ($i = 0; $i < $_SESSION['rowsNum']; $i++) {
    
// }

?>