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
                        row.insertCell().textContent = record.plocation;
                        row.insertCell().textContent = record.dlocation;
                        row.insertCell().textContent = record.renthours;
                        row.insertCell().textContent = record.fcost;
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