<?php
require 'login.php';
session_start();
if (isset($_POST['change-pass-submit'])) {
    $currentPass = $_POST['currentPass'];
    $newPass = $_POST['newPass'];
    $confPass = $_POST['confNew'];
    $email = $_SESSION['email'];

    if (empty ($currentPass) || empty ($newPass) || empty ($confPass)) {
        header("Location: ../users.php?err=0");
        exit();
    }
    else {
        if ($newPass !== $confPass) {
            header("Location: ../users.php?err=1");
            exit();
        }
        else {
            $sql = "SELECT * from users where email = ?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt,$sql)) {
                header("Location: ../users.php?err=2");
                exit();
            }
            else {
                mysqli_stmt_bind_param($stmt,"s",$email);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $rowCount = mysqli_stmt_num_rows($stmt);
                
                if ($row = mysqli_fetch_assoc($result)) {
                    
                    $hashCheck = password_verify($currentPass, $row['password']);
                    if ($hashCheck === false) {
                        header("Location: ../users.php?err=3");
                        exit();
                    }
                    else {
                        $sql = "UPDATE users SET password = ? where email = ?";
                        $stmt = mysqli_stmt_init ($conn);
                    if (!mysqli_stmt_prepare($stmt,$sql)) {
                        header("Location: ../users.php?err=2");
                        exit();
                    }
                    
                    else {
                    $hashedPass = password_hash($newPass,PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt,"ss",$hashedPass,$email);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../users.php?success=2");
                    exit();
                    }
            }

    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
        }
    }
}
?>