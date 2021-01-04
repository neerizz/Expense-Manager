<?php
include "init.php";

if(isset($_POST['username'])){
   $username = $_POST['username'];

   $result = $getFromU->checkUsername($username);
   $response = "Available.";
   
      if($result){
          $response = "Not Available.";
      }
   echo $response;
   die;
}

?>