<?php
// show error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);
 
// home page url
//$home_url="http://localhost/api/";
//$home_url="http://app.e-strix.local:81/api/lotto/";
$home_url="http://www.e-strix.pl/zakupy/";
 
// page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;
 
// set number of records per page
$records_per_page = 50;
 
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;
?>