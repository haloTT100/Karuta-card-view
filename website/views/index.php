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
    <link href="./css/ezamastilus.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>ne néz ide</title>
  </head>
  <body>
    <div class="text-center">
      <a class="btn btn-light m-3" href="/upload">Upload</a>
      <a class="btn btn-danger m-3" href="/logout">Logout</a>
    </div>
    <div>
      <h6>All card: </h6><h6 id="waitStatus">0</h6>
      <h6>Done: </h6><h6 id="doneStatus">0</h6>
    </div>
    <?php
      if(isset($GET['uploadSuccess'])){
        echo '<p class="alert alert-success">';
        echo 'Upload successful!';
        echo '</p>';
        sleep(2);
        header('Location: /');
      }
    ?>
    <div class="cards row text-center m-0 p-0">
        <?php
        include "database.php";
        $conn = new kapcsolat();
        $res = $conn->getLinks();
        foreach($res as $link){
            print('<div class="col-4 p-3 px-5"><div class="c">');
            print('<img src="'.$link['link'].'">');
            print('</div></div>');

          }
        ?>
        
        
    </div>
    <script>
      updateStatus();

      function updateStatus(){
        $.post("/getCardsStatus",
        {
        },
        function(data, status){
          
          document.getElementById("waitStatus").innerHTML = data['w'];
          document.getElementById("doneStatus").innerHTML = data['d'];
        });
      }

      let intervalId = setInterval(updateStatus, 2000);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
