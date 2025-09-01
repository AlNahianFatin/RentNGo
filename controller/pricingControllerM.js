let form = document.getElementById("pricingForm");
let errorMessage = document.getElementById("errorMessage");

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
