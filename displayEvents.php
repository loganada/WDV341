<?php
	//Get the Event data from the server.
  session_start();


    $serverName = "localhost";
    $username = "adamloga_root";
    $password = "password";
    $dbname =  "adamloga_wdv341";

  //  echo "<tr>";
    //echo "<td>$event_name</td>";
    //echo "<td>$event_description</td>";
    //echo "<td>$event_presenter</td>";
    //echo "<td>$event_date</td>";
    //echo "<td>$event_time</td>";


    //echo "</tr>\n";

    try {
      $conn = new PDO("mysql:host=$serverName;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "
      <h1>WDV341 Intro PHP</h1>
      <h2>Example Code - Display Events as formatted output blocks</h2>
      ";
      $stmt = "SELECT COUNT(*)  FROM wdv341_events ";
      if ($res = $conn->query($stmt))
      {
            if ($res->fetchColumn() > 0) {


                      $stmt = "SELECT event_id, event_name, event_description, event_presenter, DATE_FORMAT(event_day, '%m / %d / %Y') event_day, event_time FROM wdv341_events ";
                      foreach ($conn->query($stmt) as $row) {
                         echo "<div class ='eventBlock'>".
                         "<h3> Event Name: </h3>  " ."<h4>". $row['event_name'] . "</h4> <br>".
                        "<h3> Event Description: </h3>  " . "<h4>". $row['event_description'] . "</h4> <br>".
                         "<h3> Event Presenter: </h3>  " . "<h4>".$row['event_presenter'] . "</h4> <br>".
                        "<h3> Event Day:  </h3> " . "<h4>".$row['event_day']  . "</h4> <br>".
                        "<h3> Event Time: </h3>  " . "<h4>".$row['event_time']  . "</h4> <br>".
                        "    <a href=updateEvent.php?recId=" . $row['event_id'] .  ">Update</a> </h2>".
                         "   <a href=deleteEvent.php?recId="  .  $row['event_id'] .  ">Delete</a></h2><br>".
                         "</div> <br> <br>";


  }


  }
  /* No rows matched -- do something else */
   else {
       print "No rows matched the query.";
     }
   }
  }
  catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
  }
  	//Close the database connection
  $conn=null;
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>WDV341 Intro PHP  - Display Events Example</title>
    <style>
		.eventBlock{
			width:500px;
			margin-left:auto;
			margin-right:auto;
			background-color:#CCC;
		}

		.displayEvent{
			text_align:left;
			font-size:18px;
		}

		.displayDescription {
			margin-left:100px;
		}
    h3{
      display: inline;

    }
    h4{
      display: inline;
      color: green;
    }
	</style>
</head>

<body>

</body>
</html>
