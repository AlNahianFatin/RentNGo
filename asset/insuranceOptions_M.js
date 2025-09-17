let form = document.getElementById("insuranceForm");
let errorMessage = document.getElementById("errorMessage");

form.addEventListener("submit", function (e) {
  errorMessage.textContent = "";

  let validationError = Insurance.validate(
    form.coverageTier.value,
    form.deductible.value,
    form.claimScenario.value.trim()
  );

  if (validationError) {
    e.preventDefault();
    errorMessage.textContent = validationError;
  }
});
