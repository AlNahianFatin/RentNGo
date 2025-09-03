let form = document.getElementById("bookingForm");
let errorMessage = document.getElementById("errorMessage");
let priceDisplay = document.getElementById("priceEstimate");

function updatePrice() {
  let vehicle = document.getElementById("vehicleType").value;
  let start = document.getElementById("pickupDate").value;
  let end = document.getElementById("returnDate").value;

  let price = Pricing.calculate(start, end, vehicle);

  if (price !== null) {
    priceDisplay.textContent = `Estimated Price: $${price.toFixed(2)}`;
  } else {
    priceDisplay.textContent = "";
  }
}

["vehicleType", "pickupDate", "returnDate"].forEach(id => {
  document.getElementById(id).addEventListener("change", updatePrice);
});

form.addEventListener("submit", function (e) {
  e.preventDefault();
  errorMessage.textContent = "";

  let pickupDate = new Date(form.pickupDate.value + "T" + form.pickupTime.value);
  let returnDate = new Date(form.returnDate.value + "T" + form.returnTime.value);
  let now = new Date();

  if (isNaN(pickupDate) || isNaN(returnDate)) {
    errorMessage.textContent = "Please fill in all date and time fields.";
    return;
  }
  if (pickupDate < now) {
    errorMessage.textContent = "Pickup date/time cannot be in the past.";
    return;
  }
  if (returnDate <= pickupDate) {
    errorMessage.textContent = "Return date/time must be after pickup.";
    return;
  }

  form.reset();
  priceDisplay.textContent = "";
  window.location.href = "PricingCalculatorM.html";
});
