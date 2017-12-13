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


$serverName = "localhost";
$username = "adamloga_root";
$password = "password";
$dbname = "adamloga_wdv341";

$connection = mysqli_connect($serverName,$username ,$password,$dbname);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
	if(isset($_POST["submit"]))
	{
		//The form has been submitted and needs to be processed

		//Get the name value pairs from the $_POST variable into PHP variables
		//The example uses variables with the same name as the name atribute from the form



		$recipe_name = $_POST['name_recipe'];
		$serving_size= $_POST['serving_size'];
		$prep_time = $_POST['prep_time'];
		$cook_time = $_POST['cook_time'];
		$ingredients = $_POST['ingredients'];
		$prep_instruct = $_POST['prep_instruct'];
    $img = "src = ". "'". $_FILES['fileToUpload']['name']. "'";
    $recipe_id = $_POST['recipe_ID'];

		//Create the SQL UPDATE query or command
		$sql = "UPDATE recipes_quick_easy SET " ;
		$sql .= "name_recipe=?, ";
		$sql .= "serving_size=?, ";
		$sql .= "prep_time=?, ";
		$sql .= "cook_time=?, ";
    $sql .= "ingredients=?, ";
		$sql .= "prep_instruct=?, ";
    $sql .= "img=? ";//NOTE last one does NOT have a comma after it
		$sql .= " WHERE (recipe_ID='$recipe_id')"; //VERY IMPORTANT

		//echo "<h3>$sql</h3>";			//testing

		$query = $connection->prepare($sql);	//Prepare SQL query

		$query->bind_param('sssssss',$recipe_name,
			$serving_size,$prep_time,$cook_time,$ingredients,$prep_instruct,$img);

		if ( $query->execute() )
		{
			$message = "<h1>Your record has been successfully UPDATED the database.</h1>";
			$message .= "<p>Please <a href='recipeDisplay.php'>view</a> your records.</p>";
		}
		else
		{
			$message = "<h1>You have encountered a problem.</h1>";
			$message .= "<h2 style='color:red'>" . mysqli_error($link) . "</h2>";
		}

	}//end if submitted
	else
	{
		//The form needs to display the fields of the record to the user for changes
		$updateRecId = $_GET['recId'];	//Record Id to be updated
		//$updateRecId = 2;				//Hard code a key for testing purposes

		//echo "<h1>updateRecId: $updateRecId</h1>";

		//Finds a specific record in the table
		$sql = "SELECT recipe_ID, name_recipe, serving_size, prep_time, cook_time, ingredients, prep_instruct,img FROM recipes_quick_easy WHERE recipe_ID=?";
		//echo "<p>The SQL Command: $sql </p>"; //For testing purposes as needed.

		$query = $connection->prepare($sql);

		$query->bind_param("i",$updateRecId);

		if( $query->execute() )	//Run Query and Make sure the Query ran correctly
		{
			$query->bind_result($recipe_ID, $recipe_name, $serving_size, $prep_time, $cook_time, $ingredients, $prep_instruct,$img);

			$query->store_result();

			$query->fetch();
		}
		else
		{
			$message = "<h1>You have encountered a problem with your update.</h1>";
			$message .= "<h2>" . mysqli_error($connection) . "</h2>" ;
		}

	}//end else submitted
//end Valid User True

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WDV341 Intro PHP - Update Events</title>
<style>
body{
  background-color: #ffcc80;
}
form{
  background-color: #ccffdc ;
  color: black;
  border: 0px;
  border-radius: 20px;
  text-align: center;
  margin: auto;
	width: 600px;

}
</style>
</head>

<body>


<?php
//If the user submitted the form the changes have been made
if(isset($_POST["submit"]))
{
	echo $message;	//contains a Success or Failure output content
}//end if submitted

else
{	//The page needs to display the form and associated data to the user for changes
?>
<form id="eventsForm" name="recipeForm" method="post" action="recipeUpdateQuick.php" enctype="multipart/form-data">
	<h1> Update Recipes</h1>
  <p>Update the following events Information.  Place the new information in the appropriate field(s)</p>
  <p>Recipe Name:
    <textarea rows="2" cols="80" name="name_recipe" id="event_name"
      value=""><?php echo $recipe_name; ?></textarea>	<!-- PHP will put the name into the value of field-->
  </p>
  <p>Serving Size:
    <textarea rows="2" cols="80" name="serving_size" id="event_description"
      value=""><?php echo $serving_size; ?></textarea>
  </p>
  <p>Prep Time:
    <textarea rows="2" cols="80" name="prep_time" id="prep_time"
        value=""><?php echo $prep_time; ?></textarea>
  </p>
  <p>Cook Time:
    <textarea rows="2" cols="80" name="cook_time" id="cook_time"
        value=""><?php echo $cook_time; ?></textarea>
  </p>
  <p>Ingredients:
    <textarea rows="12" cols="80" name="ingredients" id="ingredients"
      value=""> <?php echo $ingredients; ?></textarea>
  </p>
  <p>Prep Instructions:
    <textarea  rows="12" cols="80" name="prep_instruct" id="prep_instruct"
      value=""> <?php echo $prep_instruct; ?></textarea>
  </p>
  <p>Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload" value=""><br><br>
  <?php echo "Current File: " . $img; ?>
  </p>

    <!--The hidden form contains the record if for this record.
      You can use this hidden field to pass the value of record id
        to the update page.  It will go as one of the name value
        pairs from the form.
    -->
    <input type="hidden" name="recipe_ID" id="event_id"
      value="<?php echo $recipe_ID ?>" />

  <p>
    <input type="submit" name="submit" id="submit" value="Update" />
    <input type="reset" name="button2" id="button2" value="Clear Form" />
  </p>
</form>
<?php
}//end else submitted
$query->close();
$connection->close();
?>

</body>
</html>
