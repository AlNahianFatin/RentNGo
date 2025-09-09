let cars = 0;

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

let rowCarName = table.insertRow();
let rowRent = table.insertRow();
let rowSeats = table.insertRow();
let rowMileage = table.insertRow();
let rowCross = table.insertRow();
let rowBook = table.insertRow();

rowCarName.insertCell().textContent = "Car Name & Model";
rowRent.insertCell().textContent = "Rent (tk)";
rowSeats.insertCell().textContent = "No. of Seats";
rowMileage.insertCell().textContent = "Mileage (km)";
rowCross.insertCell().innerHTML = "";
rowBook.insertCell().innerHTML = "";

function createCrossButton(colIndex) {
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
        cars--;
    });
    return cross;
}

function createBookButton() {
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
        let id = 123;
        window.location.href = "../controller/CarComparisonSelected_F.php?id=" + encodeURIComponent(id);

    });
    return book;
}

function populateTable() {
    let colIndex = rowCarName.cells.length;

    rowCarName.insertCell().textContent = `Car ${cars + 1}`;
    rowRent.insertCell().textContent = `${1000 + cars * 500} tk`;
    rowSeats.insertCell().textContent = `${4 + cars}`;
    rowMileage.insertCell().textContent = `${12 + cars * 2} km/h`;
    rowCross.insertCell().appendChild(createCrossButton(colIndex));
    rowBook.insertCell().appendChild(createBookButton(colIndex));

    document.body.appendChild(table);
}

function addCar() {
    if (cars < 3) {
        populateTable();
        cars++;
        validateCarCount(cars + 1);
    }
    else {
        mssg.textContent = "Sorry! Cannot compare more than 3 cars at a time";
        mssg.style.backgroundColor = "red";
        document.body.appendChild(mssg);

        setTimeout(() => {
            mssg.remove();
        }, 2000);
        return false;
    }
}