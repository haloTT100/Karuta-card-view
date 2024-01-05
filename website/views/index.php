<!doctype html>
<?php
  session_start();
  if(!isset($_SESSION['username'])) header('Location: /login');
  include "database.php";
  $conn = new kapcsolat();
  $minMaxArray = $conn->getUserMinMax();
 if(count($minMaxArray) == 0){
  for($i = 0; $i < 5; $i++){
    array_push($minMaxArray, 1);
    array_push($minMaxArray, 0);
  }
 }



  $char_name = "";
  $series = "";

  $numberMin = $minMaxArray[1];
  $numberMax = $minMaxArray[0];


  $editionMin = $minMaxArray[3];
  $editionMax = $minMaxArray[2];

  
  $wishlistMin = $minMaxArray[5];
  $wishlistMax = $minMaxArray[4];

  
  $qualityMin = $minMaxArray[7];
  $qualityMax = $minMaxArray[6];

  
  $effortMin = $minMaxArray[9];
  $effortMax = $minMaxArray[8];

  $numberOrder = 'x';
  $editionOrder = 'x';
  $wishlistOrder = 'x';
  $qualityOrder = 'x';
  $effortOrder = 'x';
  $charNameOrder = 'x';
  $seriesOrder = 'x';

  $frame = '';

if(isset($_POST['filter'])){
  $char_name = $_POST['char_name'];
  $series = $_POST['series'];

  $numberMin = $_POST['number_min'];
  $numberMax = $_POST['number_max'];

  $editionMin = $_POST['edition_min'];
  $editionMax = $_POST['edition_max'];

  $wishlistMin =  $_POST['wishlist_min'];
  $wishlistMax = $_POST['wishlist_max'];

  $qualityMin = $_POST['quality_min'];
  $qualityMax = $_POST['quality_max'];

  $effortMin = $_POST['effort_min'];
  $effortMax = $_POST['effort_max'];

  $frame = isset($_POST['frame']) ? 'checked' : '';

  $numberOrder = $_POST['number_order'];
  $editionOrder = $_POST['edition_order'];
  $wishlistOrder = $_POST['wishlist_order'];
  $qualityOrder = $_POST['quality_order'];
  $effortOrder = $_POST['effort_order'];
  $charNameOrder = $_POST['char_name_order'];
  $seriesOrder = $_POST['series_order'];
}

