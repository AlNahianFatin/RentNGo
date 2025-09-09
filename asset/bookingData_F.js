let searchedC = false;

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

function searchCustomer() {
    searchedC = true;

    let customer = document.getElementById("Customer").value;

    if (customer === "") {
        mssg.textContent = "Please enter a customer name first";
        mssg.style.backgroundColor = "red";
        document.body.appendChild(mssg);

        setTimeout(() => {
            mssg.remove();
        }, 2000);
        return false;
    }

    let table = document.getElementById("records");
    let tbody = table.querySelector("tbody");

    let newRow = tbody.insertRow();
    newRow.insertCell().textContent = `1`;
    newRow.insertCell().textContent = `${customer}`;
    newRow.insertCell().textContent = ``;
    newRow.insertCell().textContent = ``;
    newRow.insertCell().textContent = ``;
    newRow.insertCell().textContent = ``;
    newRow.insertCell().textContent = ``;
    newRow.insertCell().textContent = ``;
    newRow.insertCell().textContent = ``;

    customer = "";
    document.getElementById("Customer").value = "";
    if (mssg && document.body.contains(mssg))
        mssg.remove();
    return true;
} 