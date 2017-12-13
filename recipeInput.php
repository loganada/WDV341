<?php
session_start();
if ($_SESSION['validUser'] == "yes")	//If this is a valid user allow access to this page
{

  $message = "<h1>Welcome Back    |    <a href='recipeLogin.php'>    Back to Home</a></h1>" ;	//Create greeting for VIEW area
}
else{
  //invalid user

  header('Location: recipeLogin.php');
}

	//Setup the variables used by the page
		//field data

		$recipeName = "";
    $servingSize = "";
		$prepTime = "";
		$cookTime = "";
		$ingredients= "";
		$prepInstruct = "";
    $img = "";
    $selecter="";
		//error messages

		$recipeNameErrMsg = "";
		$servingSizeErrMsg = "";
		$prepTimeErrMsg = "";
		$cookTimeErrMsg = "";
		$ingredientsErrMsg = "";
    $prepInstructErrMsg = "";
    $roboErrMsg = "";

		$validForm = false;

	if(isset($_POST["submit"]))
	{
		//The form has been submitted and needs to be processed
		//Validate the form data here!
		//Get the name value pairs from the $_POST variable into PHP variables
		//This example uses PHP variables with the same name as the name atribute from the HTML form

		$recipeName = $_POST['recipeName'];
		$servingSize= $_POST['servingSize'];
    $prepTime= $_POST['prepTime'];
    $cookTime= $_POST['cookTime'];
    $ingredients= $_POST['ingredients'];
    $prepInstruct= $_POST['prepInstruct'];
    $selecter=$_POST['selecter'];
    $roboTest = $_POST['robotest'];
    $img =  "src = ". "'". $_FILES['fileToUpload']['name']. "'";
    $target_dir = "photo/";


$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
		//VALIDATION FUNCTIONS		Use functions to contain the code for the field validations.

			function validateRecipeName($inRecipeName)
			{
				global $validForm, $recipeNameErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
				$recipeNameErrMsg = "";

				if($inRecipeName == "")
				{
					$validForm = false;
					$eventNameErrMsg = "Enter an Recipe Name";
				}
			}//end validateName()

			function validateServingSize($inServingSize)
			{
				global $validForm, $servingSizeErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
				$servingSizeErrMsg = "";

				if($inServingSize == "")
				{
					$validForm = false;
					$servingSizeErrMsg = "Enter a Serving Size";
				}

			}//end validateDescription()

			function validatePrepTime($inPrepTime)
			{
				global $validForm, $prepTimeErrMsg;
				$prepTimeErrMsg = "";

				if(empty($inPrepTime))
				{
					$validForm = false;
					$prepTimeErrMsg = "Prep time is required";
}
			}//end validatePresenter()

      function validateCookTime($inCookTime)
      {
        global $validForm, $cookTimeErrMsg;
        $cookTimeErrMsg = "";

        if(empty($inCookTime))
        {
          $validForm = false;
          $cookTimeErrMsg = "Cook time is required";
}
      }//end validatePresenter()

      function validateIngredients($inIngredients)
      {
        global $validForm, $ingredientsErrMsg;
        $ingredientsErrMsg = "";

        if(empty($inIngredients))
        {
          $validForm = false;
          $cookTimeErrMsg = "Ingredients are required";
}
      }//end validatePresenter()

      function validatePrepInstruct($inPrepInstruct)
      {
        global $validForm, $prepInstructErrMsg;
      $prepInstructErrMsg = "";

        if(empty($inPrepInstruct))
        {
          $validForm = false;
          $prepInstructErrMsg = "Prep Instructions are required";
}
      }//end validatePresenter()


		//VALIDATE FORM DATA  using functions defined above
		$validForm = true;		//switch for keeping track of any form validation errors
		validateRecipeName($recipeName);
		validateServingSize($servingSize);
		validatePrepTime($prepTime);
    validateCookTime($cookTime);
    validateIngredients($ingredients);
    validatePrepInstruct($prepInstruct);
		if (!$roboTest == "") {
	    $roboErrMsg = "You are a robot!";
	    $validForm = false;
	  }
		if($validForm)
		{
			$message = "All good";
		}
		else
		{
			$message = "Something went wrong";
		}


if ($validForm == "true") {

if ($selecter =='breakfast')
{
		require 'connectPDO.php';	//connects to the database
		//Create the SQL command string
		$sql = "INSERT INTO recipes_breakfast (";
		$sql .= "name_recipe, ";
		$sql .= "serving_size, ";
		$sql .= "prep_time, ";
		$sql .= "cook_time, ";
		$sql .= "ingredients, ";
    $sql .= "prep_instruct, ";
    $sql .= "img";	//Last column does NOT have a comma after it.
		$sql .= ") VALUES (?,?,?,?,?,?,?)";	//? Are placeholders for variables
	}
  if ($selecter == 'crockpot')
  {
  		require 'connectPDO.php';	//connects to the database
  		//Create the SQL command string
  		$sql = "INSERT INTO recipes_crockpot (";
  		$sql .= "name_recipe, ";
  		$sql .= "serving_size, ";
  		$sql .= "prep_time, ";
  		$sql .= "cook_time, ";
  		$sql .= "ingredients, ";
      $sql .= "prep_instruct, ";
      $sql .= "img";//Last column does NOT have a comma after it.
  		$sql .= ") VALUES (?,?,?,?,?,?)";	//? Are placeholders for variables
  	}
    if ($selecter == 'main')
    {
        require 'connectPDO.php';	//connects to the database
        //Create the SQL command string
        $sql = "INSERT INTO recipes_main (";
        $sql .= "name_recipe, ";
        $sql .= "serving_size, ";
        $sql .= "prep_time, ";
        $sql .= "cook_time, ";
        $sql .= "ingredients, ";
        $sql .= "prep_instruct, ";
          $sql .= "img";	//Last column does NOT have a comma after it.
        $sql .= ") VALUES (?,?,?,?,?,?)";	//? Are placeholders for variables
      }
      if ($selecter == 'quickEasy')
      {
          require 'connectPDO.php';	//connects to the database
          //Create the SQL command string
          $sql = "INSERT INTO recipes_quick_easy (";
          $sql .= "name_recipe, ";
          $sql .= "serving_size, ";
          $sql .= "prep_time, ";
          $sql .= "cook_time, ";
          $sql .= "ingredients, ";
          $sql .= "prep_instruct, ";
            $sql .= "img";	//Last column does NOT have a comma after it.
          $sql .= ") VALUES (?,?,?,?,?,?)";	//? Are placeholders for variables
        }
        if ($selecter == 'vegitarian')
        {
            require 'connectPDO.php';	//connects to the database
            //Create the SQL command string
            $sql = "INSERT INTO recipes_vegitarian(";
            $sql .= "name_recipe, ";
            $sql .= "serving_size, ";
            $sql .= "prep_time, ";
            $sql .= "cook_time, ";
            $sql .= "ingredients, ";
            $sql .= "prep_instruct, ";
              $sql .= "img";	//Last column does NOT have a comma after it.
            $sql .= ") VALUES (?,?,?,?,?,?)";	//? Are placeholders for variables
          }

		$query = $conn->prepare($sql);	//Prepares the query statement

		//Binds the parameters to the query.
		//The ssssis are the data types of the variables in order.


    $query->bindParam(2, $recipeName, PDO::PARAM_STR, 100);
    $query->bindParam(3, $servingSize, PDO::PARAM_STR, 100);
    $query->bindParam(4, $prepTime, PDO::PARAM_STR, 100);
    $query->bindParam(5, $CookTime, PDO::PARAM_STR, 100);
    $query->bindParam(6, $ingredients, PDO::PARAM_STR, 100);
    $query->bindParam(7, $prepInstruct, PDO::PARAM_STR, 100);
    $query->bindParam(8, $img, PDO::PARAM_STR, 100);

		//Run the SQL prepared statements
		if ( $query->execute(array($recipeName, $servingSize, $prepTime, $cookTime, $ingredients, $prepInstruct,$img) ))
		{
		$message = "<h1>Your record has been successfully added to the database.</h1>";

		}
		else
		{
		$message = "<h1>You have encountered a problem.</h1>";

		}

		$query=null;
		$conn=null;	//closes the connection to the database once this page is complete.

	}// ends if submit
	else
	{
		//Form has not been see by the user.  display the form
	}
}
//}//end Valid User True
//else
//{
	//Invalid User attempting to access this page. Send person to Login Page
	//header('Location: eventsForm.php');
