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
    let reward = document.getElementById("scheme").value;
    let points = Number(document.getElementById("points").value);
    let type = document.getElementById("type").value;
    let amount = Number(document.getElementById("amount").value);

    if(reward == "") {
        mssg.textContent = "Please enter a reward scheme first";
        mssg.style.backgroundColor = "red";
        document.body.appendChild(mssg);

        setTimeout(() => {
            mssg.remove();
        }, 2000);
        return false;
    }
    
    if(!points || isNaN(points) || points <= 0) {
        mssg.textContent = "Please enter a valid reward point first";
        mssg.style.backgroundColor = "red";
        document.body.appendChild(mssg);

        setTimeout(() => {
            mssg.remove();
        }, 2000);
        return false;
    }
    
    if(type == "") {
        mssg.textContent = "Please select a amentities type first";
        mssg.style.backgroundColor = "red";
        document.body.appendChild(mssg);
        
        setTimeout(() => {
            mssg.remove();
        }, 2000);
        return false;
    }
    
    if(!amount || isNaN(amount) || amount <= 0) {
        mssg.textContent = "Please enter a valid loyalty amount first";
        mssg.style.backgroundColor = "red";
        document.body.appendChild(mssg);

        setTimeout(() => {
            mssg.remove();
        }, 2000);
        return false;
    }
    if(type ="rentPercent" && amount > 100) {
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

    if(scheme == "") {
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