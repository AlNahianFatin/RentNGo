document.addEventListener('DOMContentLoaded', function () {
   var logoutBtn = document.getElementById('logoutBtn');
   var confirmBox = document.getElementById('confirmBox');
   var okBtn = document.getElementById('okBtn');
   var cnclBtn = document.getElementById('cnclBtn');
   var editBtn = document.getElementById('edit');

   logoutBtn.addEventListener("click", function () {
      confirmBox.style.display = 'block';
   });

   okBtn.addEventListener("click", function () {
      window.location.href = '../view/homePage_N.html';
   });

   cnclBtn.addEventListener("click", function () {
      confirmBox.style.display = 'none';
   });

   editBtn.addEventListener("click", function () {
      window.location.href = '../view/edit_N.html';
   });

});
