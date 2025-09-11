let cars = 0;
let carIDs = [];
let isAdmin = false;

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

let table = document.createElement("table");
table.border = "1";
table.style.margin = "5vh auto";
let tbody = table.querySelector("tbody") || table.createTBody();

// let rowCarID = table.insertRow();
let rowCarBrand = table.insertRow();
let rowCarModel = table.insertRow();
let rowRent = table.insertRow();
let rowSeats = table.insertRow();
let rowMileage = table.insertRow();
let rowAvailable = table.insertRow();
let rowCross = table.insertRow();
let rowBook = table.insertRow();

// rowCarID.insertCell().textContent = "Car ID";
rowCarBrand.insertCell().textContent = "Car Brand";
rowCarModel.insertCell().textContent = "Car Model";
rowRent.insertCell().textContent = "Rent (tk/hr)";
rowSeats.insertCell().textContent = "No. of Seats";
rowMileage.insertCell().textContent = "Mileage (km)";
rowAvailable.insertCell().textContent = "Available Quantity";
rowCross.insertCell().innerHTML = "";
rowBook.insertCell().innerHTML = "";

function createCrossButton(colIndex, carID) {
    const cross = document.createElement("button");
    cross.innerHTML = "X";
    cross.style.position = "relative";
    cross.style.padding = "5px 8px";
    cross.style.fontSize = "16px";
    cross.style.fontWeight = "bold";
    cross.style.backgroundColor = "red";
    cross.style.border = "0px";
    cross.style.transition = "transform 0.3s ease, color 0.3s ease";
    cross.style.cursor = "pointer";

    cross.addEventListener("click", function () {
        for (let row of table.rows) {
            if (row.cells[colIndex]) row.deleteCell(colIndex);
        }
        carIDs = carIDs.filter(id => id !== carID);
        if(cars > 0) 
            cars--;
        if(cars <= 0)
            table.remove();
    });
    return cross;
}

function createBookButton(carID) {
    const book = document.createElement("button");
    book.innerHTML = "Book";
    book.style.position = "relative";
    book.style.padding = "5px 8px";
    book.style.fontSize = "16px";
    book.style.fontWeight = "bold";
    book.style.border = "0px";
    book.style.transition = "transform 0.3s ease, color 0.3s ease";
    book.style.cursor = "pointer";

    book.addEventListener("click", function () {
        // let id = 123;
        // window.location.href = "../controller/CarComparisonSelected_F.php?id=" + encodeURIComponent(id);
        // for (let row of table.rows) {
        //     if (row.cells[colIndex]) row.deleteCell(colIndex);
        // }
        console.log("Book clicked for car ID:", carID);
    });
    return book;
}

function populateTable(carID) {
    // let car = document.getElementById("Car").value.trim();
    let colIndex = rowCarBrand.cells.length;

    const xhr = new XMLHttpRequest();
    xhr.open("GET", `../controller/CarComparisonCompareCar_F.php?car=${encodeURIComponent(carID)}`, true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                try {
                    let data = JSON.parse(xhr.responseText);

                    if (!data || typeof data !== "object" || Object.keys(data).length === 0) {
                        rowCarBrand.insertCell().textContent = "Unknown Brand";
                        rowCarModel.insertCell().textContent = "Unknown Model";
                        rowRent.insertCell().textContent = "-";
                        rowSeats.insertCell().textContent = "-";
                        rowMileage.insertCell().textContent = "-";
                        rowAvailable.insertCell().textContent = "Unknown";
                        rowCross.insertCell().appendChild(createCrossButton(colIndex, carID));
                    }

                    else {
                        // let row = tbody.insertRow();
                        // row.insertCell().textContent = Number(record.cid);
                        rowCarBrand.insertCell().textContent = data.brand;
                        rowCarModel.insertCell().textContent = data.model;
                        rowRent.insertCell().textContent = Number(data.rent);
                        rowSeats.insertCell().textContent = Number(data.seatno);
                        rowMileage.insertCell().textContent = Number(data.mileage);
                        rowAvailable.insertCell().textContent = Number(data.available) <= 0 ? "Not available" : Number(data.available);
                        rowCross.insertCell().appendChild(createCrossButton(colIndex, carID));
                        if(!isAdmin)
                            rowBook.insertCell().appendChild(createBookButton(colIndex, carID));
                    }
                } 
                catch (err) {
                    console.error("Error parsing JSON:", err);
                }
            } 
            else 
                console.error("Error fetching data:", xhr.status, xhr.statusText);
        }
    };

    xhr.send();

    // rowCarID.insertCell().textContent = `Car ${cars + 1}`;
    // rowCarBrand.insertCell().textContent = `Car ${cars + 1}`;
    // rowCarModel.insertCell().textContent = `Car ${cars + 1}`;
    // rowRent.insertCell().textContent = `${1000 + cars * 500} tk`;
    // rowSeats.insertCell().textContent = `${4 + cars}`;
    // rowMileage.insertCell().textContent = `${12 + cars * 2} km/h`;
    // rowAvailable.insertCell().textContent = `${12 + cars * 2} km/h`;
    // rowCross.insertCell().appendChild(createCrossButton(colIndex));
    // rowBook.insertCell().appendChild(createBookButton(colIndex));

    document.body.appendChild(table);
}

function addCar(carID, adminFlag) {
    if (cars < 3) {
        isAdmin = adminFlag;
        carIDs.push(carID);
        populateTable(carID);
        cars++;
    }
    else {
        mssg.textContent = "Sorry! Cannot compare more than 3 cars at a time";
        mssg.style.backgroundColor = "red";
        document.body.appendChild(mssg);

        setTimeout(() => {
            mssg.remove();
        }, 2000);
        // return false;
    }
}

function createCompareButton(carID) {
    const compare = document.createElement("button");
    compare.innerHTML = "Compare";

    compare.addEventListener("click", function () {
        addCar(carID);
    });
    return compare;
}

function searchCar() {
    let car = document.getElementById("Car").value.trim();
    let table2 = document.getElementById("records");
    let tbody2 = table2.querySelector("tbody");
    tbody2.innerHTML = "";

    const xhr = new XMLHttpRequest();
    xhr.open("GET", `../controller/CarComparisonSearchCar_F.php?car=${encodeURIComponent(car)}`, true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                try {
                    let data = JSON.parse(xhr.responseText);

                    if (data.length === 0) {
                        let row = tbody2.insertRow();
                        let cell = row.insertCell();
                        cell.colSpan = 8;
                        cell.textContent = "No records found";
                        return;
                    }

                    data.forEach(record => {
                        let row = tbody2.insertRow();
                        row.insertCell().textContent = Number(record.cid);
                        row.insertCell().textContent = record.brand;
                        row.insertCell().textContent = record.model;
                        row.insertCell().textContent = Number(record.rent);
                        row.insertCell().textContent = Number(record.seatno);
                        row.insertCell().textContent = Number(record.mileage);
                        row.insertCell().textContent = Number(record.available) <= 0 ? "Not available" : Number(record.available);
                        row.insertCell().appendChild(createCompareButton(Number(record.cid)));
                    });
                } catch (err) {
                    console.error("Error parsing JSON:", err);
                }
            } else {
                console.error("Error fetching data:", xhr.status, xhr.statusText);
            }
        }
    };

    xhr.send();

    if (mssg && document.body.contains(mssg))
        mssg.remove();
    // return true;
}

let debounceTimer;
const carInput = document.getElementById("Car");
carInput.addEventListener("input", () => {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(() => {
        searchCar();
    }, 200);
});