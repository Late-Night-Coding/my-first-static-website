<?php
if (isset($_POST['submit-signup'])){
    require 'usersDatabase.php';
 
    $fname = ucfirst($_POST['fname']);
    $lname = ucfirst($_POST['lname']);
    $email = ucfirst($_POST['email']);
    $password = $_POST['password'];
    $tmp_name = $_FILES['profilePic']['tmp_name'];
    // Pic Size
  

    if (empty($fname) || empty($lname)|| empty($email) || empty($password)){
            header("Location: ../signupStatic.php?err=0");
            exit();
    }   
    // else if (!is_uploaded_file($_FILES['profilePic']['tmp_name'])){
    //     header("Location: ../signupStatic.php?Error=NoPictureUploaded");
    //     exit();
    // }
        
    
    else {
        
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            header("Location: ../signupStatic.php?err=1");
            exit();
        }
        else {
            $sql = "SELECT * from users WHERE email = ?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt,$sql)){
                header("Location: ../signupStatic.php?err=2");
                exit();
            }
            else {
                mysqli_stmt_bind_param($stmt,"s",$email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $rowCount = mysqli_stmt_num_rows($stmt);
                if ($rowCount > 0){
                header("Location: ../signupStatic.php?err=3");
                exit();
                }
                else {
                    if ($_FILES['chng-dp']['size'] > 1000000){
                        header("Location: ../settings.php?err=5");
                        exit();
                    }
                    else {
                    $name = $_FILES['profilePic']['name'];
                    $acceptedPics = array('jpg','jpeg','png');
                    $explodeArray = explode('.',$name);
                    $extention = end($explodeArray);
                    $extToLower = strtolower($extention);
                    if (in_array($extToLower,$acceptedPics)){
                        $newName = $fname . $lname . uniqid("",true) . '.' . $extToLower;
                        $imageData = file_get_contents($tmp_name); 
                        // $newFileLocation = "uploads/$newName";
                        // move_uploaded_file($tmp_name,$newFileLocation);
                    }
                    else {
                        header("Location: ../signupStatic.php?err=4");
                        exit();
            
                    }
                    $sql = "INSERT INTO users (fname,lname,email,password,img) VALUES (?,?,?,?,?)";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt,$sql)){
                        header("Location: ../signupStatic.php?err=2");
                        exit();
                    }
                    $hashedPass = password_hash($password,PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt,"sssss",$fname,$lname,$email,$hashedPass,$imageData);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../loginStatic.php?success=1&email=". $email);
                    exit();
                }
            }
        }

    }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

?>