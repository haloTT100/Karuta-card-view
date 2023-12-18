<?php

require_once __DIR__.'/router.php';

// ##################################################
// ##################################################
// ##################################################

// Static GET
// In the URL -> http://localhost
// The output -> Index
get('/', 'views/index.php');
post('/', 'views/index.php');
get('/upload', 'views/upload.php');
get('/process', 'views/process.php');
post('/process', 'views/process.php');
get('/logout', 'views/logout.php');
get('/login', 'views/login.php');
post('/login', 'views/login.php');

get('/register', 'views/reg.php');
post('/register', 'views/reg.php');
post('/saveLink', 'views/saveLink.php');
post('/getEmptyLinks', 'views/getEmptyLinks.php');
post('/getCardsStatus', 'views//getCardsStatus.php');
post('/getCards', 'views//getCards.php');

// Dynamic GET. Example with 1 variable
// The $id will be available in user.php
//get('/user/$username', 'views/index.php');

// Dynamic GET. Example with 2 variables
// The $name will be available in full_name.php
// The $last_name will be available in full_name.php
// In the browser point to: localhost/user/X/Y
//get('/user/$name/$last_name', 'views/full_name.php');

// Dynamic GET. Example with 2 variables with static
// In the URL -> http://localhost/product/shoes/color/blue
// The $type will be available in product.php
// The $color will be available in product.php
//get('/product/$type/color/$color', 'product.php');

// A route with a callback
//get('/callback', function(){
//  echo 'Callback executed';
//});

// A route with a callback passing a variable
// To run this route, in the browser type:
// http://localhost/user/A
//get('/callback/$name', function($name){
//  echo "Callback executed. The name is $name";
//});

// Route where the query string happends right after a forward slash
//get('/product', '');

// A route with a callback passing 2 variables
// To run this route, in the browser type:
// http://localhost/callback/A/B
//get('/callback/$name/$last_name', function($name, $last_name){
//  echo "Callback executed. The full name is $name $last_name";
//});

// ##################################################
// ##################################################
// ##################################################
// Route that will use POST data
//post('/user', '/api/save_user');



// ##################################################
// ##################################################
// ##################################################
// any can be used for GETs or POSTs

// For GET or POST
// The 404.php which is inside the views folder will be called
// The 404.php has access to $_GET and $_POST
any('/404','views/404.php');
