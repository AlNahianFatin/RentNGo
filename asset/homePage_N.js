document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("homeLogin").onclick = function () {
        window.location.href = "indexN.html";
    };
    document.getElementById("homeSignup").onclick = function () {
        window.location.href = "signup_N.html";
    };
});

function validationCheck(){
    let name = document.getElementById("username").value;
    let pass = document.getElementById("password").value;

    let eName = document.getElementById("eName");
    let ePass = document.getElementById("ePass");

    eName.innerHTML=""
    ePass.innerHTML=""

    if(name==""||pass==""){
        eName.innerHTML="Please enter Your Username or Password first"
        return false;
    }

    else if(name.length <3){
        ePass.innerHTML=""
        eName.innerHTML="Username at least 3 characters"
        return false;

    }
    
    else if(pass.length <6){
        eName.innerHTML=""
        ePass.innerHTML="Password must be at least 6 charecters long"
        return false;   

    }

    if(name!==""||pass!==""){
        window.location.href="../view/inventory.html";
        return true;
    }
}

document.addEventListener('DOMContentLoaded', function () {
    let resetBtn = document.getElementById("rst");
    let user = document.getElementById("username");
    let pass = document.getElementById("password");
    let eName = document.getElementById("eName");
    let ePass = document.getElementById("ePass");

    resetBtn.addEventListener("click", function () {
        user.value = "";   
        pass.value = "";   
        eName.innerHTML = "";
        ePass.innerHTML = "";
    });
});


