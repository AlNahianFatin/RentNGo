let form = document.getElementById("pricingForm");
let errorMessage = document.getElementById("errorMessage");

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

["vehicleType", "startDate", "endDate"].forEach(id => {
  document.getElementById(id).addEventListener("change", updatePrice);
});

form.addEventListener("submit", function (e) {
  errorMessage.textContent = "";

  let validationError = Pricing.validate(
    form.startDate.value,
    form.endDate.value,
    form.vehicleType.value,
    form.promoCode.value.trim()
  );

  if (validationError) {
    e.preventDefault();
    errorMessage.textContent = validationError;
  }
});
