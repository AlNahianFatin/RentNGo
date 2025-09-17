let form = document.getElementById("damageForm");
let errorMessage = document.getElementById("errorMessage");

document.getElementById("damagePhoto").addEventListener("change", function () {
  let preview = document.getElementById("photoPreview");
  preview.style.display = this.files.length ? "block" : "none";
  if (this.files[0]) preview.src = URL.createObjectURL(this.files[0]);
});

document
  .getElementById("signaturePhoto")
  .addEventListener("change", function () {
    let preview = document.getElementById("signaturePreview");
    preview.style.display = this.files.length ? "block" : "none";
    if (this.files[0]) preview.src = URL.createObjectURL(this.files[0]);
  });

form.addEventListener("submit", function (e) {
  errorMessage.textContent = "";

  let vehicleId = form.vehicleId.value.trim();
  let damageType = form.damageType.value;
  let photoCount = form.damagePhoto.files.length;
  let signature = form.signature.value.trim();

  if (!vehicleId || !signature) {
    e.preventDefault();
    errorMessage.textContent = "Vehicle ID and Signature are required.";
  } else if (!damageType && photoCount === 0) {
    e.preventDefault();
    errorMessage.textContent = "Provide damage type or upload a photo.";
  }
});
