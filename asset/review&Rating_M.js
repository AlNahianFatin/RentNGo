let form = document.getElementById("reviewForm");

form.addEventListener("submit", function(e) {
  document.getElementById("nameError").textContent = "";
  document.getElementById("ratingError").textContent = "";
  document.getElementById("commentError").textContent = "";

  let name = form.name.value.trim();
  let rating = form.rating.value;
  let comment = form.comment.value.trim();

  let validationError = Review.validate(name, rating, comment);

  if (validationError) {
    e.preventDefault(); 
    if (validationError.includes("Name")) {
      document.getElementById("nameError").textContent = validationError;
    } else if (validationError.includes("rating")) {
      document.getElementById("ratingError").textContent = validationError;
    } else {
      document.getElementById("commentError").textContent = validationError;
    }
  }
});