//}
?>



<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  crossorigin="anonymous"></script>
  <style>
  *{

    margin:0;
    padding:0;
  }


  body{
    background-color: #999999;
    font-family: 'Pacifico', cursive;
    font-stretch: condensed;
  }

  .picture{
    float: left;
    width: 350px;
    padding:   20px  0px;
    margin: 0 20px 10px 10px;
    box-shadow: 0px 12px 8px 0px #009973;
  }

  .label{
    float: right;
    margin-right: 250px;
  }

  h3{
    margin-right:  30px;
    padding: 5px;
    display: inline;
    color:#009973;
  }
  h2{
  color:  black;
  }


  .servingSize{
  display: inline;
  float:right;
  }

  #banner{
  margin-right: 25px;
  float: right;
  width: 75%;

  }

  body{
    background-color: #ffcc80;
  }

  button{
    background-color: #ccffdc;
    border: none;
     padding: 15px 32px;
     text-align: center;
     text-decoration: none;
     display: inline-block;
     margin: 20px;
  }
  #categories{
    border-radius: 20px;
    border: solid black 2px;
  background-color: #ccffdc;
    margin-top: 55px;
    position: fixed;
    padding: 20px;
    margin-left: 25px;
  }
  .menu{
    color: black;
  }
  #container{
    background-color: #ccffdc;
    width: 600px;
    margin: auto;
    border: solid black 2px;
    border-radius: 20px;
    padding: 25px;
  }
  form{
    text-align: center;
  }
  h1{
    text-align: center;
    margin: 10px;

  }
  footer{
    text-align: center;
    margin: 10px;
  }
  </style>
