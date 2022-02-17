<?php
require 'login.php';
require 'usersDatabase.php';
session_start();
if (isset($_POST['pic-submit'])) {
    if ((!file_exists($_FILES['chng-dp']['tmp_name']) || !is_uploaded_file($_FILES['chng-dp']['tmp_name']))) {
        header("Location: ../users.php?err=4");
    }
    else { 
        if ($_FILES['chng-dp']['size'] > 1000000){
            header("Location: ../users.php?err=6");
            exit();
        }
        else {
$tmp_name = $_FILES['chng-dp']['tmp_name'];
$name = $_FILES['chng-dp']['name'];
$acceptedPics = array('jpg','jpeg','png');
$explodeArray = explode('.',$name);
$extention = end($explodeArray);
$extToLower = strtolower($extention);
if (in_array($extToLower,$acceptedPics)){
    $newName = $_SESSION['sessionFname'] . $_SESSION['sessionLname'] . uniqid("",true) . '.' . $extToLower;
    $imageData = file_get_contents($tmp_name); 
    // move_uploaded_file($tmp_name,$newFileLocation);
}
else {
    header("Location: ../users.php?err=5");
    exit();
}

$sql = "UPDATE users SET img = ?  WHERE user_id = ?";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt,$sql)) {
    header("Location: ../login.php?Error=2");
    exit();
    }
else {
    mysqli_stmt_bind_param($stmt, "si", $imageData, $_SESSION['userID']);
    mysqli_stmt_execute($stmt);
    $_SESSION['pic'] = $imageData;
    header("Location: ../users.php?success=1");
}
}
}
    }
?>