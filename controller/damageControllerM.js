let form = document.getElementById("damageForm");
let errorMessage = document.getElementById("errorMessage");

// Preview Damage Photo
document.getElementById("damagePhoto").addEventListener("change", function () {
  let preview = document.getElementById("photoPreview");
  if (this.files && this.files[0]) {
    preview.style.display = "block";
    preview.src = URL.createObjectURL(this.files[0]);
  } else {
    preview.style.display = "none";
  }
});

// Preview Signature Photo
document.getElementById("signaturePhoto").addEventListener("change", function () {
  let preview = document.getElementById("signaturePreview");
  if (this.files && this.files[0]) {
    preview.style.display = "block";
    preview.src = URL.createObjectURL(this.files[0]);
  } else {
    preview.style.display = "none";
  }
});

// Validation on submit
form.addEventListener("submit", function (e) {
  e.preventDefault();
  errorMessage.textContent = "";

  let validationError = Damage.validate(
    document.getElementById("vehicleId").value.trim(),
    document.getElementById("damageType").value,
    document.getElementById("damagePhoto").files.length,
    document.getElementById("signature").value.trim()
  );

  if (validationError) {
    errorMessage.textContent = validationError;
    return;
  }

  form.reset();
  document.getElementById("photoPreview").style.display = "none";
  document.getElementById("signaturePreview").style.display = "none";

  window.location.href = "InsuranceOptionsM.html";
});
