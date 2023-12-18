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
        <form class="text-center w-100 border border-info p-3 mb-2">
            <div class="row m-0 my-2">
                <div class="col-6 row m-0">
                    <div class="col-3 p-1 text-end"><label for="char_name" class="form-label">Character name:</label></div>
                    <div class="col-6"><input type="text" class="form-control" name="char_name" id="char_name" placeholder=""></div>
                    <div class="col-3">
                        <select class="form-select" aria-label="char_name_select" name="char_name_order">
                            <option value="x" selected>X</option>
                            <option value="u">ABC</option>
                            <option value="d">CBA</option>
                        </select>
                    </div>  
                </div>
                <div class="col-6 row m-0">
                    <div class="col-3 p-1 text-end"><label for="series" class="form-label ">Series:</label></div>
                    <div class="col-6"><input type="text" class="form-control" name="series" id="series" placeholder=""></div>
                    <div class="col-3">
                        <select class="form-select" aria-label="series_select" name="series_order">
                            <option value="x" selected>X</option>
                            <option value="u">ABC</option>
                            <option value="d">CBA</option>
                        </select>
                    </div>  
                </div>

            </div>
            <div class="row m-0 mb-2">
                <div class="col-6 row m-0">
                    <div class="col-3 p-1 text-end"><label for="number" class="form-label">Number:</label></div>
                    <div class="col-6 row m-0">
                        <div class="col-3 p-1"><input type="number" class="form-range" min="0" max="500" step="1" id="number" value="0" name="number"></div>
                        <div class="col-9 p-0 ">
                            <input type="range" class="form-range" min="0" max="500" step="1" id="number_range">
                        </div>
                        <div class="col-3"></div>
                        <div class="col-4 p-0 text-start"><label class="form-label" id="number_min">Min: 0</label></div>
                        <div class="col-5 p-0 text-end"><label class="form-label" id="number_max">Max: 500</label></div>
                        
                    </div>
                    <div class="col-3">
                        <select class="form-select" aria-label="number select" name="number_order">
                            <option value="x" selected>X</option>
                            <option value="u">123</option>
                            <option value="d">321</option>
                        </select>
                    </div>  
                </div>
                <div class="col-6 row m-0">
                    <div class="col-3 p-1 text-end"><label for="edition" class="form-label">Edition:</label></div>
                    <div class="col-6 row m-0">
                        <div class="col-3 p-1"><input type="number" class="form-range" min="1" max="6" step="1" id="edition" value="1" name="edition"></div>
                        <div class="col-9 p-0 ">
                            <input type="range" class="form-range" min="1" max="6" step="1" id="edition_range">
                        </div>
                        <div class="col-3"></div>
                        <div class="col-4 p-0 text-start"><label class="form-label" id="edition_min">Min: 0</label></div>
                        <div class="col-5 p-0 text-end"><label class="form-label" id="edition_max">Max: 500</label></div>
                        
                    </div>
                    <div class="col-3">
                        <select class="form-select" aria-label="edition_select" name="edition_order">
                            <option value="x" selected>X</option>
                            <option value="u">123</option>
                            <option value="d">321</option>
                        </select>
                    </div>  
                </div>

            </div>
            <div class="row m-0 mb-2">
                <div class="col-6 row m-0">
                    <div class="col-3 p-1 text-end"><label for="wishlist" class="form-label">Wishlist:</label></div>
                    <div class="col-6 row m-0">
                        <div class="col-3 p-1"><input type="number" class="form-range" min="0" max="500" step="1" id="wishlist" value="0" name="wishlist"></div>
                        <div class="col-9 p-0 ">
                            <input type="range" class="form-range" min="0" max="500" step="1" id="wishlist_range">
                        </div>
                        <div class="col-3"></div>
                        <div class="col-4 p-0 text-start"><label class="form-label" id="wishlist_min">Min: 0</label></div>
                        <div class="col-5 p-0 text-end"><label class="form-label" id="wishlist_max">Max: 500</label></div>
                        
                    </div>
                    <div class="col-3">
                        <select class="form-select" aria-label="wishlist select" name="wishlist_order">
                            <option value="x" selected>X</option>
                            <option value="u">123</option>
                            <option value="d">321</option>
                        </select>
                    </div>  
                </div>
                <div class="col-6 row m-0">
                    <div class="col-3 p-1 text-end"><label for="quality" class="form-label">Quality:</label></div>
                    <div class="col-6 row m-0">
                        <div class="col-3 p-1"><input type="number" class="form-range" min="1" max="6" step="1" id="quality" value="1" name="quality"></div>
                        <div class="col-9 p-0 ">
                            <input type="range" class="form-range" min="1" max="6" step="1" id="quality_range">
                        </div>
                        <div class="col-3"></div>
                        <div class="col-4 p-0 text-start"><label class="form-label" id="quality_min">Min: 0</label></div>
                        <div class="col-5 p-0 text-end"><label class="form-label" id="quality_max">Max: 500</label></div>
                        
                    </div>
                    <div class="col-3">
                        <select class="form-select" aria-label="quality_select" name="quality_order">
                            <option value="x" selected>X</option>
                            <option value="u">123</option>
                            <option value="d">321</option>
                        </select>
                    </div>  
                </div>

            </div>
            <div class="row m-0">
                <div class="col-6 row m-0">
                    <div class="col-3 p-1 text-end"><label for="effort" class="form-label">Effort:</label></div>
                    <div class="col-6 row m-0">
                        <div class="col-3 p-1"><input type="number" class="form-range" min="0" max="250" step="1" id="effort" value="0" name="effort"></div>
                        <div class="col-9 p-0 ">
                            <input type="range" class="form-range" min="0" max="500" step="1" id="effort_range">
                        </div>
                        <div class="col-3"></div>
                        <div class="col-4 p-0 text-start"><label class="form-label" id="effort_min">Min: 0</label></div>
                        <div class="col-5 p-0 text-end"><label class="form-label" id="effort_max">Max: 500</label></div>
                        
                    </div>
                    <div class="col-3">
                        <select class="form-select" aria-label="effort select" name="effort_order">
                            <option value="x" selected>X</option>
                            <option value="u">123</option>
                            <option value="d">321</option>
                        </select>
                    </div>  
                </div>
                <div class="col-6 row m-0">
                    <div class="col-3 p-1 text-end"><label for="frame" class="form-label">Frame:</label></div>
                    <div class="col-6 text-start mt-1">
                        <input class="form-check-input" type="checkbox" value="" name="frame" id="frame" checked>            
                    </div>
                </div>

            </div>
        </form>
        <script src="./js/filter.js"></script>
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

var limit = 100; //The number of records to display per request
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
