<?php
session_start();

if ($_SESSION['validUser'] == "yes")	//If this is a valid user allow access to this page
{

  //User is already signed on.  Skip the rest.
  $message = "Welcome Back--" . " " . $_POST['loginUsername'] ;	//Create greeting for VIEW area
}
else{
  //invalid user

  header('Location: login.php');
}

    include 'connectPDO.php';				//Connect to the database
  $id= $_GET['recId'];	//Pull the presenter_id from the GET parameter

  try{

     $sql = $conn->prepare( "DELETE FROM wdv341_event WHERE event_id = :id");
     $sql->execute (array(":id"=>$id));

     echo "Data successfully deleted in the database table ... ";
     echo " <a href= selectEvents.php>Back to the table</a></td>";
     }
     catch(PDOException $e){
     echo "Failed to delete the MySQL database table ... :".$e->getMessage();
     }


  $conn = null;
  ?>
