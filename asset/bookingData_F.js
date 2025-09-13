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
    let customer = document.getElementById("Customer").value.trim();
    let table = document.getElementById("records");
    let tbody = table.querySelector("tbody");
    tbody.innerHTML = "";

    const xhr = new XMLHttpRequest();
    xhr.open("GET", `../controller/BookingDataSearchCustomer_F.php`, true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) { 
            if (xhr.status === 200) {
                try {
                    let data = JSON.parse(xhr.responseText);

                    if (data.length === 0) {
                        let row = tbody.insertRow();
                        let cell = row.insertCell();
                        cell.colSpan = 11;
                        cell.textContent = "No records found";
                        return;
                    }

                    data.forEach(record => {
                        let row = tbody.insertRow();
                        row.insertCell().textContent = record.cname;
                        row.insertCell().textContent = record.bdate;
                        row.insertCell().textContent = record.plocation;
                        row.insertCell().textContent = record.dlocation;
                        row.insertCell().textContent = record.renthours;
                        row.insertCell().textContent = record.crent;
                        row.insertCell().textContent = record.fcost;
                        row.insertCell().textContent = record.trent;
                        row.insertCell().textContent = record.loyalty !== null ? record.loyalty : "---";
                        row.insertCell().textContent = record.frent;
                        row.insertCell().textContent = record.pstatus == 1 ? "Paid" : "Pending";
                    });
                } catch (err) {
                    console.error("Error parsing JSON:", err);
                }
            } else {
                console.error("Error fetching data:", xhr.status, xhr.statusText);
            }
        }
    };

    xhr.send(`customer=${encodeURIComponent(customer)}`);

    if (mssg && document.body.contains(mssg))
        mssg.remove();
    // return true;
}

let debounceTimer;
const customerInput = document.getElementById("Customer");
customerInput.addEventListener("input", () => {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(() => {
        searchCustomer();
    }, 200);
});