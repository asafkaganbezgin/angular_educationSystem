<?php

/* angular works on port 4200, my sql works in a different port. Below two lines
   solves the issue.  */
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Headers: X-Requested-With, content-type, access-control-allow-origin,"
               . "access-control-allow-methods, access-control-allow-headers");

session_start();

$connection = new mysqli('localhost', 'root', "", 'educationsystem');

?>