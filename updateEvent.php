<?php
session_start();

$serverName = "localhost";
$username = "adamloga_root";
$password = "password";
$dbname =  "adamloga_wdv341";

$connection = mysqli_connect("localhost","adamloga_root","password","adamloga_wdv341");

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



		$event_name = $_POST[event_name];
		$event_description= $_POST[event_description];
		$event_presenter = $_POST[event_presenter];
		$event_time = $_POST[event_time];
		$event_date = $_POST[event_date];
		$event_id = $_POST[event_id];

		//Create the SQL UPDATE query or command
		$sql = "UPDATE wdv341_event SET " ;
		$sql .= "event_name=?, ";
		$sql .= "event_description=?, ";
		$sql .= "event_presenter=?, ";
		$sql .= "event_time=?, ";
		$sql .= "event_date=? ";	//NOTE last one does NOT have a comma after it
		$sql .= " WHERE (event_id='$event_id')"; //VERY IMPORTANT

		//echo "<h3>$sql</h3>";			//testing

		$query = $connection->prepare($sql);	//Prepare SQL query

		$query->bind_param('sssss',$event_name,
			$event_description,$event_presenter,$event_time,$event_date);

		if ( $query->execute() )
		{
			$message = "<h1>Your record has been successfully UPDATED the database.</h1>";
			$message .= "<p>Please <a href='selectEvents.php'>view</a> your records.</p>";
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
		$sql = "SELECT event_id,event_name,event_description,event_presenter, event_time,event_date FROM wdv341_event WHERE event_id=?";
		//echo "<p>The SQL Command: $sql </p>"; //For testing purposes as needed.

		$query = $connection->prepare($sql);

		$query->bind_param("i",$updateRecId);

		if( $query->execute() )	//Run Query and Make sure the Query ran correctly
		{
			$query->bind_result($event_id,$event_name,$event_description,$event_presenter,$event_time,$event_date);

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
<form id="eventsForm" name="eventsForm" method="post" action="updateEvent.php">
	<h1>WDV341 Intro PHP - Update Events</h1>
  <p>Update the following events Information.  Place the new information in the appropriate field(s)</p>
  <p>Event Name:
    <input type="text" name="event_name" id="event_name"
    	value="<?php echo $event_name; ?>"/>	<!-- PHP will put the name into the value of field-->
  </p>
  <p>Description:
    <input type="text" name="event_description" id="event_description"
    	value="<?php echo $event_description; ?>" />
  </p>
  <p>Presenter:
    <input type="text" name="event_presenter" id="event_presenter"
       	value="<?php echo $event_presenter; ?>" />
  </p>
  <p>Time:
    <input type="time" name="event_time" id="event_time"
        value="<?php echo $event_time; ?>" />
  </p>
  <p>Date:
    <input type="text" name="event_date" id="event_date"
    	value="<?php echo $event_date; ?>" />
  </p>


  	<!--The hidden form contains the record if for this record.
    	You can use this hidden field to pass the value of record id
        to the update page.  It will go as one of the name value
        pairs from the form.
    -->
  	<input type="hidden" name="event_id" id="event_id"
    	value="<?php echo $event_id ?>" />

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
