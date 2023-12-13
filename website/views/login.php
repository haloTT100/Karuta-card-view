<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/x-icon" href="./favicon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Registration</title>
  <link href="./css/ezamastilus.css" rel="stylesheet">
</head>
<body>

<main class="container p-4">
  <div class="form-container">
    <h2 class="mb-4 text-center">Login</h2>
    <?php
include "database.php";

if(isset($_POST['logForm'])){
    $conn = new kapcsolat();
    $res = $conn->loginUser($_REQUEST['email'], $_REQUEST['password']);
    if($res == "Login successful!")
        echo '<p class="alert alert-success">';
    else
        echo '<p class="alert alert-danger">';

    echo $res;
    echo '</p>';
    sleep(2);
    header('Location: /');
}

?>
    <form id="loginForm" method="POST">
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <div class="mb-3"><a href="/register">New here? Create an account!</a></div>
      <button type="submit" class="btn btn-light" name="logForm">Login</button>
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


</script>

</body>
</html>
