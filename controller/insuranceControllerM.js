let form = document.getElementById("insuranceForm");
let errorMessage = document.getElementById("errorMessage");

form.addEventListener("submit", function (e) {
  e.preventDefault();
  errorMessage.textContent = "";

  let validationError = Insurance.validate(
    document.getElementById("coverageTier").value,
    document.getElementById("deductible").value,
    document.getElementById("claimScenario").value.trim()
  );

  if (validationError) {
    errorMessage.textContent = validationError;
    return;
  }

  form.reset();
  window.location.href = "Review&RatingM.html";
});
