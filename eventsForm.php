<?php
session_start();
//if ($_SESSION['validUser'] == "yes")	//If this is a valid user allow access to this page
//{


	//Setup the variables used by the page
		//field data

		$eventName = "";
		$description = "";
		$presenter = "";
		$date = "";
		$time = "";
		//error messages

		$eventNameErrMsg = "";
		$descriptionErrMsg = "";
		$presenterErrMsg = "";
		$dateErrMsg = "";
		$timeErrMsg = "";
$roboErrMsg = "";

		$validForm = false;

	if(isset($_POST["submit"]))
	{
		//The form has been submitted and needs to be processed


		//Validate the form data here!

		//Get the name value pairs from the $_POST variable into PHP variables
		//This example uses PHP variables with the same name as the name atribute from the HTML form

		$eventName = $_POST['eventName'];
		$description= $_POST['descrip'];
    $presenter= $_POST['present'];
    $date= $_POST['date'];
    $time= $_POST['time'];
$roboTest = $_POST['robotest'];
		/*	FORM VALIDATION PLAN

			FIELD NAME		VALIDATION TESTS & VALID RESPONSES
			First Name		Required Field		May not be empty
			Last Name		Required Field		May not be empty

			City			Optional
			State			Optional

			Zip Code		Required Field		Format and Numeric
			Email			Required Field		Format
		*/

		//VALIDATION FUNCTIONS		Use functions to contain the code for the field validations.

			function validateEventName($inEventName)
			{
				global $validForm, $eventNameErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
				$eventNameErrMsg = "";

				if($inEventName == "")
				{
					$validForm = false;
					$eventNameErrMsg = "Enter an Event Name";
				}
			}//end validateName()

			function validateDescription($inDescription)
			{
				global $validForm, $descriptionErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
				$descriptionErrMsg = "";

				if($inDescription == "")
				{
					$validForm = false;
					$descriptionErrMsg = "Enter a description";
				}
			}//end validateDescription()

			function validatePresenter($inPresenter)
			{
				global $validForm, $presenterErrMsg;
				$presenterErrMsg = "";

				if(empty($inPresenter))
				{
					$validForm = false;
					$presenterErrMsg = "Presenter Name required";
				}
				else
				{

					 }

			}//end validatePresenter()



		//VALIDATE FORM DATA  using functions defined above
		$validForm = true;		//switch for keeping track of any form validation errors


		validateEventName($eventName);
		validateDescription($description);
		validatePresenter($presenter);
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


/*
	This form is self-posting in order to process the validations.   It will use the following algorithm or process
	in order to properly display and validate the form and its data.

	if the form has been submitted		(The user has filled out the form and hit the submit button)
		{
		then validate the form data		(The form data is ready to be validated)

		//Validation Algorithm				(The validation process will follow the following process or set of steps)
		set validForm = true					Set a flag or switch to true.  This assumes the form data is valid.
			perform validateName()				This will validate the data from the Name field
			perform validateQuantity()			This will validate the data from the Quantity field
			perform validateEmail()				This will validate the data from the Email field
			perform validateShipping()			This will validate the data from the Shipping field
		if (validForm==true)				If the flag is still true no errors were found, the form is valid
			{
			move form data into database		The form data is good so it should be INSERTED into the database
			}
		else								The flag is false because errors were found in the data
			{
			load data back into the form		Put the data back into the form fiels so the user can see what was in the fields
			load the error messages				Place the appropriate error messages on the form so the user knows what to fix
			display the form					Display the form with its original data and error messages to the user.
			}
		}
	else
		{
		display the form				(The user needs to enter data on the form so it can be validated and processed)
		}
*/

/*
	field validation algorithm		This process is done for each field validation function.  The details change for each field but the
									same steps are processed in the same order for each validation.

		clear the error messages for this validation.  Set to ""		(Cleans up from previous errors and assumes there will not be an error)
		check the variable for the field against the expected values
		if it meets those values
			{
			the field is valid
			nothing else needs done
			}
		else
			{
			the field is invalid
			set the validForm=false			(A data validation error has been found.  The form is no longer valid)
			set the error message variable for this field to the appropriate message
			}
*/


if ($validForm == true) {

		require 'connectPDO.php';	//connects to the database
		//Create the SQL command string
		$sql = "INSERT INTO wdv341_event (";
		$sql .= "event_name, ";
		$sql .= "event_description, ";
		$sql .= "event_presenter, ";
		$sql .= "event_date, ";
		$sql .= "event_time ";	//Last column does NOT have a comma after it.
		$sql .= ") VALUES (?,?,?,?,?)";	//? Are placeholders for variables

		//Display the SQL command to see if it correctly formatted.
		echo "<p>$sql</p>";

		$query = $conn->prepare($sql);	//Prepares the query statement

		//Binds the parameters to the query.
		//The ssssis are the data types of the variables in order.


    $query->bindParam(2, $eventName, PDO::PARAM_STR, 100);
    $query->bindParam(3, $description, PDO::PARAM_STR, 100);
    $query->bindParam(4, $presenter, PDO::PARAM_STR, 100);
    $query->bindParam(5, $date, PDO::PARAM_STR, 100);
    $query->bindParam(6, $time, PDO::PARAM_STR, 100);
		//Run the SQL prepared statements
		if ( $query->execute(array($eventName, $description, $presenter, $date, $time) ))
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
		margin: 0;
		padding: 0;
	}
	.error {
		color: white;
		background-color: red;
		border: 3px double white;
		border-radius: 20%;
	}
	#container{
		width: 92%;
		border: 15px double white;
		border-radius: 30%;
		background-color: gray;
		margin: auto;
	}
	#header{
	margin:auto;
		border: 5px double red;
		border-radius: 40%;
		width: 75%;
		background-color: white;
	}
	.form{
		text-align: center;
		padding: 10px;
	}
	.fElement{
		padding: 5px;
		margin: 10px;
		border-color: red;
		border-radius: 30%;
	}
	.buttons{
		padding: 8px;
		margin: 10px;
		border-color: red;
		font-size: 20px;
		background-color: white;
		border-radius: 30%;
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
			<div id = "container" >
  <form class="form" action="eventsForm.php" method="post">
    <h1 id = "header">Insert an Event!</h1>

    <h2 class = "fElement">Event Name</h2>
    <input class = "fElement" type="text" name="eventName" value="<?php echo $eventName; ?>">
		  <span class="error"><?php echo $eventNameErrMsg; //place error message on form  ?></span>
    <h2 class = "fElement">Description</h2>
    <input class = "fElement" type="text" name="descrip" value="<?php echo $description; ?>">
		  <span class="error"><?php echo $descriptionErrMsg; //place error message on form  ?></span>
    <h2 class = "fElement">Presenter</h2>
    <input class = "fElement" type="text" name="present" value="<?php echo $presenter; ?>">
		  <span class="error"><?php echo $presenterErrMsg; //place error message on form  ?></span>
    <h2 class = "fElement">Date</h2>
    <input class = "fElement" type="text" name="date" id = "datepicker" value="<?php echo $date; ?>">
  <h2 class = "fElement">Time</h2>
    <input class = "fElement" type="time" name="time" value="<?php echo $time; ?>">

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

  </footer>
	<script>
	function datepicker(){
	$( "#datepicker" ).datepicker( );

}
datepicker();
	</script>
</body>
</html>
