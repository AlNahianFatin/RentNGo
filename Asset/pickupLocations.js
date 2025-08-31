let branchLocation;
let branchId = 1;

let pickLoc;
let dropLoc;

let locations = [];

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

let pRecords = document.getElementById("pickup");
let dRecords = document.getElementById("dropoff");
locations.forEach(rec => {
    let recordCustomer = document.createElement("option");
    recordCustomer.innerHTML = `${rec.loc}`;
    pRecords.appendChild(recordCustomer);
    dRecords.appendChild(recordCustomer);
})

let tbody = document.getElementById("records").querySelector("tbody");
tbody.innerHTML = "";
locations.forEach(rec => {
    let row = document.createElement("tr");
    row.innerHTML = `<td value=${rec.id}> ${rec.id} </td> <td value=${rec.loc} > ${rec.loc} </td>`;
    tbody.appendChild(row);
})

function clearTexts() {
    branchLocation = "";
    document.getElementById("location").value = "";

    pickLoc = "";
    dropLoc = "";

    if (mssg && document.body.contains(mssg))
        mssg.remove();
}

function validateLocation(event) {
    branchLocation = document.getElementById("location").value.trim();

    if (branchLocation === "") {
        mssg.textContent = "Please enter a branch location first";
        mssg.style.backgroundColor = "red";
        document.body.appendChild(mssg);

        setTimeout(() => {
            mssg.remove();
        }, 2000);
        return false;
    }

    let tbody = document.getElementById("records").querySelector("tbody");

    let record = document.createElement("tr");
    record.innerHTML = `<td> ${branchId} </td> <td> ${branchLocation} </td>`;
    tbody.appendChild(record);

    locations.push({ id: branchId++, loc: branchLocation });

    clearTexts();
    event.preventDefault();
    return true;
}

function validatePickupDropoff(event) {
    pickLoc = document.getElementById("pickup").value;
    dropLoc = document.getElementById("dropoff").value;

    if (pickLoc === "") {
        mssg.textContent = "Please select a pickup location first";
        mssg.style.backgroundColor = "red";
        document.body.appendChild(mssg);

        setTimeout(() => {
            mssg.remove();
        }, 2000);
        return false;
    }
    if (dropLoc === "") {
        mssg.textContent = "Please select a dropoff location first";
        mssg.style.backgroundColor = "red";
        document.body.appendChild(mssg);

        setTimeout(() => {
            mssg.remove();
        }, 2000);
        return false;
    }

    clearTexts();
    event.preventDefault();
    return true;
}