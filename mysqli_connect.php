<?php
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', 'manchester2002');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'production_machines');
 
// $dbc will contain a resource link to the database
// @ keeps the error from showing in the browser
 
$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
OR die('Could not connect to MySQL: ' .
mysqli_connect_error());
?>