let branchLocation;
let branchId = 1;

let pickLoc;
let dropLoc;

let locations = [];

let searchedC = false;
let div;

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

function searchCustomer(event) {
    event.preventDefault();

    searchedC = true;

    let customer = document.getElementById("Customer").value;

    if (customer === "") {
        mssg.textContent = "Please enter a customer Id or name first";
        mssg.style.backgroundColor = "red";
        document.body.appendChild(mssg);

        setTimeout(() => {
            mssg.remove();
        }, 2000);
        return false;
    }

    if (div)
        div.remove();

    div = document.createElement("div");
    div.style.display = "flex";
    div.style.flexDirection = "column";
    div.style.alignItems = "center";
    div.style.justifyContent = "center";
    div.style.gap = "2vh";

    let table = document.createElement("table");
    table.border = "1";
    table.style.marginTop = "15vh";
    table.style.maxWidth = "80vw";
    table.style.overflowX = "auto";
    table.style.display = "block";

    let thead = table.createTHead();
    let headerRow = thead.insertRow();

    let th1 = document.createElement("th");
    th1.textContent = "Customer ID";
    headerRow.appendChild(th1);

    let th2 = document.createElement("th");
    th2.textContent = "Customer Name";
    headerRow.appendChild(th2);

    let tbody = table.createTBody();
    let dataRow = tbody.insertRow();

    dataRow.insertCell().textContent = `fgh`;
    dataRow.insertCell().textContent = `${customer}`;

    div.appendChild(table);

    let bttnGroup = document.createElement("div");
    bttnGroup.style.display = "flex";
    bttnGroup.style.gap = "2vw";

    let clear = document.createElement("button");
    clear.classList.add("button");
    clear.innerText = "Clear";
    clear.style.backgroundColor = "red";

    clear.addEventListener("click", function () {
        div.remove();
    });

    let confirm = document.createElement("button");
    confirm.classList.add("button");
    confirm.innerText = "Confirm";

    confirm.addEventListener("click", function () {

    });

    bttnGroup.appendChild(clear);
    bttnGroup.appendChild(confirm);
    div.appendChild(bttnGroup);
    document.body.appendChild(div);

    customer = "";
    document.getElementById("Customer").value = "";
    if (mssg && document.body.contains(mssg))
        mssg.remove();
    return true;
} 