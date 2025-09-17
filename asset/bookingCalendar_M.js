let form = document.getElementById("bookingForm");
let errorMessage = document.getElementById("errorMessage");

form.addEventListener("submit", function (e) {
  errorMessage.textContent = "";

  let validationError = Booking.validate(
    form.pickupDate.value,
    form.pickupTime.value,
    form.returnDate.value,
    form.returnTime.value
  );

  if (validationError) {
    e.preventDefault();
    errorMessage.textContent = validationError;
  }
});
