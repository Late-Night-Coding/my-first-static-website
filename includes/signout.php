<?php 

// if (isset($_POST['signout'])){
    require 'usersDatabase.php';
    
    require_once 'login.php';
    session_start();
    $email = $_SESSION['email'];
    $status = "Offline";
    date_default_timezone_set("America/Chicago");
    $lastSeen = date("h:i A");
    $sql = "UPDATE users SET status =?, lastseen=? WHERE email =?";
    $stmt = mysqli_stmt_init ($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)) {
    header("Location: ../login.php?Error=SQLError");
    exit();
    }
    else {
    mysqli_stmt_bind_param($stmt,"sss", $status,$lastSeen,$email);
    mysqli_stmt_execute($stmt);
    session_destroy();
    header ("Location: ../index.php?LoggedOut:)");
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}
// }

?>