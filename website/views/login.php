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
    <h2 class="mb-4 text-center">Login</h2>
    <form id="registrationForm">
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-light">Login</button>
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
