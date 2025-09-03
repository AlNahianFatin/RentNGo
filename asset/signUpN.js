function signupvalidation() {
    let Fname = document.getElementById("firstName").value.trim();
    let Lname = document.getElementById("lastName").value.trim();
    let semail = document.getElementById("semail").value.trim();
    let epassword = document.getElementById("epassword").value.trim();
    let confirmPassword = document.getElementById("confirmPassword").value.trim();

    let eFname = document.getElementById("eFname");
    let eLname = document.getElementById("eLname");
    let eEmail = document.getElementById("eEmail");
    let ePass = document.getElementById("ePassword");
    let eConfirmPass = document.getElementById("eCPassword");
    let emsg = document.getElementById("emsg");

    eFname.innerHTML = "";
    eLname.innerHTML = "";
    eEmail.innerHTML = "";
    ePass.innerHTML = "";
    eConfirmPass.innerHTML = "";
    emsg.innerHTML = "";

    let valid = true;

    if (Fname === ""||Lname === ""||semail === ""||epassword === ""||confirmPassword === "") {
        emsg.innerHTML = "Please fillup all the fields";
        valid = false;
    } 
    
    else if (Fname.length < 3 || Fname.length > 5) {
        emsg.innerHTML = "First Name must be between 3-5 characters";
        valid = false;
    }

   else if (epassword.length < 6) {
        emsg.innerHTML = "Password must be at least 6 characters long";
        valid = false;
    }

    if (epassword !== confirmPassword) {
        emsg.innerHTML = "Passwords do not match";
        valid = false;
    }

    if (!valid) {
        return false;
    }

    window.location.href = "../view/indexN.html";
    return false; 
}
