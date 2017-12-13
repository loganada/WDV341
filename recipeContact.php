
<?php

session_start();
//Setup the variables used by the page
  //field data
  $inName = "";
  $inEmail = "";
  $inComments= "";
  $inSelect = "";
  $inMailing= "";
  $inInfo= "";
 $inUser="";
 $contactDate="";
 $contactTime="";
  //error messages
  $nameErrMsg = "";
  $emailErrMsg = "";
  $commentsErrMsg = "";
  $selectErrMsg = "";
  $userErrMsg = "";
  $validForm = false;
$roboErrMsg = "";
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
  $inMailing= $_POST['checkbox'];
  $inInfo=  $_POST['checkbox2'];
  //$inUser=$_POST['g-recaptcha-response'];
  $contactDate= date('Y-m-d');
  $contactTime=date('H:i:s');
$roboTest = $_POST['robotest'];
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
/*
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
*/
  //VALIDATE FORM DATA  using functions defined above
  $validForm = true;		//switch for keeping track of any form validation errors

  validateName($inName);
  validateEmail($inEmail);
  validateSelect($inSelect);
validateComments($inComments);
if (!$roboTest == "") {
  $roboErrMsg = "You are a robot!";
  $validForm = false;
}
//validateUser($inUser);
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



  if ($validForm == true) {


  include "connectPDO.php";

  		//Create the SQL command string
  		$sql = "INSERT INTO recipes_contact (";
  		$sql .= "contact_name, ";
  		$sql .= "contact_email, ";
  		$sql .= "contact_reason, ";
  		$sql .= "contact_comments, ";
      $sql .= "contact_mailingList, ";
  		$sql .= "contact_moreInfo, ";
      $sql .= "contact_date, ";
      $sql .= "contact_time ";	  //Last column does NOT have a comma after it.
  		$sql .= ") VALUES (?,?,?,?,?,?,?,?)";	//? Are placeholders for variables

  		//Display the SQL command to see if it correctly formatted.
  		//echo "<p>$sql</p>";

  		$query = $conn->prepare($sql);	//Prepares the query statement

  		//Binds the parameters to the query.
  		//The ssssis are the data types of the variables in order.


      $query->bindParam(2, $inName, PDO::PARAM_STR, 100);
      $query->bindParam(3, $inEmail, PDO::PARAM_STR, 100);
      $query->bindParam(4, $inComments, PDO::PARAM_STR, 100);
      $query->bindParam(5, $inSelect, PDO::PARAM_STR, 100);
      $query->bindParam(6, $inMailing, PDO::PARAM_STR, 100);
      $query->bindParam(6, $inInfo, PDO::PARAM_STR, 100);
      $query->bindParam(6, $contact_date, PDO::PARAM_STR, 100);
      $query->bindParam(6, $contact_time, PDO::PARAM_STR, 100);
  		//Run the SQL prepared statements
  		if ( $query->execute(array($inName, $inEmail, $inComments, $inSelect, $inMailing, $inInfo, $contactDate, $contactTime) ))
  		{
  		$message = "<h1>Your record has been successfully added to the database.</h1>";

  		}
  		else
  		{
  		$message = "<h1>You have encountered a problem.</h1>";

  		}
  $query=null;
  $conn=null;	//closes the connection to the database once this page is complete.
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
<link href="https://fonts.googleapis.com/css?family=Cuprum" rel="stylesheet">

<style>
*{
  margin:0;
  padding:0;
}
.radio{
  border: none;
  margin: 2px;
  font-size: 10px;
  padding: 5px;
  float: right;
}
#container{
width: 90%;
color: black;
margin: 2%;
padding: 30px;
border-radius: 20px;
background-color: white;
height: 500px;
}
#heading{
background-color: white;
color:black;
padding: 5px;
}
#secondary{
    background-color: white;
    color: black;
}
.food{
  float: right;
  width: 52%;
  clear: right;
}
#tab1, #tab2{
float: left;
width: 42%;
padding: 7px;
}
p{
  font-weight: bold;
  font-size: 20px;
  text-decoration: underline;
}
li {
  text-decoration: none;
  color: black;
  display: inline;
  float: right;
  font-size: 30px;
  padding: 15px;
  margin-top: 20px;
  font-weight: bold;
}
body{
  background-image: url(pinapple.jpg);
   background-size: 100%;
   font-family: 'Cuprum', sans-serif;
}
a:link, a:hover, a:visited, a:active{
  text-decoration: none;
  color: black;
}
.picture{
  float: left;
  width: 300px;
margin: 20px;
}
h1{
  color: black;
  font-size: 50px;
  padding: 5px;
}

