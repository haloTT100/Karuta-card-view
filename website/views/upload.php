<!doctype html>
<?php
session_start();
if(!isset($_SESSION['username'])) header('Location: /login');

?>
<html lang="hu">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="./favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="./css/ezamastilus.css" rel="stylesheet">
    <title>ne néz ide</title>
  </head>
  <body>
    <div class="p-3 mb-3 form-container-big">
      <form action="./process" method="POST" enctype="multipart/form-data">
          <input class="form-control mb-3" type="file" name="file" id="file" accept=".csv">
          <input onclick="msg();" class="form-control mb-3" type="submit" name="upload" value="Upload">
          
      </form>
    </div>
    <script>
      function msg(){
        var msgElement = document.getElementById("msgID");
        msgElement.innerHTML = "<p id='msgID' class='alert alert-primary'>Uploading...</p>";
      }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>