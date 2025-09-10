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

    let customer = document.getElementById("Customer").value.trim();

    // if (customer === "") {
    //     mssg.textContent = "Please enter a customer name first";
    //     mssg.style.backgroundColor = "red";
    //     document.body.appendChild(mssg);

    //     setTimeout(() => {
    //         mssg.remove();
    //     }, 2000);
    //     return false;
    // }

    fetch(`../controller/BookingDataSearchCustomer_F.php?customer=${encodeURIComponent(customer)}`)
        .then(response => response.json())
        .then(data => {
            let table = document.getElementById("records");
            let tbody = table.querySelector("tbody");
            tbody.innerHTML = "";

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
        })
        .catch(error => console.error("Error fetching data:", error));

    if (mssg && document.body.contains(mssg))
        mssg.remove();
    return true;
}

let debounceTimer;
const customerInput = document.getElementById("Customer");
customerInput.addEventListener("input", () => {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(() => {
        searchCustomer();
    }, 200); 
});