#img{
  width:500px;
}
#banner{
width: 50%;
margin: auto;
}
#breakfast,#crockpot, #main, #quickEasy, #vegitarian {
  background: linear-gradient(to bottom right, green, yellow); /* Standard syntax */
  padding: 15px;
  font-size: 40px;
  color: black;
  font-weight: bold;
  border: none;
  margin-left: 3%;
  width: 220px;
  border-radius: 20px;
  display: inline;
  font-family: 'Cuprum', sans-serif;

}
#contain{

}

#contactForm{
  text-align: center;
    background-color: white;
}
hr{
border: solid 5px #e65c00;
border-radius: 20px;
}
form{
  padding: 8px;

}
</style>
</head>

<body>
  <!--Navigation Menu-->
    <div id = "navBackground">
      <div id = "navSecondary">
        <div>
          <a href= "recipe.php"><img class = "picture" src="Yummly-logo.png" /></a>
        </div>

      <nav> <!-- Navigation Menu Creation-->
        <ul>
          <li><a href="recipeContact.php">Contact</a></li>
          <li><a href="recipeLogin.php">Login</a></li>
        </ul>
      </nav>
    </div>
    </div>

  <div><br><br><br><br><br><br><br><br><br></div><!--Line Break-->
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
  <div id = "contain">
  <button id = "breakfast" onclick= "callBreakfast()">Breakfast</button>
  <button id = "crockpot" onclick= "callCrockpot()">CrockPot</button>
  <button id = "main" onclick= "callMain()">Featured</button>
  <button id = "quickEasy" onclick= "callQuickEasy()">Quick</button>
  <button id = "vegitarian" onclick= "callVegitarian()">Vegetarian</button>
  </div>
  <br>
  <hr>
  <br>
  <div id = "banner">

  </div>

<form id = "banner" class = "bye"name="form1" method="post" action="recipeContact.php">
  <div id = "contactForm">
  <fieldset>
    <legend><img width="200px" src="Yummly-logo.png" /> </legend>
  <p>&nbsp;</p>
  <br>

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
        <option  value="Products">Recipe Problem</option>
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
  <br>
  <p class="robotic" id="pot">

  <input name="robotest" type="hidden" id="robotest" class="robotest" value"<?php  $roboTest; ?>">
  <span class="error"><?php echo $roboErrMsg; //place error message on form  ?></span>
  </p>
  <p>
    <br>
    <input type="submit" name="submit" id="button" value="Submit">
    <input type="reset" name="reset" id="button2" value="Reset">
  </p>
</div>
</fieldset>
</form>


<?php
}//end else
?>
<br>
<p>&nbsp;</p>
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

function callBreakfast(){
  $(".bye").css("opacity", "0");
var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("banner").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "recipeBreakfast.php", true);
        xmlhttp.send();
      }
      function callCrockpot(){
        $(".bye").css("opacity", "0");
      var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200) {
                      document.getElementById("banner").innerHTML = this.responseText;
                  }
              };
              xmlhttp.open("GET", "recipeCrockpot.php", true);
              xmlhttp.send();
            }
            function callMain(){
              $(".bye").css("opacity", "0");
            var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("banner").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET", "recipeMain.php", true);
                    xmlhttp.send();
                  }
                  function callQuickEasy(){
                    $(".bye").css("opacity", "0");
                  var xmlhttp = new XMLHttpRequest();
                          xmlhttp.onreadystatechange = function() {
                              if (this.readyState == 4 && this.status == 200) {
                                  document.getElementById("banner").innerHTML = this.responseText;
                              }
                          };
                          xmlhttp.open("GET", "recipeQuickEasy.php", true);
                          xmlhttp.send();
                        }
                        function callVegitarian(){
                          $(".bye").css("opacity", "0");
                        var xmlhttp = new XMLHttpRequest();
                                xmlhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        document.getElementById("banner").innerHTML = this.responseText;
                                    }
                                };
                                xmlhttp.open("GET", "recipeVegitarian.php", true);
                                xmlhttp.send();
                              }


</script>

</body>
</html>
