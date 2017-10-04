<?php
session_start();
//if ($_SESSION['validUser'] == "yes")	//If this is a valid user allow access to this page
//{


	//Setup the variables used by the page
		//field data
		$inName = "";
		$inSS= "";
		$RadioGroup1 = "";

		//error messages
		$nameErrMsg = "";
		$ssErrMsg = "";
		$radioGroupErrMsg = "";

		$validForm = false;

	if(isset($_POST["submit"]))
	{
		//The form has been submitted and needs to be processed


		//Validate the form data here!

		//Get the name value pairs from the $_POST variable into PHP variables
		//This example uses PHP variables with the same name as the name atribute from the HTML form
		$inName = $_POST['inName'];
		$inSS = $_POST['inSS'];
		$RadioGroup1 = $_POST['RadioGroup1'];


		/*	FORM VALIDATION PLAN

		Name:  Cannot be blank, should have any leading spaces removed.

Social Security: Must be numeric, no hyphens or ( ).  Must be the right size.  Use a Regular Expression for this validation.

Response: One must be selected.
		*/

		//VALIDATION FUNCTIONS		Use functions to contain the code for the field validations.

		function validateName($inName)
		{
			global $validForm, $nameErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
			$nameErrMsg = "";

			if(!preg_match('/^(?i)([À-ÿa-z\-]{2,})\x20([À-ÿa-z\-]{2,})(?-i)/', $inName))
			{
				$validForm = false;
				$nameErrMsg = "Name is Invalid, make sure you put in first and last!";
			}
		}//end validateName()

		function validateSS($inSS)
		{
			global $validForm, $ssErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
			$ssErrMsg = "";

			if(!preg_match('/^(?!000)([0-6]\d{2}|7([0-6]\d|7[012]))([ -]?)(?!00)\d\d\3(?!0000)\d{4}$/', $inSS))
			{
				$validForm = false;
				$ssErrMsg = "Social Security number is Invalid";
			}
		}//end validateName()

		function validateRadioGroup($RadioGroup1)
		{
			global $validForm, $radioGroupErrMsg;
			$radioGroupErrMsg = "";

			if(empty($RadioGroup1))
			{
				$validForm = false;
				$radioGroupErrMsg = "You must select an option.";
			}
			else
			{

				 }

		}//end validateRadioGroup()
		//VALIDATE FORM DATA  using functions defined above
		$validForm = true;		//switch for keeping track of any form validation errors

		validateName($inName);
		validateSS($inSS);
		validateRadioGroup($RadioGroup1);

		if($validForm)
		{
			$message = "All good";
		}
		else
		{
			$message = "Something went wrong";
		}



	}// ends if submit
	else
	{
		//Form has not been seen by the user.  display the form
	}
//}//end Valid User True
//else
//{
	//Invalid User attempting to access this page. Send person to Login Page
//	header('Location: presentersLogin.php');
//}
?>
<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WDV341 Intro PHP - Form Validation Example</title>
<style>

#orderArea	{
	width:600px;
	background-color:#CF9;
}


.error	{
	color:red;
	font-style:italic;
}
</style>
</head>

<body>
<h1>WDV341 Intro PHP</h1>
<h2>Form Validation Assignment


</h2>
<?php
if($validForm)
{
	?>
			<h1><?php echo $message ?></h1>

	<?php
}
else	//display form
{
	?>
<div id="orderArea">
  <form id="form1" name="form1" method="post" action="formValidationAssignment.php">
  <h3>Customer Registration Form</h3>
  <table width="587" border="0">
    <tr>
      <td width="117">First and Last Name:</td>
      <td width="246"><input type="text" name="inName" id="inName" size="40" value="<?php echo $inName;  ?>"/></td>
      <td width="210" class="error"><?php echo $nameErrMsg; ?></td>
    </tr>
    <tr>
      <td>Social Security</td>
      <td><input type="text" name="inSS" id="inSS" size="40" value="<?php echo $inSS;  ?>" /></td>
      <td class="error"><?php echo $ssErrMsg; ?></td>
    </tr>
    <tr>
      <td>Choose a Response</td>
      <td><p>
        <label>
          <input type="radio" name="RadioGroup1" id="RadioGroup1_0">
          Phone</label>
        <br>
        <label>
          <input type="radio" name="RadioGroup1" id="RadioGroup1_1">
          Email</label>
        <br>
        <label>
          <input type="radio" name="RadioGroup1" id="RadioGroup1_2">
          US Mail</label>
        <br>
      </p></td>
      <td class="error"><?php echo $radioGroupErrMsg; ?></td>
    </tr>
  </table>
  <p>
    <input type="submit" name="submit" id="button" value="Register" />
    <input type="reset" name="button2" id="button2" value="Clear Form" />
  </p>
</form>
<?php
}//end else
?>
</div>

</body>
</html>
