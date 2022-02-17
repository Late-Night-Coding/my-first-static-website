var flag = false;
var msgs = "";
var frndID = "";


// Ajax function to get chat msgs with friends ids as parameter

function showChat (friendID) {
    const body = document.getElementsByTagName("body")[0];
    
    $(".wrapper").fadeOut(600);
    $.ajax ({
        async: true,
        url: "./chat.php?reciever=" + friendID,
        data: {},
        type: "GET",
        success: function (result) {
            body.innerHTML +=result; 
            $("#chat-container").hide().fadeIn(100)
            $(".backArrow").fadeIn(300);
            msgs = result;
            flag = true;
            frndID = friendID;
        }
        }) 
    }
var settingsFlag = false;
function showSettings (index) {
    if (index == null)
    index = '';
    if (settingsFlag == false){
    $.ajax({
        url: "settings.php?" + index,
        data: {},
        type: "GET",
        success: function (result) {
            $(".wrapper").hide();
            $("body").append(result);
            $(".backArrow").show();
            $("#settings-container").hide().fadeIn(700)
            settingsFlag = true;
        }
    })
    }
    
    else {
       return
    }
}

// load incoming / just sent msgs into chat container interactively
function loadNewMsgs () {
    if (flag === true) {
        $.ajax({
            async: true,
            url: "chat.php?reciever=" + frndID,
            data: {},
            type: "GET",
            success: function (result) {
                if (msgs != result) {
                    msgs = result;
                    $("#chat-container").remove();
                    $("body").append(result);
                    $(".backArrow").show();
                    $("#msg-content").focus();
                }
                else {
                    return
                }
            }
        })
    }
}

function ajaxSendMsg(friendID){
    var msg = $("#msg-content").val();
    if (msg != '' && msg != ' ')
$.ajax({
    async: true,
    url: "includes/msgSystem.php",
    data: {
        'msgContent': msg, // Msg-content here is for php _POST['msgContent]
        // for _POST index.
        'friendID': friendID
    },
    type: "POST", 
    // success: function (){
    //   $(".bubblewrapper").append("<div class='sent'><p>" + msg + "</p> <small>" + time + "</small></div>")  
    // },
    success: function () {
        $("#msg-content").focus();
        loadNewMsgs();
    },
    error: function () {
        alert("Error")
    },
    cache: false
    
})
else
alert("Enter a message!");

}
 

// Enter to trigger send button
$(document).keyup(function (event) {
    if (event.which == 13) {
    if ($("#msg-content").is(":focus") == true) {
        $("#sendmsg").click();
        $("#msg-content").focus();
    }
    }
})
  
  
    
function backArrows () {
    $("#back-arrow").on('click',
    $("#user-container").hide().fadeIn(700),
    $("#chat-container").fadeOut(300).delay(800).remove(),
    $("#back-arrow").fadeOut(300).delay(800).remove(),
    $("#settings-container").fadeOut(300).delay(800).remove(),
    flag = false,
    settingsFlag = false
    );

}

// setTimeout(() => {
//     if (flag === true) {
//         setInterval(() => {
//             console.log(msgs)
//         }, 1500);
//     }

// }, 3000);



// Checking user's status
function checkStatus() {
    if (flag === false) {
        $.ajax({
            url: "includes/status.php",
            data: {},
            type: "GET",
            async: true,
            success: function (result) {
            // let i = document.querySelector("#i" + result);
            // i.classList = "fa fa-circle active"
            
            if (result !=""){
                // let changedStats = $("#msgstatus" + result).html() // innerHTML
                let i = document.querySelector("#i" + result);
                if (i.classList == "fa fa-circle") {
                    // changedStats = "Offline";
                    i.classList = "fa fa-circle active";
                }
                else {
                    // changedStats = "Active now";
                    i.classList = "fa fa-circle";
                }
            }
            else {
                return;
            }
            } 
        })
    }
}

$(document).ready( function (){
 checkStatus();   
})


setInterval(() => {
    loadNewMsgs()
    checkStatus()
}, 2550);


function lastMsg (reciever) {
    if (flag === false) {
        let lastMsg = document.getElementById("msgstatus" + reciever).innerHTML;
    $.ajax({
        url: "includes/lastmsg.php",
        data: { 
            'reciever': reciever,
            'flag': true
        },
        type: "GET",
        async: true,
        success: function (result){
            if (result  != lastMsg)
                $("#msgstatus" + reciever).html(result);
            else
                return
        }

    })
    }
}

// input to search for users(needs to be fixed) (interactive)
function usersSearch () {
    let input = $("#userSearch").val();
    let inputUpper = $("#userSearch").val().toUpperCase();
    var allUsers = document.querySelectorAll(".usersList");
    let userNames = document.querySelectorAll(".usersList span");
    let userNamesArr = [];
    for (let i=0; i < userNames.length; i++) {
        userNamesArr[i] = userNames[i].innerHTML;
    }
    
    for (let i =0; i<userNamesArr.length; i++) {
        if (input.length > 0)
        if (userNamesArr[i].includes(input) || userNamesArr.includes(inputUpper)) {
            let searchedFor = document.getElementById("user" + i);
            for (let i=0; i < allUsers.length; i++) {
                if (allUsers[i].id != searchedFor.id) {
                allUsers[i].style.display = "none"
                }
            }
        }
        
        if (input.length == 0) {
            for (let i=0; i < allUsers.length; i++) {
                allUsers[i].style.display = "flex"
            }
        }
    }
}

// closing browser will call ajax to signout from session

// function signOut() {
//     $.ajax({
//         url: "includes/signout.php",
//         type: "POST",
//         data: {},
//         async: true
//     })
// }


// trigger form submission (logging-out) when clicked from settings options
function signoutOption () {
        $(".logout form").submit()
}


// navigate to settings async to show success/err messages when settings are updated
$(document).ready( function () {
    let currentURL = window.location.href;
    if (currentURL.includes("err")) {
        $("#user-container").hide();
       let errIndex = currentURL.slice(-1);
       let err = 'err=' + errIndex;
       showSettings(err); 
    }
    else if (currentURL.includes("success")) {
        let successIndex = currentURL.slice(-1);
       let success = 'success=' + successIndex;
       showSettings(success); 
    }
})


// ajax for updating pass/profile pic
