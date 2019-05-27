<?php
   session_start();
   unset($_SESSION["username"]);
   unset($_SESSION["valid"]);
   
   echo 'You have logged out.';
   header('Refresh: 1; URL = /');
?>
