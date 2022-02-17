

$(document).ready ( function () {
    const show =  document.querySelector(".input-wrapper .input-pass input[type='password']");
    let toggleBtn = document.querySelector(".input-wrapper .input-pass i ");
    
    toggleBtn.onclick = ()=> {
    
    if (show.type =='password'){
        show.type = 'text';
       toggleBtn.classList.add("active");

    }
    else  {
        toggleBtn.classList.remove("active");
       show.type = "password";
     
    }
}
})
// $("#chk").hover(function () {
//     document.getElementById("star1").style.display = "block";
//     document.getElementById("star1").style.animationPlayState = "running";
//     console.log("hl;l")
// })