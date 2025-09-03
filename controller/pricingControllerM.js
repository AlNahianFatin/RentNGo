let form = document.getElementById("pricingForm");
let errorMessage = document.getElementById("errorMessage");

// 🔹 Live price update
function updatePrice() {
  let vehicle = document.getElementById("vehicleType").value;
  let start = document.getElementById("startDate").value;
  let end = document.getElementById("endDate").value;

  let price = Pricing.calculate(start, end, vehicle);

  if (price !== null) {
    errorMessage.textContent = `💲 Estimated Price: $${price.toFixed(2)}`;
  } else {
    errorMessage.textContent = "";
  }
}

// Trigger price calculation when fields change
["vehicleType", "startDate", "endDate"].forEach(id => {
  document.getElementById(id).addEventListener("change", updatePrice);
});


form.addEventListener("submit", function (e) {
  e.preventDefault();
  errorMessage.textContent = "";

  let validationError = Pricing.validate(
    document.getElementById("startDate").value,
    document.getElementById("endDate").value,
    document.getElementById("vehicleType").value
  );

  if (validationError) {
    errorMessage.textContent = validationError;
    return;
  }

  form.reset();
  window.location.href = "DamageReportsM.html";
});
