let mssg = document.createElement("label");
mssg.id = "msg";
mssg.style.position = "fixed";
mssg.style.top = "20px";
mssg.style.left = "50%";
mssg.style.transform = "translateX(-50%)";
mssg.style.color = "white";
mssg.style.opacity = "0.9"
mssg.style.padding = "10px 20px";
mssg.style.border = "1px solid black";
mssg.style.borderRadius = "6px";
mssg.style.fontFamily = "Inika";
mssg.style.zIndex = "9999";
mssg.style.boxShadow = "0 5px 10px rgba(0,0,0,0.6)";

function validateAddScheme() {
    let reward = document.getElementById("scheme").value.trim();
    let points = Number(document.getElementById("points").value);
    let type = document.getElementById("type").value.trim();
    let amount = Number(document.getElementById("amount").value);

    if (reward == "") {
        mssg.textContent = "Please enter a reward scheme first";
        mssg.style.backgroundColor = "red";
        document.body.appendChild(mssg);

        setTimeout(() => {
            mssg.remove();
        }, 2000);
        return false;
    }

    if (isNaN(points) || points < 0) {
        mssg.textContent = "Please enter a valid reward point first";
        mssg.style.backgroundColor = "red";
        document.body.appendChild(mssg);

        setTimeout(() => {
            mssg.remove();
        }, 2000);
        return false;
    }

    if (type == "") {
        mssg.textContent = "Please select a amentities type first";
        mssg.style.backgroundColor = "red";
        document.body.appendChild(mssg);

        setTimeout(() => {
            mssg.remove();
        }, 2000);
        return false;
    }

    if (!amount || isNaN(amount) || amount <= 0) {
        mssg.textContent = "Please enter a valid loyalty amount first";
        mssg.style.backgroundColor = "red";
        document.body.appendChild(mssg);

        setTimeout(() => {
            mssg.remove();
        }, 2000);
        return false;
    }
    if (type === "Rent Discount (%)" && amount > 100) {
        mssg.textContent = "Loyalty amount cannot be more than 100%";
        mssg.style.backgroundColor = "red";
        document.body.appendChild(mssg);

        setTimeout(() => {
            mssg.remove();
        }, 2000);
        return false;
    }
    return true;
}

function validateScheme() {
    let scheme = document.getElementById("scheme").value;

    if (scheme == "") {
        mssg.textContent = "Please enter a reward scheme first";
        mssg.style.backgroundColor = "red";
        document.body.appendChild(mssg);

        setTimeout(() => {
            mssg.remove();
        }, 2000);
        return false;
    }
    return true;
}

function activation(scheme, isActive) {
    newStatus = isActive ? 0 : 1;
    const xhr = new XMLHttpRequest();
    xhr.open("POST", `../controller/LoyaltyProgramActivation_F.php`, true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                let btn = document.getElementById("activationBttn" + scheme);
                let stts = document.getElementById("activationStts" + scheme);
                if (btn) {
                    btn.innerHTML = newStatus ? "Deactivate" : "Activate";
                    stts.innerHTML = newStatus ? "Active" : "Deactive";
                    btn.setAttribute("onclick", `activation('${scheme}', ${newStatus})`);

                    statusText = newStatus ? "activated" : "deactivated";
                    mssg.textContent = scheme + " has been successfully " + statusText;
                    mssg.style.backgroundColor = "green";
                    document.body.appendChild(mssg);

                    setTimeout(() => {
                        mssg.remove();
                    }, 2000);
                }
                else
                    console.error("Error updating activation:", xhr.status, xhr.statusText);
            }
        };
    }
    xhr.send(`scheme=${encodeURIComponent(scheme)}&activation=${encodeURIComponent(newStatus)}`);
}

function dlt(scheme) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", `../controller/LoyaltyProgramDeletion_F.php`, true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                let btn = document.getElementById("dltBttn" + scheme);
                // let stts = document.getElementById("activationStts" + scheme);
                if (btn) {
                    // btn.innerHTML = newStatus ? "Deactivate" : "Activate";
                    // stts.innerHTML = newStatus ? "Active" : "Deactive";
                    // btn.setAttribute("onclick", `activation('${scheme}', ${newStatus})`);

                    // statusText = newStatus ? "activated" : "deactivated";
                    let row = btn.closest("tr");
                    if (row)
                        row.remove();

                    mssg.textContent = scheme + " has been successfully deleted";
                    mssg.style.backgroundColor = "green";
                    document.body.appendChild(mssg);

                    setTimeout(() => {
                        mssg.remove();
                    }, 2000);
                }
                else
                    console.error("Error deleting scheme:", xhr.status, xhr.statusText);
            }
        };
    }
    xhr.send(`scheme=${encodeURIComponent(scheme)}`);
    xhr.send(`customer=${encodeURIComponent(customer)}`);
}

function validateUpdateScheme() {
    let points = Number(document.getElementById("points").value);
    let type = document.getElementById("type").value.trim();
    let amount = Number(document.getElementById("amount").value);

    if (isNaN(points) || points < 0) {
        mssg.textContent = "Please enter a valid reward point first";
        mssg.style.backgroundColor = "red";
        document.body.appendChild(mssg);

        setTimeout(() => {
            mssg.remove();
        }, 2000);
        return false;
    }

    if (type == "") {
        mssg.textContent = "Please select a amentities type first";
        mssg.style.backgroundColor = "red";
        document.body.appendChild(mssg);

        setTimeout(() => {
            mssg.remove();
        }, 2000);
        return false;
    }

    if (!amount || isNaN(amount) || amount <= 0) {
        mssg.textContent = "Please enter a valid loyalty amount first";
        mssg.style.backgroundColor = "red";
        document.body.appendChild(mssg);

        setTimeout(() => {
            mssg.remove();
        }, 2000);
        return false;
    }
    if (type === "Rent Discount (%)" && amount > 100) {
        mssg.textContent = "Loyalty amount cannot be more than 100%";
        mssg.style.backgroundColor = "red";
        document.body.appendChild(mssg);

        setTimeout(() => {
            mssg.remove();
        }, 2000);
        return false;
    }

    // const xhr = new XMLHttpRequest();
    // xhr.open("POST", `../controller/LoyaltyProgramUpdate_F.php`, true);
    // xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    
    // xhr.onreadystatechange = function () {
    //     if (xhr.readyState === 4) {
    //         if (xhr.status === 200) {
    //             // let stts = document.getElementById("activationStts" + scheme);
    //             if (btn) {
    //                 // btn.innerHTML = newStatus ? "Deactivate" : "Activate";
    //                 // stts.innerHTML = newStatus ? "Active" : "Deactive";
    //                 // btn.setAttribute("onclick", `activation('${scheme}', ${newStatus})`);
                    
    //                 // statusText = newStatus ? "activated" : "deactivated";
    //                 let row = btn.closest("tr");
    //                 if(row) 
    //                     row.remove();
                    
    //                 mssg.textContent = scheme + " has been successfully updated";
    //                 mssg.style.backgroundColor = "green";
    //                 document.body.appendChild(mssg);
                    
    //                 setTimeout(() => {
    //                     mssg.remove();
    //                 }, 2000);
    //             }
    //             else
    //                 console.error("Error deleting scheme:", xhr.status, xhr.statusText);
    //         }
    //     };
    // }
    // xhr.send(`scheme=${encodeURIComponent(scheme)}`);
    
    return true;
}