</head>
<body>
  <?php
          //If the form was submitted and valid and properly put into database display the INSERT result message
    if($validForm)
    {
      ?>
          <h1><?php echo $message ?></h1>

      <?php
    }
    else	//display form
    {
      ?>

			<?php print "<h1> $message</h1>"; ?>

			<div id = "container" >
  <form class="form" action="recipeInput.php" method="post" enctype="multipart/form-data">
    <h1 id = "header">Insert a recipe!</h1>

    <h2 class = "fElement">Recipe Name:</h2>
    <input class = "fElement" type="text" name="recipeName" value="<?php echo $recipeName; ?>">
		  <span class="error"><?php echo $recipeNameErrMsg; //place error message on form  ?></span>

    <h2 class = "fElement">Serving Size:</h2>
    <input class = "fElement" type="text" name="servingSize" value="<?php echo $servingSize; ?>">
		  <span class="error"><?php echo $servingSizeErrMsg; //place error message on form  ?></span>

    <h2 class = "fElement">Prep Time:</h2>
    <input class = "fElement" type="text" name="prepTime" value="<?php echo $prepTime; ?>">
		  <span class="error"><?php echo $prepTimeErrMsg; //place error message on form  ?></span>

    <h2 class = "fElement">Cook Time:</h2>
    <input class = "fElement" type="text" name="cookTime"  value="<?php echo $cookTime; ?>">
<span class="error"><?php echo $cookTimeErrMsg; //place error message on form  ?></span>

  <h2 class = "fElement">Ingredients:</h2>
    <textarea rows="10" cols="81" class = "fElement" name="ingredients" value=""><?php echo $ingredients; ?></textarea>
<span class="error"><?php echo $ingredientsErrMsg; //place error message on form  ?></span>

    <h2 class = "fElement">Prep Instructions:</h2>
      <textarea rows="10" cols="81" class = "fElement" name="prepInstruct" value=""><?php echo $prepInstruct; ?></textarea>
<span class="error"><?php echo $prepInstructErrMsg; //place error message on form  ?></span>
<h2 class = "fElement">Select image to upload: </h2>
<input type="file" name="fileToUpload" id="fileToUpload">

      <h2 class = "fElement">Select a Category</h2>
      <select name = "selecter">
        <option value="breakfast" name="breakfast">Breakfast</option>
        <option value="crockpot" name="crockpot">CrockPot</option>
        <option value="main" name="main">Featured</option>
        <option value="quickEasy" name="quickEasy">Quick and Easy</option>
        <option value="vegitarian" name="vegitarian">Vegitarian</option>

      </select>
      <br><br><br>
<p class="robotic" id="pot">

<input name="robotest" type="hidden" id="robotest" class="robotest" value"<?php  $roboTest; ?>">
<span class="error"><?php echo $roboErrMsg; //place error message on form  ?></span>
</p>
    <input class="buttons"type="submit" name="submit" value="Submit">
    <input class="buttons" type="reset" name="reset" value="Reset">
  </form>
</div>
  <?php
}//end else
  ?>
  <footer>
    <p>Copyright &copy; <script> var d = new Date(); document.write (d.getFullYear());</script> All Rights Reserved</p>
    <a href="recipeLogin.php">Back to Home</a>
  </footer>
	<script>

	</script>
</body>
</html>
