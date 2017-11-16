<?php
session_start();

  $id= $_GET['recId'];	//Pull the presenter_id from the GET parameter
  $serverName = "localhost";
  $username = "adamloga_root";
  $password = "password";
  $dbname =  "adamloga_wdv341";
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  try{

     $sql = $conn->prepare( "DELETE FROM wdv341_event WHERE event_id = :id");
     $sql->execute (array(":id"=>$id));

     echo "Data successfully deleted in the database table ... ";
     echo " <a href= selectEvents.php>Back to the table</a></td>" 
     }catch(PDOException $e){
     echo "Failed to delete the MySQL database table ... :".$e->getMessage();
     }


  $conn = null;
  ?>