if(isset($_POST['clear'])){
  $_POST = array();
}

  
?>
<html lang="hu">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="./favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="./css/ezamastilus.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/3e43b66dcd.js" crossorigin="anonymous"></script>
    <title>Karuta card viewer</title>
  </head>
  <body>
    <main class="px-3">
    <div class="text-center">
      <a class="btn btn-light m-3" href="/upload">Upload</a>
      <a class="btn btn-danger m-3" href="/logout">Logout</a>
    </div>
    <form class="text-center w-100 border border-info p-3 mb-2 collapse" id="filter" method="POST" action="/">
            <div class="row m-0 mb-2">
                <div class="col-6 row m-0">
                    <div class="col-3 p-1 text-end"><label for="char_name" class="form-label">Character name:</label></div>
                    <div class="col-7"><?php echo '<input type="text" class="form-control" name="char_name" id="char_name" placeholder="" value="'.$char_name.'">';?></div>
                    <datalist id="char_name"> 
                      <?php
                       $cards = $conn->getAllCardsByUserID();
                       foreach($cards as $card){
                        echo '<option value="'.$card["char_name"].'">'.$card["char_name"].'</option>';
                       }
                       
                      ?>
                    </datalist> 
                    <div class="col-2">
                        <select class="form-select" aria-label="char_name_select" name="char_name_order">
                            <option value="x" <?php echo $charNameOrder == 'x' ? 'selected':''; ?>>No filter</option>
                            <option value="u" <?php echo $charNameOrder == 'u' ? 'selected':''; ?>>Ascending</option>
                            <option value="d" <?php echo $charNameOrder == 'd' ? 'selected':''; ?>>Descending</option>
                        </select>
                    </div>  
                </div>
                <div class="col-6 row m-0">
                    <div class="col-3 p-1 text-end"><label for="series" class="form-label ">Series:</label></div>
                    <div class="col-7"><?php echo '<input type="text" class="form-control" name="series" id="series" placeholder="" value="'.$series.'">';?></div>
                    <datalist id="series"> 
                    <?php
                       $cards = $conn->getAllCardsByUserID();
                       foreach($cards as $card){
                        echo '<option value="'.$card["series"].'">'.$card["series"].'</option>';
                       }
                       unset($cards);
                       
                      ?>
                    </datalist> 
                    <div class="col-2">
                        <select class="form-select" aria-label="series_select" name="series_order">
                            <option value="x" <?php echo $seriesOrder == 'x' ? 'selected':''; ?>>No filter</option>
                            <option value="u" <?php echo $seriesOrder == 'u' ? 'selected':''; ?>>Ascending</option>
                            <option value="d" <?php echo $seriesOrder == 'd' ? 'selected':''; ?>>Descending</option>
                        </select>
                    </div>  
                </div>
            </div>
            <div class="row m-0 mb-2">
                <div class="col-6 row m-0">
                    <div class="col-3 p-1 text-end"><label class="form-label">Number:</label></div>
                    <div class="col-7 row m-0">
                        <div class="col-2"><label class="form-label">Min:</label></div>
                        <div class="col-3 p-1"><?php echo'<input type="number" class="form-range" min="'.$minMaxArray[1].'" max="'.$minMaxArray[0].'" step="1" id="number_min" value="'.$numberMin.'" name="number_min">';?></div>
                        <div class="col-7 p-0 ">
                            <input type="range" class="form-range" min="0" max="500" step="1" id="number_min_range">
                        </div>
                        <div class="col-2"><label class="form-label">Max:</label></div>
                        <div class="col-3 p-1"><?php echo'<input type="number" class="form-range" min="'.$minMaxArray[1].'" max="'.$minMaxArray[0].'" step="1" id="number_max" value="'.$numberMax.'" name="number_max">';?></div>
                        <div class="col-7 p-0 ">
                            <input type="range" class="form-range" min="0" max="500" step="1" id="number_max_range">
                        </div>
                    </div>
                    <div class="col-2">
                        <select class="form-select" aria-label="number select" name="number_order">
                            <option value="x" <?php echo $numberOrder == 'x' ? 'selected':''; ?>>No filter</option>
                            <option value="u" <?php echo $numberOrder == 'u' ? 'selected':''; ?>>Ascending</option>
                            <option value="d" <?php echo $numberOrder == 'd' ? 'selected':''; ?>>Descending</option>
                        </select>
                    </div>  
                </div>
                <div class="col-6 row m-0">
                    <div class="col-3 p-1 text-end"><labelclass="form-label">Edition:</labelclass=></div>
                    <div class="col-7 row m-0">
                        <div class="col-2"><label class="form-label">Min:</label></div>
                        <div class="col-3 p-1"><?php echo '<input type="number" class="form-range" min="'.$minMaxArray[3].'" max="'.$minMaxArray[2].'" step="1" id="edition_min" value="'.$editionMin.'" name="edition_min">';?></div>
                        <div class="col-7 p-0 ">
                            <input type="range" class="form-range" min="0" max="500" step="1" id="edition_min_range">
                        </div>
                        <div class="col-2"><label class="form-label">Max:</label></div>
                        <div class="col-3 p-1"><?php echo '<input type="number" class="form-range" min="'.$minMaxArray[3].'" max="'.$minMaxArray[2].'" step="1" id="edition_max" value="'.$editionMax.'" name="edition_max">';?></div>
                        <div class="col-7 p-0 ">
                            <input type="range" class="form-range" min="0" max="500" step="1" id="edition_max_range">
                        </div>
                        
                    </div>
                    <div class="col-2">
                        <select class="form-select" aria-label="edition_select" name="edition_order">
                            <option value="x" <?php echo $editionOrder == 'x' ? 'selected':''; ?>>No filter</option>
                            <option value="u" <?php echo $editionOrder == 'u' ? 'selected':''; ?>>Ascending</option>
                            <option value="d" <?php echo $editionOrder == 'd' ? 'selected':''; ?>>Descending</option>
                        </select>
                    </div>  
                </div>
            </div>
            <div class="row m-0 mb-2">
                <div class="col-6 row m-0">
                    <div class="col-3 p-1 text-end"><label class="form-label">Wishlist:</label></div>
                    <div class="col-7 row m-0">
                        <div class="col-2"><label class="form-label">Min:</label></div>
                        <div class="col-3 p-1"><?php echo '<input type="number" class="form-range" min="'.$minMaxArray[5].'" max="'.$minMaxArray[4].'" step="1" id="wishlist_min" value="'.$wishlistMin.'" name="wishlist_min">';?></div>
                        <div class="col-7 p-0 ">
                            <input type="range" class="form-range" min="0" max="500" step="1" id="wishlist_min_range">
                        </div>
                        <div class="col-2"><label class="form-label">Max:</label></div>
                        <div class="col-3 p-1"><?php echo '<input type="number" class="form-range" min="'.$minMaxArray[5].'" max="'.$minMaxArray[4].'" step="1" id="wishlist_max" value="'.$wishlistMax.'" name="wishlist_max">';?></div>
                        <div class="col-7 p-0 ">
                            <input type="range" class="form-range" min="0" max="500" step="1" id="wishlist_max_range">
                        </div>
                    </div>
                    <div class="col-2">
                        <select class="form-select" aria-label="wishlist select" name="wishlist_order">
                        <option value="x" <?php echo $wishlistOrder == 'x' ? 'selected':''; ?>>No filter</option>
                            <option value="u" <?php echo $wishlistOrder == 'u' ? 'selected':''; ?>>Ascending</option>
                            <option value="d" <?php echo $wishlistOrder == 'd' ? 'selected':''; ?>>Descending</option>
                        </select>
                    </div>  
                </div>
                <div class="col-6 row m-0">
                    <div class="col-3 p-1 text-end"><label class="form-label">Quality:</label></div>
                    <div class="col-7 row m-0">
                        <div class="col-2"><label class="form-label">Min:</label></div>
                        <div class="col-3 p-1"><?php echo '<input type="number" class="form-range" min="'.$minMaxArray[7].'" max="'.$minMaxArray[6].'" step="1" id="quality_min" value="'.$qualityMin.'" name="quality_min">';?></div>
                        <div class="col-7 p-0 ">
                            <input type="range" class="form-range" min="0" max="500" step="1" id="quality_min_range">
                        </div>
                        <div class="col-2"><label class="form-label">Max:</label></div>
                        <div class="col-3 p-1"><?php echo '<input type="number" class="form-range" min="'.$minMaxArray[7].'" max="'.$minMaxArray[6].'" step="1" id="quality_max" value="'.$qualityMax.'" name="quality_max">';?></div>
                        <div class="col-7 p-0 ">
                            <input type="range" class="form-range" min="0" max="500" step="1" id="quality_max_range">
                        </div>
                    </div>
                    <div class="col-2">
                        <select class="form-select" aria-label="quality_select" name="quality_order">
                        <option value="x" <?php echo $qualityOrder == 'x' ? 'selected':''; ?>>No filter</option>
                            <option value="u" <?php echo $qualityOrder == 'u' ? 'selected':''; ?>>Ascending</option>
                            <option value="d" <?php echo $qualityOrder == 'd' ? 'selected':''; ?>>Descending</option>
                        </select>
                    </div>  
                </div>
            </div>
            <div class="row m-0">
                <div class="col-6 row m-0">
                    <div class="col-3 p-1 text-end"><label class="form-label">Effort:</label></div>
                    <div class="col-7 row m-0">
                        <div class="col-2"><label class="form-label">Min:</label></div>
                        <div class="col-3 p-1"><?php echo '<input type="number" class="form-range" min="'.$minMaxArray[9].'" max="'.$minMaxArray[8].'" step="1" id="effort_min" value="'.$effortMin.'" name="effort_min">';?></div>
                        <div class="col-7 p-0 ">
                            <input type="range" class="form-range" min="0" max="500" step="1" id="effort_min_range">
                        </div>
                        <div class="col-2"><label class="form-label">Max:</label></div>
                        <div class="col-3 p-1"><?php echo '<input type="number" class="form-range" min="'.$minMaxArray[9].'" max="'.$minMaxArray[8].'" step="1" id="effort_max" value="'.$effortMax.'" name="effort_max">';?></div>
                        <div class="col-7 p-0 ">
                            <input type="range" class="form-range" min="0" max="500" step="1" id="effort_max_range">
                        </div>
                    </div>
                    <div class="col-2">
                        <select class="form-select" aria-label="effort select" name="effort_order">
                        <option value="x" <?php echo $effortOrder == 'x' ? 'selected':''; ?>>No filter</option>
                            <option value="u" <?php echo $effortOrder == 'u' ? 'selected':''; ?>>Ascending</option>
                            <option value="d" <?php echo $effortOrder == 'd' ? 'selected':''; ?>>Descending</option>
                        </select>
                    </div>  
                </div>
                <div class="col-6 row m-0">
                    <div class="col-3 p-1 text-end"><label for="frame" class="form-label">Frame:</label></div>
                    <div class="col-6 text-start mt-1">
                        <input class="form-check-input" type="checkbox" name="frame" id="frame" <?php echo $frame; ?>>            
                    </div>
                </div>
            </div>
            <input type="submit" class="btn btn-light" value="Apply filter" name="filter">
            <input type="submit" class="btn btn-light" value="Clear" name="clear">
        </form>
        <div class="text-center mb-2">
          <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#filter" aria-expanded="false" aria-controls="filter">
          <i class="fa-solid fa-chevron-down bg-primary" style="color: #ffffff;"></i>
          </button>
        </div>
        <script src="./js/filter.js"></script>
    <div class="row text-center m-0 w-100 border border-info p-1 collapse" id="status_w">
      <div class="col-4 m-0">
        <h6>Waiting for a bot: <span id="waitngCards"></span></h6>
      </div>
      <div class="col-4 row m-0">
        <div class="col-12">
          <h6>Downloading: <span id="downCards"></span></h6>
        </div> 
        <div class="col-12">
          <h6>Download time: <span id="downloadTime"></span></h6>
        </div>
      </div>
      <div class="col-4 m-0">
        <h6>Done: <span id="doneCards"></span></h6>
      </div>
    </div>
    <div class="text-center mb-2">
          <button class="btn btn-primary mt-2" type="button" data-bs-toggle="collapse" data-bs-target="#status_w" aria-expanded="false" aria-controls="status_w">
          <i class="fa-solid fa-chevron-down bg-primary" style="color: #ffffff;"></i>
          </button>
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
        
        
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="copyToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
            <strong class="me-auto"></strong>
            <small>Now</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">
          You copied a code!
          </div>
        </div>
      </div>

              


    </div>
    </main>
    <script src="/js/vagobabaszo.js"></script>
    <script>

      var limit = 100; //The number of records to display per request
      var start = 0; //The starting pointer of the data
      var action = 'inactive'; //Check if current action is going on or not. If not then inactive otherwise active
      load_country_data(limit, start);
      function load_country_data(limit, start)
      {
        $.ajax({
        url:"/getCards",
        method:"POST",
        data:{limit:limit,
           start:start,
           char_name:'<?php echo $char_name;?>',
           series:'<?php echo $series;?>',
           numberMin:<?php echo $numberMin;?>,
           numberMax:<?php echo $numberMax;?>,
           editionMin:<?php echo $editionMin;?>,
           editionMax:<?php echo $editionMax;?>,
           wishlistMin:<?php echo $wishlistMin;?>,
           wishlistMax:<?php echo $wishlistMax;?>,
           qualityMin:<?php echo $qualityMin;?>,
           qualityMax:<?php echo $qualityMax;?>,
           effortMin:<?php echo $effortMin;?>,
           effortMax:<?php echo $effortMax;?>,
           frame:'<?php echo $frame;?>',
           numberOrder:'<?php echo $numberOrder;?>',
           editionOrder:'<?php echo $editionOrder;?>',
           wishlistOrder:'<?php echo $wishlistOrder;?>',
           qualityOrder:'<?php echo $qualityOrder;?>',
           effortOrder:'<?php echo $effortOrder;?>',
           charNameOrder:'<?php echo $charNameOrder;?>',
           seriesOrder:'<?php echo $seriesOrder;?>'
          },
        cache:false,
        success:function(data)
        {

          $('#load_data').append(data);
          action = 'inactive';
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

