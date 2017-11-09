<?php
session_start();

$surveyName = "";
$surveyEmail= "";
$surveyOption1= "";
$surveyOption2= "";
$surveyOption3= "";
$surveyOption4= "";
$emailErrMsg="";

	$validForm = false;
  if(isset($_POST["submit"]))
  {
    //The form has been submitted and needs to be processed


    //Validate the form data here!

    //Get the name value pairs from the $_POST variable into PHP variables
    //This example uses PHP variables with the same name as the name atribute from the HTML form

    $surveyName = $_POST['name'];
    $surveyEmail= $_POST['email'];
    $surveyOption1= $_POST['option1'];
    $surveyOption2= $_POST['option2'];
    $surveyOption3= $_POST['option3'];
    $surveyOption4= $_POST['option4'];

function validateEmail($surveyEmail)
{
  global $validForm, $emailErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
  $emailErrMsg = "";
  if($surveyEmail=="")
  {
    $validForm = false;
    $emailErrMsg = "E-mail is required";
  }
else if(!preg_match('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/', $surveyEmail))
  {
    $validForm = false;
    $emailErrMsg = "Email is invalid";
  }
}//end validateEmail()





    		//VALIDATE FORM DATA  using functions defined above
    		$validForm = true;		//switch for keeping track of any form validation errors


    		validateEmail($surveyEmail);


    		if($validForm)
    		{
    			$message = "All good";
    		}
    		else
    		{
    			$message = "Something went wrong";
    		}


    if ($validForm == true) {

      $serverName = "localhost";
      $username = "adamloga_root";
      $password = "password";
      $database = "adamloga_wdv341";

      try {
          $conn = new PDO("mysql:host=$serverName;dbname=$database", $username, $password);
          // set the PDO error mode to exception
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          echo "Connected successfully";
          }
      catch(PDOException $e)
          {
          echo "Connection failed: " . $e->getMessage();
          }

    		//Create the SQL command string
    		$sql = "INSERT INTO adamloga_wdvSurvey (";
    		$sql .= "survey_name, ";
    		$sql .= "survey_email, ";
    		$sql .= "survey_option1, ";
        $sql .= "survey_option2, ";
        $sql .= "survey_option3, ";
        $sql .= "survey_option4 ";

    		$sql .= ") VALUES (?,?,?,?,?,?)";	//? Are placeholders for variables

    		//Display the SQL command to see if it correctly formatted.
    		echo "<p>$sql</p>";

    		$query = $conn->prepare($sql);	//Prepares the query statement

    		//Binds the parameters to the query.
    		//The ssssis are the data types of the variables in order.


        $query->bindParam(2, $surveyName, PDO::PARAM_STR, 100);
        $query->bindParam(3, $surveyEmail, PDO::PARAM_STR, 100);
        $query->bindParam(4, $surveyOption1, PDO::PARAM_STR, 100);
        $query->bindParam(5, $surveyOption2, PDO::PARAM_STR, 100);
        $query->bindParam(6, $surveyOption3, PDO::PARAM_STR, 100);
        $query->bindParam(7, $surveyOption4, PDO::PARAM_STR, 100);
    		//Run the SQL prepared statements
    		if ( $query->execute(array($surveyName, $surveyEmail, $surveyOption1, $surveyOption2, $surveyOption3, $surveyOption4) ))
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
form {
  background-color: gray;
  border: 5px black double;
  width: 500px;
  margin: auto;
}
li{
  list-style:  none;
}
#fullName, #email,  #submit, #reset{
  margin-left: 125px;
}
#set{
    margin-left: 50px;
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
  <form action="survey.php" method="post">
    <h2>Full Name:</h2>
  <p>
    <input type="text" name="name" id="fullName" />
</p>
<h2>Email:</h2>
<span>  <?php echo $emailErrMsg; ?></span>
<p>
  <input type="text" name="email" id="email"  value="<?php echo $surveyEmail; ?>"/>
</p>
<h2>Raiting:</h2>
<h3>Drag these options to rate them to your liking -- Top to bottom.

<ul id="sortable" >

  <li id = "option1" ><input  type = "hidden"  name="option1" >Monday/Wednesday 10:10am-Noon</input></li>

  <li id = "option2"><input  type = "hidden"    name="option2"  >Tuesday 6:00-9:00pm</input></li>

  <li  id = "option3"><input  type = "hidden"   name="option3" >Wednesday 6:00-9:00pm</input></li>

  <li  id = "option4" ><input type = "hidden"  name="option4"  >Tuesday/Thursday 10:10am-Noon</input></li>

</ul>

<input type = "button" onclick="findIndex()" value="Set" id="set">


<br>
  <input type="submit" name="submit" value="Submit" id= "submit">
  <input type="reset" name="Reset" value="Reset" id="reset">
</form>
<?php
}//end else
?>
<script>
$("#sortable").sortable();

function findIndex(){

  var listItem = $( "#option1" );
  $( "#option1" ).val( $(  "li" ).index( listItem ) );

  var listItem2 = $( "#option2" );
  $( "#option2" ).val( $(  "li"  ).index( listItem2 ) );

  var listItem3 = $( "#option3" );
$( "#option3" ).val( $( "li" ).index( listItem3) );

  var listItem4 = $( "#option4" );
$( "#option4" ).val( $( "li" ).index( listItem4) );

}


</script>
</body>
</html>
