<?php

//This script ends a user's session

 session_start();

  echo "Logout Successful ";
  session_destroy();   
  header("Location: adminLogin.html");
?>