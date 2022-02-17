<?php 
include 'includes/loadmsgs.php';
?>

                <?php
                $image = imagecreatefromstring($_SESSION['Profile-Pics'][0]);
                $image = imagecopyresized($image, 200, 200); 
                    header('Content-Type: image/jpeg');
                imagejpeg($image);
        
       ?>