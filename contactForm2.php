<?php
session_start();
//Setup the variables used by the page
  //field data
  $inName = "";
  $inEmail = "";
  $inComments= "";
  $inSelect = "";
$inUser="";
  //error messages
  $nameErrMsg = "";
  $emailErrMsg = "";
  $commentsErrMsg = "";
  $selectErrMsg = "";
  $userErrMsg = "";
  $validForm = false;

if(isset($_POST["submit"]))
{
  //The form has been submitted and needs to be processed


  //Validate the form data here!

  //Get the name value pairs from the $_POST variable into PHP variables
  //This example uses PHP variables with the same name as the name atribute from the HTML form
  $inName = $_POST['inName'];
  $inEmail = $_POST['inEmail'];
  $inSelect = $_POST['inSelect'];
  $inComments = $_POST['inComments'];
  $inUser=$_POST['g-recaptcha-response'];
  /*	FORM VALIDATION PLAN

  The page will validate the form fields according to the following validation tests.
  Name Field:  Required, Check HTML special characters
  Email Field: Required, Must be a valid email format.  Use a Regular Expression to validate the format.
  Contact Reason:  An option must be selected. If Other is selected then Comments are Required and cannot be empty.
  Comments: Not required unless "Other" is selected then Required.  If anything is entered check for HTML special characters.
  A form returned to the customer with errors will include all the original values and selections made by the customer along with any error messages.
  When the form data is valid it will continue with the following steps.
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
    elseif($inName=="")
    {
      $validForm = false;
      $nameErrMsg = "Name is required";
    }
    else {
  		$inName = ltrim($inName);
  	}
  }//end validateName()

  function validateEmail($inEmail)
  {
    global $validForm, $emailErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
    $emailErrMsg = "";
    if($inEmail=="")
  	{
  		$validForm = false;
  		$emailErrMsg = "E-mail is required";
  	}
  elseif(!preg_match('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/', $inEmail))
    {
      $validForm = false;
      $emailErrMsg = "Email is invalid";
    }
  }//end validateEmail()

  function validateSelect($inSelect)
  {
    global $validForm, $selectErrMsg;
    $selectErrMsg = "";

    if(empty($inSelect))
    {
      $validForm = false;
      $selectErrMsg = "You must select an option.";
    }
    else
    {

       }

  }//end validateRadioGroup()
  function validateComments($inComments)
  {
    global $validForm, $commentstErrMsg;
    $commentsErrMsg = "";


}//end validateComments()
function validateUser($inUser){
  global $validForm, $usertErrMsg;
  $userErrMsg = "";
  $url = 'https://www.google.com/recaptcha/api/siteverify';
  $privatekey = '6LelqTQUAAAAAMpcK_8arjKNwvWeq7ursy-A4o3K';
  $response = file_get_contents($url."?secret=". $privatekey."&response=". $_POST['g-recaptcha-response'].
  "&remoteip".$_SERVER['REMOTE_ADDR']);
  $data = json_decode($response);
if(empty($inUser)){
  $validForm = false;
  $userErrMsg= "You must fill out the recaptcha.";
}
else{

}


  }

  //VALIDATE FORM DATA  using functions defined above
  $validForm = true;		//switch for keeping track of any form validation errors

  validateName($inName);
  validateEmail($inEmail);
  validateSelect($inSelect);
validateComments($inComments);
validateUser($inUser);
  if($validForm)
  {
    $recipient =  $_POST["inEmail"] ;
    $message =   strip_tags("<html><body> \r\n");
    $message .=  strip_tags("<h2>This Email was sent on  " . date("l Y/m/d") . "</h2> \r\n");
    $message .=  strip_tags("<h2>Hello there,  " . $_POST["inName"] . "</h2> \r\n");
    $message .=  strip_tags("<h2>Your email address is:  " .  $_POST["inEmail"]."</h2> \r\n" );
    $message .=  strip_tags("<h2>Reason for Contact:  ".  $_POST["inSelect"]."</h2> \r\n" );
    $message .=  strip_tags( "<h2>Comments:  ".   $_POST["inComments"]."</h2> \r\n" );
    $message .=  strip_tags("<h2>Mailing list? ".  $_POST["checkbox"]."</h2> \r\n" );
    $message .=  strip_tags( "<h2>More Information? ".  $_POST["checkbox2"]."</h2> \r\n" );
    $message .=   strip_tags("<h1>Thank You for contacting us! </h1></body></html>");

      include 'exform.php';
      $contactEmail = new Email("");  //instantuate contactEmail
      $contactEmail -> setRecipient($recipient);
      $contactEmail -> setSender("amlogan2@dmacc.edu");
      $contactEmail -> setSubject("Contact Form");
      $contactEmail -> setMessage(" The Message that you sent us follows.    " .  $message);
      $emailStatus = $contactEmail-> sendMail(); //Sends the mail

      $businessEmail = new Email("");// instatuate businessEmail
      $businessEmail-> setRecipient("amlogan2@dmacc.edu");
      $businessEmail -> setSender("Me");
      $businessEmail -> setSubject("Contact Form");
      $businessEmail -> setMessage(" The Message that you sent us follows.    " . $message);
      $emailStatus = $businessEmail-> sendMail(); //Sends the mail
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
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>WDV341 Intro PHP - Form Processing</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<style>
*{
  margin: 0;
  padding: 0;
}
li {
  text-decoration: none;
  color: #53682B;
  display: inline;
  float: right;
  font-size: 30px;
  padding: 15px;
  margin-top: 20px;
  font-weight: bold;
}
#navBackground{
  height: 100px;
  background-color: #E98300;
  box-shadow: 0px 12px 0px 0px #E98300;
}
#navSecondary{
  height: 23px;
  background-color: #53682B;
  box-shadow: 0px 7px 0px 0px #53682B ;
}
body{
  background-color: #fff4e6;
  font-family: helvetica, sans-serif;
}
.donate{
  background-color: #cc2900;
  color: white;
  border: none;
  padding:   45px  8px;
    text-align: center;
    text-decoration: none;
    font-weight: bold;
    display: inline-block;
    font-size: 25px;
    float: right;
    margin: 0 20px 10px 10px;
    box-shadow: 0px 12px 8px 0px #bfbfbf;
}
.picture{
  float: left;
  height: 120px;
  padding:   25px  8px;
  margin: 0 20px 10px 10px;

}
.logo{
  box-shadow: 0px 12px 8px 0px #bfbfbf;
  height: 115px;
  position: fixed;
}
h2 h1 h3{
text-align: center;
font-family: helvetica, serif;
font-weight: bold;
padding: 10px;

}
body{
background-color: #e6ffee;
}
form{


}
fieldset{
float: left;
border-color: #53682B;
border-radius: 20px;
border-width: 7px;
margin-left: 200px;
padding: 30px;
}
#textfield, #textfield2, #select2, #textarea{
  border: 5px  #E98300 solid;
}
#checkbox{
padding: 2px;
background-color: black;
}
.aside{
float: right;
width: 500px;

}
#button, #button2{
  background-color: #cc2900;
  color: white;
  border: none;
  padding:  10px;
    text-align: center;
    text-decoration: none;
    font-weight: bold;
    display: inline-block;
    font-size: 15px;
    margin: 0 20px 10px 10px;
    box-shadow: 0px 12px 8px 0px #bfbfbf;
}
#button{
  background-color: #33ff33;
  color: black;
}


</style>
</head>

<body>
  <div id = "navBackground">
    <div id = "navSecondary">
      <div class="picture">
        <img class= "logo" src="FALogo.jpg" />
      </div>
      <input type = "button" class = "donate" value = "DONATE!">
    <nav> <!-- Navigation Menu Creation-->
      <ul>

        <li>Hunger In <br> America</li>
        <li>Our <br>Work</li>
        <li>Take<br> Action</li>
        <li>Find a <br> Food Bank</li>
        <li>Hunger<br> Blog</li>
      </ul>
    </nav>
  </div>
  </div>
  <br>
  <br>
<br>
<br>

<?php
if($validForm)
{

  if ($emailStatus) {

    ?>
    	<form id="form1" name="form1" method="" action="">
          <p>
            <h2>Hello there,   <?php echo $_POST["inName"] ; ?></h2>
          </p>
          <p>
              <h2>Your email address is:  <?php echo $_POST["inEmail"] ; ?></h2>
          </p>
          <p>
            <h2>Reason for Contact:  <?php echo $_POST["inSelect"] ; ?></h2>

          </p>
          <p>
            <h2>Comments:  <?php echo $_POST["inComments"] ; ?></h2>

          </p>
          <p>
            <h2>Mailing list?  <?php echo $_POST["checkbox"];  ?></h2>

          </p>
          <p>
            <h2>More Information?  <?php echo $_POST["checkbox2"] ; ?></h2>
          </p>
          <p>
            <h2>This email was sent on: <?php  echo date("l Y/m/d");?> </h2>
          </p>
          <h1>Thank You for contacting us!</h1>
        </form>

    <?php

    }		//ends the true branch

    else
    {
    ?>
        <h3>Dear  <?php echo $_POST["inName"] ?> , </h3>

        <p>Thank you for contacting us, although we regret to inform you. YOUR MESSAGE WAS NOT SENT.</p>
        <p> Email: <?php echo $_POST["inEmail"]  ?></p>
        <p>Comments: <?php echo $_POST["inComments"]  ?></p>
        <h4>This message was generated on: <?php  echo date("l Y/m/d");?> </h4>
        <h1>YOUR MESSAGE HAS NOT BEEN SENT!</h1>

    <?php
    }//ends else branch and the if statement
    ?>


<?php

}
else	//display form
{
	?>

<form name="form1" method="post" action="contactForm2.php">
  <fieldset>
    <legend><h1>FEEDING AMERICA</h1>
    <h2>Programming Project - Contact Form</h2> </legend>
  <p>&nbsp;</p>
  <p>
    <label><h3>Your Name:</h3>
      <input type="text" name="inName" id="textfield" value="<?php echo $inName;  ?>" required/>
      <span><?php echo $nameErrMsg; ?></span>
    </label>
  </p>
  <p><h3>Your Email:</h3>
    <input type="text" name="inEmail" id="textfield2" value="<?php echo $inEmail; ?>"required>
  <span>  <?php echo $emailErrMsg; ?></span>
  </p>
  <p><h3>Reason for contact:</h3>
    <label>
      <select  name="inSelect" id="select2"  value = "<?php echo $inSelect;?>"required>
        <option disabled selected value="0">Please Select a Reason</option>
        <option  value="Products">Product Problem</option>
        <option  value="Return a Product">Return a Product</option>
        <option  value="Billing Questions">Billing Question</option>
        <option  value="Technical Problems">Report a Website Problem</option>
        <option value="Other">Other</option>
      </select>
      <p id = "selectErrMsg"></p>
      <span><?php echo $selectErrMsg; ?></span>
    </label>
  </p>
  <p>
    <label><h3>Comments:</h3>
      <textarea id = "comment" name="inComments" id="textarea" cols="45" rows="5" ><?php echo $inComments; ?></textarea>
      <span><?php echo $commentsErrMsg; ?></span>
    </label>
  </p>
  <p>
    <label>
      <input type="checkbox" name="checkbox" id="checkbox" checked>
    <h3>  Please put me on your mailing list.</h3></label>
  </p>
  <p>
    <label>
      <input type="checkbox" name="checkbox2" id="checkbox2" checked>
      <h3>Send me more information</label>
  about your products. </h3> </p>
  <p>
    <input type="hidden" name="hiddenField" id="hiddenField" value="application-id:US447">
    <div name="g-recaptcha-respose" class="g-recaptcha" data-sitekey="6LelqTQUAAAAAMvfVre67Et76fWW4iLJLrOXTB19" required></div>
      <span><?php echo $userErrMsg; ?></span>
  </p>
  <p>
    <br>
    <input type="submit" name="submit" id="button" value="Submit">
    <input type="reset" name="reset" id="button2" value="Reset">
  </p>
</fieldset>
</form>
<?php
}//end else
?>
<p>&nbsp;</p>
<img src="feeding_america_music.jpg" class = "aside"/>
<script>
$("#comment").click(function (event) {
    var picked = $('#select2 option:selected').val();
    if (picked == 0) {
        $("#selectErrMsg").html("Please select any value");
          $("#selectErrMsg").css("color", "red", "font-weight", "bold");
    } else {

    }
  });

$("#select2").change(function (event){
var picked = $('#select2 option:selected').val();
    if (picked == "Other") {
        $("#comment").prop('required', true);
          $("#selectErrMsg").html("Comments are Required.");
          $("#selectErrMsg").css("color", "green", "font-weight", "bold");
    }
    else {

    }

});
</script>

</body>
</html>
