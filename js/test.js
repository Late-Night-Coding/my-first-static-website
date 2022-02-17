// Making a custom upload button
// Creating temporary url object to display it instantly when users successfully uploads an image
// Removing url object after loading the image
$(document).ready( function () {

const fileSelect = document.getElementById("file-select");
const fileElem = document.getElementById("change-profile-pic");

fileSelect.addEventListener("click", function(event) {
    if (fileElem) {
        fileElem.click();
    }
    event.preventDefault();
});

fileElem.addEventListener("change", function (){   
const img = document.getElementById("profile-pic");
img.src = URL.createObjectURL(fileElem.files[0])
img.onload = function() {
    URL.revokeObjectURL(img.src);
}
$("#submit-pic").fadeIn(400);
})
});



// type writer effect function
function typeWriter (text,id) {
    let charArray = '';
    for (let i =0; i < text.length; i++){
        charArray +=text[i];
    }
    const elem = id;
    var i =0; 
    var content ="";
    var refreshIntervalId = setInterval(() => {
        content += charArray[i];
        elem.innerHTML = content;
        i++;
        if (i == text.length)
        clearInterval(refreshIntervalId);
    }, 100);
}

// implementing type writer into P elements in DOM
$("body").ready(function () {
        // Type writer user's info
        typeWriterElems = document.querySelectorAll("#settings-container p");
        for (let i = 0; i < typeWriterElems.length; i++) {
            $("p").fadeTo("slow", 1)
            typeWriter(typeWriterElems[i].innerHTML, typeWriterElems[i])
        }
        let trflag = false;
    //
    $("#chng-pass").click(function (e) {
        e.preventDefault();
        $(".pass-change input, .pass-change button").toggle("fast");
        if (trflag === false) {
        $("#down-arrow").css({'transform' : 'rotate(180deg)'})
        trflag = true;
        }
        else {
            $("#down-arrow").css({'transform' : 'rotate(0deg)'}) 
            trflag = false;
        }
    })
})

