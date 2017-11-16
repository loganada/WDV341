<?php
session_start();


  $serverName = "localhost";
  $username = "adamloga_root";
  $password = "password";
  $dbname =  "adamloga_wdv341";

  echo "<tr>";
  echo "<td>$event_name</td>";
  echo "<td>$event_description</td>";
  echo "<td>$event_presenter</td>";
  echo "<td>$event_date</td>";
  echo "<td>$event_time</td>";


  echo "</tr>\n";

  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $stmt = "SELECT COUNT(*)  FROM wdv341_event ";
    if ($res = $conn->query($stmt))
    {
          if ($res->fetchColumn() > 0) {

        echo  "  <table border='1'>
        <caption>WDV 341 - Events Table</caption>
            <tr>
              <th>Event Name</th>
              <th>Description</th>
              <th>Presenter</th>
              <th>Date</th>
              <th>Time</th>
              <th>Update</th>
              <th>Delete</th>
            </tr>";
                    $stmt = "SELECT event_id, event_name, event_description, event_presenter, event_date, event_time FROM wdv341_event ";
                    foreach ($conn->query($stmt) as $row) {
                       echo "<tr><td> " .  $row['event_name'] .  "</td>" .
                      " <td>" . $row['event_description'] . "</td>"  .
                      "  <td>" . $row['event_presenter'] . "</td>" .
                      "  <td> " . $row['event_date'] .  "</td>" .
                      "   <td>" . $row['event_time']  . "</td>" .
                      "  <td>  <a href=updateEvent.php?recId=" . $row['event_id'] .  ">Update</a></td>" .
                       " <td>  <a href=deleteEvent.php?recId="  .  $row['event_id'] .  ">Delete</a></td></tr> <br>";

}
echo "</table>";
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
$conn-> null;	//Close the database connection
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WDV341 Intro PHP  - Presenters Admin Example</title>
<style>
body{
  background-color: #ffcc80;
}
table{
  background-color: #ccffdc ;
  color: black;
  border: 0px;
  border-collapse: collapse;
  border-radius: 20px;
  border-spacing: 2px;
  margin: auto;

}
th, td {
    padding: 15px;
    font-size: 24px;
    
      margin: 10px;
}
tr:hover {background-color: #b3b3b3}
caption
{
  font-size: 30px;
  color: #ccffdc;
  background-color: black;
  padding: 15px;
  margin: 5px;
  border-radius: 30px;
}
</style>
</head>

<body>



</body>
</html>
