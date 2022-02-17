<?php
    require 'usersDatabase.php';
if(isset($_POST['submit-login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $statusActive = "Active now";
    $statusOff = "Offline";

    if (empty($email) || empty($password)) {
        header("Location: ../loginStatic.php?err=0");
        exit();
    }
    else {
        $sql = "SELECT * from users where email = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("Location: ../loginStatic.php?err=1");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt,"s",$email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $rowCount = mysqli_stmt_num_rows($stmt);
            
            if ($row = mysqli_fetch_assoc($result)) {
                
                $hashCheck = password_verify($password, $row['password']);
                if ($hashCheck === false) {
                    header("Location: ../loginStatic.php?err=2");
                    exit();
                }
                else {
                    $sql = "UPDATE users SET status = ? where email = ?";
                    $stmt = mysqli_stmt_init ($conn);
                    if (!mysqli_stmt_prepare($stmt,$sql)) {
                        header("Location: ../loginStatic.php?err=1");
                        exit();
                    }
                    
                    else {
                    mysqli_stmt_bind_param($stmt,"ss",$statusActive,$email);
                    mysqli_stmt_execute($stmt);
                    $sql = "SELECT * from users where email = ?";
                    $stmt = mysqli_stmt_init($conn);
                    
                    if (!mysqli_stmt_prepare($stmt,$sql)) {
                        header("Location: ../loginStatic.php?err=1");
                        exit();
                    }else {
                    mysqli_stmt_bind_param($stmt,"s",$email);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    
                    if ($row = mysqli_fetch_assoc($result)) {
                    session_start();
                    session_regenerate_id(true);
                    $seshId = session_id();
                    $_SESSION['userID'] = $row['user_id']; 
                    $_SESSION['sessionId'] = $row['user_id'];
                    $_SESSION['sessionFname'] = $row['fname'];
                    $_SESSION['sessionLname'] = $row['lname'];
                    $_SESSION['pic'] = $row['img'];
                    $_SESSION['full-name-current'] = $row['fname'] . ' ' . $row['lname'];  
                    $_SESSION['userID'] = $row['user_id'];  

                    $_SESSION['stat'] = $row['status'];    
                    $_SESSION['email'] =$row['email'];
                    $sql = "SELECT * from users WHERE status IS NOT NULL AND user_id != ?";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt,$sql)) {
                        header("Location: ../loginStaticStatic.php?err=1");
                        exit();
                    }
                    else {
                    mysqli_stmt_bind_param($stmt,"i", $_SESSION['userID']);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $_SESSION['Full-Name']= array();
                    $_SESSION['Profile-Pics'] = array();
                    $_SESSION['stats'] = array();               
                    $_SESSION['userIDs'] = array();               
                    $_SESSION['fname'] = array();               
                    $_SESSION['lastseen'] = array();
                                   
                    $rows = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $FullName = $row['fname'] . ' ' .$row['lname'];
                        $ProfilePics = $row['img'];
                        $userStats = $row['status'];
                        $usersIDs = $row['user_id'];
                        $userLastseen = $row['lastseen'];
                        $fname = $row['fname'];
                        array_push($_SESSION["Full-Name"],$FullName);
                        array_push($_SESSION['userIDs'], $usersIDs);
                        array_push($_SESSION["Profile-Pics"], $ProfilePics);
                        array_push($_SESSION["stats"], $userStats);
                        array_push($_SESSION["fname"], $fname);
                        array_push($_SESSION["lastseen"], $userLastseen);
                        $rows++;
                    }
                
                    $_SESSION['rowsNum'] = $rows;
                    }    
                    // echo $_SESSION['Full-Name']['Amir Alzoubi'];
                    }
                    mysqli_stmt_close($stmt);
                    header("Location: ../users.php?Success=Loggedin?on=". $_SESSION['rowsNum']);
                }
            }
        }
            }
            else {
                header("Location: ../loginStatic.php?err=4");
                exit();
            }
        }
    }
    mysqli_close($conn);
}


?>