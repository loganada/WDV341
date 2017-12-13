<?php
session_start();

if ($_SESSION['validUser'] == "yes")	//If this is a valid user allow access to this page
{

  $message = "Welcome Back";	//Create greeting for VIEW area
}
else{
  //invalid user

  header('Location: recipeLogin.php');
}

    include 'connectPDO.php';				//Connect to the database
  $id= $_GET['recId'];	//Pull the presenter_id from the GET parameter

  try{

     $sql = $conn->prepare( "DELETE FROM recipes_main WHERE recipe_ID = :id");
     $sql->execute (array(":id"=>$id));
 print "<h1> $message</h1>";
     echo "Data successfully deleted in the database table ... ";
     echo " <a href= recipeDisplay.php>Back to the table</a></td>";
     }
     catch(PDOException $e){
     echo "Failed to delete the MySQL database table ... :".$e->getMessage();
     }



  $conn = null;
  ?>
