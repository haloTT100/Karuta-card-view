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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <title>ne néz ide</title>
  </head>
  <body>
    <main class="px-3">
    <div class="text-center">
      <a class="btn btn-light m-3" href="/upload">Upload</a>
      <a class="btn btn-danger m-3" href="/logout">Logout</a>
    </div>
    <div class="row text-center m-0 w-100 border border-info p-1">
      <div class="col-4 m-0">
        <h6>Waiting for a bot: <span id="waitngCards">2031 card</span></h6>
      </div>
      <div class="col-4 row m-0">
        <div class="col-12">
          <h6>Downloading: <span id="downCards">100 card</span></h6>
        </div> 
        <div class="col-12">
          <h6>Download time: <span id="downloadTime">1h 12m 32s</span></h6>
        </div>
      </div>
      <div class="col-4 m-0">
        <h6>Done: <span id="doneCards">35 card</span></h6>
      </div>
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

    <div class="row cards p-2 m-0" id="load_data">
        
        
        

              


    </div>
    </main>
    <script>

var limit = 20; //The number of records to display per request
 var start = 0; //The starting pointer of the data
 var action = 'inactive'; //Check if current action is going on or not. If not then inactive otherwise active
 load_country_data(limit, start);
 function load_country_data(limit, start)
 {
  $.ajax({
   url:"/getCards",
   method:"POST",
   data:{limit:limit, start:start},
   cache:false,
   success:function(data)
   {

    $('#load_data').append(data);
    
   }
  });
 }


      $(window).scroll(function(){
        if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
        {
        action = 'active';
        start = start + limit;
        setTimeout(function(){
          load_country_data(limit, start);
        }, 1000);
        }
      });
    </script>
    <script>
      updateStatus();

      function updateStatus(){
        $.post("/getCardsStatus",
        {
        },
        function(data, status){
          
          document.getElementById("waitngCards").textContent = data['w'] + " card";
          document.getElementById("doneCards").textContent = data['d'] + " card";
          document.getElementById("downloadTime").textContent = data['ETA'];
        });
      }

      let intervalId = setInterval(updateStatus, 2000);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
