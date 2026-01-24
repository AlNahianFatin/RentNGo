function logout() {
   var logoutBtn = document.getElementById('logoutBtn');
   var confirmBox = document.getElementById('confirmBox');
   var okBtn = document.getElementById('okBtn');
   var cnclBtn = document.getElementById('cnclBtn');

   logoutBtn.addEventListener("click", function () {
      confirmBox.style.display = 'block';
   });

   okBtn.addEventListener("click", function () {
      window.location.href = '../view/homePage_N.html';
   });

   cnclBtn.addEventListener("click", function () {
      confirmBox.style.display = 'none';
   });
}

function editProfile(){
  var edit = document.getElementById('edit');
   var editBox = document.getElementById('editBox');
   var editokBtn = document.getElementById('editokBtn');
   var editcnclBtn = document.getElementById('editcnclBtn');
   
   edit.addEventListener("click", function () {
      editBox.style.display = 'block';
   });

   editokBtn.addEventListener("click", function () {
      window.location.href = '../view/CustomerProfileUpdate_N.html';
   });

   editcnclBtn.addEventListener("click", function () {
      editBox.style.display = 'none';
   });
}

function inventoryLogout() { 
   var lgoutBtn = document.getElementById('lgoutBtn');
   var confirmBox = document.getElementById('confirmBox');
   var okBtn = document.getElementById('okBtn');
   var cnclBtn = document.getElementById('cnclBtn');

   lgoutBtn.addEventListener("click", function () {
      confirmBox.style.display = 'block';
   });

   okBtn.addEventListener("click", function () {
      window.location.href = '../view/homePage_N.html';
   });

   cnclBtn.addEventListener("click", function () {
      confirmBox.style.display = 'none';
   });}
