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

function createActivationButton(bid, isActive) {
    const activate = document.createElement("button");
    activate.innerHTML = isActive ? "Deactivate" : "Activate";
    activate.id = "availableBttn" + bid;

    activate.addEventListener("click", function () {
        availability(bid, isActive);
    });
    return activate;
}

function createUpdateButton(bid) {
    const update = document.createElement("button");
    update.innerHTML = "Update";

    update.addEventListener("click", function () {
        window.location.href = `../controller/setBranch_F.php?bid=${encodeURIComponent(bid)}`;
    });
    return update;
}

function createDeleteButton(bid) {
    const d = document.createElement("button");
    d.innerHTML = "Delete";
    d.id = "dltBttn" + bid;
    d.style.backgroundColor = "red";

    d.addEventListener("click", function () {
        dlt(bid);
    });
    return d;
}

function clearTexts() {
    branchLocation = "";
    document.getElementById("district").value = "";
    document.getElementById("location").value = "";

    pickLoc = "";
    dropLoc = "";

    if (mssg && document.body.contains(mssg))
        mssg.remove();
}

function validateUpdateLocation(bid) {
    let district = document.getElementById("district").value.trim();
    let location = document.getElementById("location").value.trim();

    if (district == "") {
        mssg.textContent = "Please enter a district first";
        mssg.style.backgroundColor = "red";
        document.body.appendChild(mssg);

        setTimeout(() => {
            mssg.remove();
        }, 2000);
        return false;
    }
    
    if (location == "") {
        mssg.textContent = "Please enter a location first";
        mssg.style.backgroundColor = "red";
        document.body.appendChild(mssg);

        setTimeout(() => {
            mssg.remove();
        }, 2000);
        return false;
    }
    return true;
}

function validateLocation() {
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
    return true;
}

function validatePickupDropoff() {
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
    return true;
}

let debounceTimer;
const locationInput = document.getElementById("Branch");
locationInput.addEventListener("input", () => {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(() => {
        searchLocation();
    }, 200);
});

function searchLocation() {
    let branch = document.getElementById("Branch").value.trim();
    let table = document.getElementById("records");
    let tbody = table.querySelector("tbody");
    tbody.innerHTML = "";

    const xhr = new XMLHttpRequest();
    xhr.open("GET", `../controller/PickupLocationSearchLocation_F.php?branch=${encodeURIComponent(branch)}`, true);
    xhr.send();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                try {
                    let data = JSON.parse(xhr.responseText);

                    if (!Array.isArray(data) || data.length === 0) {
                        let row = tbody.insertRow();
                        let cell = row.insertCell();
                        cell.colSpan = 7;
                        cell.textContent = "No records found";
                        return;
                    }

                    data.forEach(record => {
                        let row = tbody.insertRow();
                        row.insertCell().textContent = record.bid;
                        row.insertCell().textContent = record.district;
                        row.insertCell().textContent = record.location;

                        let statusCell = row.insertCell();
                        statusCell.id = "availibilityStts" + record.bid;
                        statusCell.textContent = Number(record.available) === 1 ? "Available" : "Unavailable";

                        row.insertCell().appendChild(createActivationButton(record.bid, Number(record.available) === 1));
                        row.insertCell().appendChild(createUpdateButton(record.bid));
                        row.insertCell().appendChild(createDeleteButton(record.bid));
                    });
                } catch (err) {
                    console.error("Error parsing JSON:", err);
                }
            } else {
                console.error("Error fetching data:", xhr.status, xhr.statusText);
            }
        }
    };

    if (mssg && document.body.contains(mssg))
        mssg.remove();
}

function availability(bid, isActive) {
    let newStatus = isActive ? 0 : 1;
    const xhr = new XMLHttpRequest();
    xhr.open("POST", `../controller/PickupLocationActivation_F.php`, true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                let btn = document.getElementById("availableBttn" + bid);
                let stts = document.getElementById("availibilityStts" + bid);
                if (btn) {
                    btn.innerHTML = newStatus ? "Deactivate" : "Activate";
                    stts.innerHTML = newStatus === 1 ? "Available" : "Unavailable";
                    btn.setAttribute("onclick", `availability('${bid}', ${newStatus})`);

                    statusText = newStatus ? "activated" : "deactivated";
                    mssg.textContent = bid + " has been successfully " + statusText;
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
    xhr.send(`bid=${encodeURIComponent(bid)}&activation=${encodeURIComponent(newStatus)}`);
}

function dlt(bid) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", `../controller/PickupLocationDeletion_F.php`, true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                let btn = document.getElementById("dltBttn" + bid);
                if (btn) {
                    let row = btn.closest("tr");
                    if (row)
                        row.remove();

                    mssg.textContent = bid + " has been successfully deleted";
                    mssg.style.backgroundColor = "green";
                    document.body.appendChild(mssg);

                    setTimeout(() => {
                        mssg.remove();
                    }, 2000);
                }
                else
                    console.error("Error deleting location:", xhr.status, xhr.statusText);
            }
        };
    }
    xhr.send(`bid=${encodeURIComponent(bid)}`);
}