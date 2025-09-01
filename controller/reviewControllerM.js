let form = document.getElementById("reviewForm");

form.addEventListener("submit", function(e) {
  e.preventDefault();

  document.getElementById("nameError").textContent = "";
  document.getElementById("ratingError").textContent = "";
  document.getElementById("commentError").textContent = "";

  let name = document.getElementById("name").value.trim();
  let rating = document.getElementById("rating").value;
  let comment = document.getElementById("comment").value.trim();

  let validationError = Review.validate(name, rating, comment);

  if (validationError) {
    if (validationError.includes("Name")) {
      document.getElementById("nameError").textContent = validationError;
    } else if (validationError.includes("rating")) {
      document.getElementById("ratingError").textContent = validationError;
    } else {
      document.getElementById("commentError").textContent = validationError;
    }
    return;
  }

  form.reset();
});
