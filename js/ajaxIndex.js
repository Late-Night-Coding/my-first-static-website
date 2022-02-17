// Show login page using AJAX
function loginPage() {
    var loginForm = document.getElementById("login-container");
    if (loginForm == null){
    $(".link-signin a").click(function (e) {
        e.preventDefault();
    })
    $.ajax({
        url: "login.php",
        type: "GET",
        data: {},
        async: true,
        success: function (result) {
            $("#signup-container").fadeOut(300).delay(800).remove();
            $("#title").fadeOut(300).delay(800).remove();
            $("body").append(result);
            $("#login-container").hide().fadeIn(700)
        }
    })
}
}

// Show signup page using AJAX
function signupPage() {
    var signupForm = document.getElementById("signup-container");
    if (signupForm == null){
    $(".link-signin a").click(function (e) {
        e.preventDefault();
    })
    $.ajax({
        url: "signup.php",
        type: "GET",
        data: {},
        async: true,
        success: function (result) {
            $(".wrapper").fadeOut(300).delay(800).remove();
            $("#title").fadeOut(300).delay(800).remove();
            $("body").append(result);
            $("#signup-container").hide().fadeIn(700)
           
        }
    })
}
}

$(document).ready( function () {
    let currentURL = window.location.href;
    if (currentURL == "http://localhost/BigOnephp/index.php?LoggedOut:)") {
       $("#url").click(); 
       console.log("yes")
    }
})