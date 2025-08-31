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

    eFname.innerHTML = "";
    eLname.innerHTML = "";
    eEmail.innerHTML = "";
    ePass.innerHTML = "";
    eConfirmPass.innerHTML = "";

    let valid = true;

    if (Fname === "") {
        eFname.innerHTML = "Please enter Your First Name first";
        valid = false;
    } else if (Fname.length < 3 || Fname.length > 5) {
        eFname.innerHTML = "First Name must be between 3-5 characters";
        valid = false;
    }

    if (Lname === "") {
        eLname.innerHTML = "Please enter Your Last Name first";
        valid = false;
    }

    if (semail === "") {
        eEmail.innerHTML = "Please enter Your Email first";
        valid = false;
    }

    if (epassword === "") {
        ePass.innerHTML = "Please enter Your Password first";
        valid = false;
    } else if (epassword.length < 6) {
        ePass.innerHTML = "Password must be at least 6 characters long";
        valid = false;
    }

    if (confirmPassword === "") {
        eConfirmPass.innerHTML = "Please enter Your Confirm Password first";
        valid = false;
    } else if (epassword !== confirmPassword) {
        eConfirmPass.innerHTML = "Passwords do not match";
        valid = false;
    }

    if (!valid) {
        return false; // stop if errors
    }

    // ✅ If all fields are correct → go to inventory.html
    window.location.href = "../View/inventory.html";
    return false; // prevent form submitting to PHP
}
