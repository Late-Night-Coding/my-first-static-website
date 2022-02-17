<?php
session_start();
if (isset($_SESSION['sessionId'])) : ?>
<?php 
require_once 'includes/login.php';
?> 


    
    <div class="wrapper" id="settings-container" ontouchstart="">
    <div class="backArrow">
        <button><i id="back-arrow" onclick="backArrows()" class="fas fa-arrow-left"></i></button>
    </div>
        <div class="changeImg">
            <form action="includes/change-profile-pic.php" method="post" enctype="multipart/form-data">
                <img id="profile-pic" src="<?= 'data:image/png;base64,' . base64_encode ($_SESSION['pic'])?>" alt="" onerror=this.src="imgs/noImageDP.jpg">
                <a href="#" id="file-select">Change Image </a>
                <input name="chng-dp" type="file"  id="change-profile-pic" ></input>
                <button name="pic-submit" type="submit" id="submit-pic" hidden>Submit</button>
        </form>
</div>
<?php 
    if (isset($_GET['err'])) {
        $errIndex = $_GET['err'];
        switch ($errIndex) {
            case 0:
                ?><div class="err-pass"><i class="fas fa-skull" ></i><p id="settings-err"> Some feilds are empty</p></div>
            <?php
                break;
            case 1:
                ?><div class="err-pass"><i class="fas fa-skull" ></i><p id="settings-err"> Passwords do not match</p></div>
            <?php
                break;
            case 2:
                ?><div class="err-pass"><i class="fas fa-skull" ></i><p id="settings-err"> SQL database error</p></div>
                <?php
                break;
            case 3:
                ?><div class="err-pass"><i class="fas fa-skull" ></i><p id="settings-err"> Current Password is invalid</p></div>
            <?php
                break;
            case 4:
                ?><div class="err-pass"><i class="fas fa-skull" ></i><p id="settings-err"> No image is uploaded</p></div>
            <?php
                break;
            case 5:
                ?><div class="err-pass"><i class="fas fa-skull" ></i><p id="settings-err"> Image type is invalid</p></div>
            <?php
                break;
            case 6:
                ?><div class="err-pass"><i class="fas fa-skull" ></i><p id="settings-err"> Image size exceeds the limit </p></div>
            <?php
                break;
            default:
                ?><div style="display: none" class="err-pass"></div>
                <?php
                break;
        }
}
else if (isset($_GET['success'])) {
    $succIndex = $_GET['success'];
    switch($succIndex) {
        case 1:
            ?><div class="success"><i class="fas fa-check-circle"></i><p id="no-err">Profile picture changed successfully</p></div>
            <?php
            break;
        case 2:
            ?><div class="success"><i class="fas fa-check-circle"></i><p id="no-err">Password changed successfully</p></div>
            <?php
            break;
        default:
        ?><div class="success" style="display: none"></div> <?php
        break;
    }
}
?>
        <p >Name: <?= $_SESSION['full-name-current']?></p>
        <p >Email: <?= $_SESSION['email']?></p>
        <p id="settings-p">User id: <?=$_SESSION['sessionId']?></p><a href="#" id="chng-pass">Change Password<i class="fas fa-chevron-down" id="down-arrow"></i></a>
        <form action="includes/change-pass.php" method="post" class="pass-change">
            <input type="password" name="currentPass" required placeholder="Enter current password">
            <input type="password" name="newPass" required placeholder="Enter new password">
            <input type="password" name="confNew" required placeholder="Confirm new password">
            <button type="submit" name="change-pass-submit" id="submit-pass" hidden>Submit</button>
        </form>
</div>
<script>
var url = "js/test.js";
$.getScript(url);
</script>


<?php else :
    header("Location: login.php?err=login");
    exit();
endif;?>