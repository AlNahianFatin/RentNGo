document.getElementById("bookingForm").addEventListener("submit", function(e){
  e.preventDefault();
  const formData = new FormData(this);

  fetch("BookingCalendar_M.php", {
    method: "POST",
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      alert(data.message);
      window.location.href = data.next;
    } else {
      alert("❌ " + data.message);
    }
  })
  .catch(err => {
    console.error("Error:", err);
    alert("Something went wrong!");
  });
});
