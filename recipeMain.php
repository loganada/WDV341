<?php
	//Get the Event data from the server.
  session_start();

include 'connectPDO.php';

    try {

      $stmt = "SELECT COUNT(*)  FROM recipes_main ";
      if ($res = $conn->query($stmt))
      {
            if ($res->fetchColumn() > 0) {


                      $stmt = ("SELECT recipe_ID, name_recipe, serving_size, prep_time, cook_time, ingredients, prep_instruct, img  FROM recipes_main ");
                      foreach ($conn->query($stmt) as $row) {

                        echo
                        "<div id = 'container'>".
                        "<div id ='heading'>".
                        "<h1>".  $row['name_recipe']. "</h1>".


                        "<div>".
                        "<h3> Prep Time: ". $row['prep_time']. " Minutes</h3>".
                        "<h3>Cook Time: ". $row['cook_time']. " Minutes</h3>".

                        "<input class = 'radio' type = 'button' name = 'servings' value='Double'onclick='changeMeasureD()'>".
                        "<input class = 'radio' type = 'button' name = 'servings' value='Normal'onclick='changeMeasureN()'>".
                        "<input class = 'radio' type = 'button' name = 'servings' value='Halve' onclick='changeMeasureH()'>".
                        "<h3> ". $row['serving_size']. " Servings</h3>".
                        "</div></div>".
                        "<div class = 'food'>".
                        "<img id = 'img' " . $row['img'] . " alt=''>".
                        "</div>".
                        "<div id = 'secondary' class = 'tab'>".
                        "<div id='tab1'>".
                          "<p>Ingredients:</p>".
                        $row['ingredients'].
                        "</div>".

                        "<div id='tab2'>".
                      "<p>Instructions:</p>".
                        $row['prep_instruct'].
                        "</div></div>".

                        "</div>";
}}}
  /* No rows matched -- do something else */
   else {
       print "No rows matched the query.";
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<title>Recipe</title>
<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">

</head>
<body>

</body>
</html>
