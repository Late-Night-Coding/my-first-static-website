<div class="wrapper" id="signup-container">
    <header>
        <div class="header">
            <p>Realtime Chat App</p>
        </div>
    </header>
    <section>
    <div class="content">
        <form action="includes/signup.php" method="post" enctype="multipart/form-data">
        <div class="input-wrapper">
            <label for="fname-input">First Name</label>
            <label name="label-lname" for="lname-input">Last Name</label>
            <div class="firstLast">
            
            <div class="input-fname">
            <input type="text" id="fname-input" name="fname" ></input>
            </div>
            
            
            <div class="input-lname">
            <input type="text" id="lname-input" name="lname"></input>
            </div>
        </div>
            <label for="email-input">Email Address</label>
            <div class="input-email">
            <input type="text" id="email-input" name="email"
            ></input>
            </div>
            <label for="pass-input">Password</label>
            <div class="input-pass">
            <input type="password" id="pass-input" name="password"></input>
            <i id="eye" class="fas fa-eye" ></i>
    
            </div>
            <label for="image-upload">Select Image</label>
            <div class="upload-img">
                
            <input type="file" id="image-upload" name="profilePic"></input>
            </div>
        
            <div class="input-button">
                <button type="submit" name="submit-signup" >Continue To Chat</button>
            </div>
            <div class="link-signin">
                <p>Already signed up? <a onclick="loginPage()" href="#">Login now</a></p>
            </div>
        </div>
        </div>
        <form>
    </section>
</div>
<script>
var url = "js/passshowhide.js";
$.getScript(url);
</script>