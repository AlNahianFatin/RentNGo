let pLitreInput = document.getElementById("pickupFuel");
let dLitreInput = document.getElementById("dropoffFuel");
let fuelRateInput = document.getElementById("fuelRate");
let refuelCost = document.getElementById("refuelCost");

let pLitre;
let dLitre;
let fuelRate;
let refilledLitreInput;
let refilled;

let cost;

pLitreInput.addEventListener("input", () => {
    pLitre = pLitreInput.value.trim();
    calculateFuel();
});
dLitreInput.addEventListener("input", () => {
    dLitre = dLitreInput.value.trim();
    calculateFuel();
});
fuelRateInput.addEventListener("input", () => {
    fuelRate = fuelRateInput.value.trim();
    calculateFuel();
});

let refueled = false;

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

function calculateFuel() {
    let p = Number(pLitreInput.value.trim()) || 0;
    let d = Number(dLitreInput.value.trim()) || 0;
    let rate = Number(fuelRateInput?.value.trim() || 0);

    if (refueled)
        refilled = Number(refilledLitreInput.value.trim())
    else
        refilled = 0;

    if (p >= d)
        cost = rate * (refilled + (p - d));
    else {
        refuel();
        mssg.innerHTML = "Please enter refilled amount";
        mssg.style.backgroundColor = "#eba923";
        document.body.appendChild(mssg);

        setTimeout(() => {
            mssg.remove();
        }, 2000);
        cost = rate * (refilled - (d - p));
    }
    refuelCost.style.display = "none";
    refuelCost.innerHTML = `Fuel Cost: ${cost} tk<br>`;
    refuelCost.style.display = "inline-block";
}

function refuel() {
    if (refueled)
        return false;
    refueled = true;

    let oldForm = document.querySelector("form");

    let oldSubmit = document.getElementsByName("submit")[0];
    if (oldSubmit)
        oldSubmit.style.display = "none";

    let form = document.createElement("form");
    form.addEventListener("submit", validateFuel);

    let fieldSet = document.createElement("fieldset");
    fieldSet.style.position = "relative";
    fieldSet.style.minWidth = "600px";

    let refilled = document.createElement("label");
    refilled.innerHTML = "Fuel Refilled: ";
    refilled.classList.add("font-itim");

    refilledLitreInput = document.createElement("input");
    refilledLitreInput.type = "number";
    refilledLitreInput.classList.add("font-itim");
    refilledLitreInput.addEventListener("input", calculateFuel);

    let litre = document.createElement("label");
    litre.innerHTML = " litres <br>";
    litre.classList.add("font-itim");

    const cross = document.createElement("button");
    cross.name = "close";
    cross.innerHTML = "X";
    cross.style.position = "absolute";
    cross.style.top = "10px";
    cross.style.right = "10px";
    cross.style.padding = "5px 5px";
    cross.style.fontSize = "18px";
    cross.style.fontWeight = "bold";
    cross.style.backgroundColor = "transparent";
    cross.style.border = "0px";
    cross.style.transition = "transform 0.3s ease, color 0.3s ease";
    cross.addEventListener("mouseenter", function () {
        cross.style.transform = "scale(1.5) rotate(180deg)";
        cross.style.color = "#6E473B";
        cross.style.opacity = "0.8";
        cross.style.border = "2px solid black";
    });
    cross.addEventListener("mouseleave", function () {
        cross.style.transform = "scale(1) rotate(0deg)";
        cross.style.color = "black";
        cross.style.opacity = "1";
        cross.style.border = "0px"
    });
    cross.addEventListener("click", function () {
        form.remove();
        refueled = false;
        oldSubmit.style.display = "inline-block";
    });

    let submit = document.createElement("input");
    submit.type = "submit";
    submit.name = "submit";
    submit.value = "Submit";

    fieldSet.appendChild(refilled);
    fieldSet.appendChild(refilledLitreInput);
    fieldSet.appendChild(litre);
    fieldSet.appendChild(cross);
    fieldSet.appendChild(submit);

    form.appendChild(fieldSet);
    oldForm.parentNode.insertBefore(form, oldForm.nextElementSibling);
}

function validateFuel() {
    const pNum = Number(pLitre);
    const dNum = Number(dLitre);
    const rateNum = Number(fuelRate);
    let refillnum;

    if (refueled)
        refillnum = Number(refilledLitreInput.innerHTML.value)
    else
        refillnum = 0;

    if (!pNum || isNaN(pNum) || pNum < 0) {
        refueled = false;
        mssg.innerHTML = "Enter a valid number for pickup fuel";
        mssg.style.backgroundColor = "red";
        document.body.appendChild(mssg);

        setTimeout(() => {
            mssg.remove();
        }, 2000);
        return false;
    }
    if (!dNum || isNaN(dNum) || dNum < 0) {
        refueled = false;
        mssg.innerHTML = "Enter a valid number for dropoff fuel";
        mssg.style.backgroundColor = "red";
        document.body.appendChild(mssg);

        setTimeout(() => {
            mssg.remove();
        }, 2000);
        return false;
    }
    if ((pNum != dNum || (refilledLitreInput && refilledLitreInput.value.trim() !== "")) && (isNaN(rateNum) || rateNum <= 0)) {
        refueled = false;
        mssg.innerHTML = "Enter a valid number for fuel rate";
        mssg.style.backgroundColor = "red";
        document.body.appendChild(mssg);

        setTimeout(() => {
            mssg.remove();
        }, 2000);
        return false;
    }
    if (pNum < dNum && (!refilledLitreInput || refillnum <= 0)) {
        refueled = false;
        mssg.innerHTML = "Enter a valid refill amount";
        mssg.style.backgroundColor = "red";
        document.body.appendChild(mssg);

        setTimeout(() => {
            mssg.remove();
        }, 2000);
        return false;
    }
    if (refillnum > 0 && rateNum <= 0) {
        refueled = false;
        mssg.innerHTML = "Enter a valid fuel rate as customer has refilled fuel";
        mssg.style.backgroundColor = "red";
        document.body.appendChild(mssg);

        setTimeout(() => {
            mssg.remove();
        }, 2000);
        return false;
    }
    return true;
}