<?php
   session_start();
   ob_start();
   unset($_SESSION["username"]);
   unset($_SESSION["password"]);

   echo 'Successfully logged out';
   header('Refresh: 2; URL = login.php');
?>
