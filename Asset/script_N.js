function validationCheck(){
    let name = document.getElementById("username").value;
    let pass = document.getElementById("password").value;

    let eName = document.getElementById("eName");
    let ePass = document.getElementById("ePass");

    eName.innerHTML=""
    ePass.innerHTML=""

    if(name!==""||pass!==""){
        window.location.href="../View/inventory.html";
        return true;
    }else if(name=="" ){
        eName.innerHTML="Please enter Your Username first"
        return false;

    }else if(pass == ""){
         ePass.innerHTML="Please enter Your Password first"
         return false;
    }else if(name.length >5||name.length <3){
        ePass.innerHTML=""
        eName.innerHTML="Username must be between 3-5 charecters"
        return false;

    }else if(pass.length <6){
        eName.innerHTML=""
        ePass.innerHTML="Password must be at least 6 charecters long"
        return false;   

    }else{
        fetch("login.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `username=${encodeURIComponent(name)}&password=${encodeURIComponent(pass)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Login successfully");
                window.location.href = "../View/inventory.html";
            } else {
                ePass.innerHTML = data.message || "Login failed";
            }
        })
        .catch(() => {
            ePass.innerHTML = "Server error";
        });
        return false;
    }
}