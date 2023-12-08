<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Registration</title>
  <link href="./css/ezamastilus.css" rel="stylesheet">
</head>
<body>

<main class="container p-4">
  <div class="form-container">
    <h2 class="mb-4 text-center">Registration</h2>
    <form id="registrationForm" method="POST">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="mb-3">
        <label for="password1" class="form-label">Password</label>
        <input type="password" class="form-control" id="password1" name="password1" required>
      </div>
      <div class="mb-3">
        <label for="password2" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="password2" name="password2" required>
      </div>
      <input type="submit" id="regForm" name="regForm" class="btn btn-light">
    </form>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Floating label effect
  document.addEventListener('DOMContentLoaded', function () {
    const floatingInputs = document.querySelectorAll('.form-control');

    floatingInputs.forEach((input) => {
      input.addEventListener('focus', function () {
        this.parentElement.classList.add('focused');
      });

      input.addEventListener('blur', function () {
        if (this.value === '') {
          this.parentElement.classList.remove('focused');
        }
      });
    });
  });

  // Form validation
  document.getElementById('registrationForm').addEventListener('submit', function (event) {
    const password1 = document.getElementById('password1').value;
    const password2 = document.getElementById('password2').value;

    if (password1 !== password2) {
      alert('Passwords do not match!');
      event.preventDefault();
    }
  });
</script>

</body>
</html>

<?php
include "database.php";

if(isset($_POST['regForm'])){
    $conn = new kapcsolat();
    $conn->registerUser($_REQUEST['username'], $_REQUEST['password1'], $_REQUEST['password2'], $_REQUEST['email']);
}

?>