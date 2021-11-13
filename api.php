<?php
 session_start();

 if(isset($_SESSION['json_data']) && !empty($_SESSION['json_data']))
 {
    exit($_SESSION['json_data']);
 }
 else
 {
     exit(json_encode(''));
 }
?>
