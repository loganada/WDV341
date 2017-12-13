<?php
session_start();

if ($_SESSION['validUser'] == "yes")	//If this is a valid user allow access to this page
{

  $message = "Welcome Back";	//Create greeting for VIEW area
}
else{
  //invalid user

  header('Location: recipeLogin.php');
}
include 'connectPDO.php';
echo
"<div id = 'categories'>".

"<div  id = 'breakfastMenu' >".
"<h1><a class = 'menu' href= '#breakfast'>Breakfast</a></h1>".
"</div>".
"<div  id = 'crockpotMenu' >".
"<h1><a class = 'menu' href= '#crockpot'>CrockPot</a></h1>".
"</div>".
"<div  id = 'mainMenu' >".
"<h1><a class = 'menu' href= '#featured'>Featured</a></h1>".
"</div>".
"<div  id = 'quickEasyMenu' >".
"<h1><a class = 'menu' href= '#quickEasy'>Quick and Easy</a></h1>".
"</div>".
"<div  id = 'vegitarianMenu' >".
"<h1><a class = 'menu' href= '#vegitarian'>Vegitarian</a></h1>".
"</div>".
" <br>".
"------------------------------------".
"<br>".
"<h2><a class = 'menu' href ='recipeDisplay.php'>Back to Top</a></h2>".
"<h2><a class = 'menu' href ='recipeLogin.php'>Back to Home</a></h2>".
"<h2><a class = 'menu' href ='recipeInput.php'>Insert a Recipe</a></h2>".
"<h2><a class = 'menu' href ='recipe.php'>Back to Yummly.com</a></h2>".
"</div>";



try {

  $stmt = "SELECT COUNT(*)  FROM recipes_breakfast ";
  if ($res = $conn->query($stmt))
  {
        if ($res->fetchColumn() > 0) {

      echo  "  <table border='1'>
      <caption>Yummly Recipes Table<button> <a id = 'insert' href='recipeInput.php'>Insert a Recipe</a></button></caption>
          <tr>
            <th>RecipeName</th>
            <th>Serving Size</th>
            <th>Prep Time</th>
            <th>Cook Time</th>
            <th>Ingredients</th>
            <th>Prep Instructions</th>
            <th>Image</th>
            <th>Update</th>
            <th>Delete</th>
          </tr>";
                  $stmt = "SELECT recipe_ID, name_recipe, serving_size, prep_time, cook_time, ingredients, prep_instruct
                                                ,img
                                FROM recipes_breakfast ";
                                     echo "<h1 id = 'breakfast' class = 'label'>---------Breakfast Recipes----------</h1>";

                  foreach ($conn->query($stmt) as $row) {
                     echo
                     "<tr><td> " .  $row['name_recipe'] .  "</td>" .
                    " <td>" . $row['serving_size'] . "</td>"  .
                    "  <td>" . $row['prep_time'] . "</td>" .
                    "  <td> " . $row['cook_time'] .  "</td>" .
                    "   <td>" . $row['ingredients']  . "</td>" .
                      "   <td>" . $row['prep_instruct']  . "</td>" .
                      "   <td>" . $row['img']  . "</td>" .
                    "  <td>  <a href=recipeUpdateBreakfast.php?recId=" . $row['recipe_ID'] .  ">Update</a></td>" .
                     " <td>  <a href=recipeDeleteBreakfast.php?recId="  .  $row['recipe_ID'] .  ">Delete</a></td></tr> <br>";

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
try {

  $stmt = "SELECT COUNT(*)  FROM recipes_crockpot ";
  if ($res = $conn->query($stmt))
  {
        if ($res->fetchColumn() > 0) {

      echo  "  <table border='1'>
      <caption>Yummly Recipes Table<button> <a id = 'insert' href='recipeInput.php'>Insert a Recipe</a></button></caption>
          <tr>
            <th>RecipeName</th>
            <th>Serving Size</th>
            <th>Prep Time</th>
            <th>Cook Time</th>
            <th>Ingredients</th>
            <th>Prep Instructions</th>
            <th>Image</th>
            <th>Update</th>
            <th>Delete</th>
          </tr>";
                  $stmt = "SELECT recipe_ID, name_recipe, serving_size, prep_time, cook_time, ingredients, prep_instruct
                                                ,img
                                FROM recipes_crockpot ";
                                echo  "<h1 id = 'crockpot' class = 'label'>---------CrockPot Recipes---------</h1>";

                  foreach ($conn->query($stmt) as $row) {
                     echo
                     "<tr><td> " .  $row['name_recipe'] .  "</td>" .
                    " <td>" . $row['serving_size'] . "</td>"  .
                    "  <td>" . $row['prep_time'] . "</td>" .
                    "  <td> " . $row['cook_time'] .  "</td>" .
                    "   <td>" . $row['ingredients']  . "</td>" .
                      "   <td>" . $row['prep_instruct']  . "</td>" .
                            "   <td>" . $row['img']  . "</td>" .
                    "  <td>  <a href=recipeUpdateCrockpot.php?recId=" . $row['recipe_ID'] .  ">Update</a></td>" .
                     " <td>  <a href=recipeDeleteCrockpot.php?recId="  .  $row['recipe_ID'] .  ">Delete</a></td></tr> <br>";

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
try {

  $stmt = "SELECT COUNT(*)  FROM recipes_main ";
  if ($res = $conn->query($stmt))
  {
        if ($res->fetchColumn() > 0) {

      echo  "  <table border='1'>
      <caption>Yummly Recipes Table<button> <a id = 'insert' href='recipeInput.php'>Insert a Recipe</a></button></caption>
          <tr>
            <th>RecipeName</th>
            <th>Serving Size</th>
            <th>Prep Time</th>
            <th>Cook Time</th>
            <th>Ingredients</th>
            <th>Prep Instructions</th>
            <th>Image</th>
            <th>Update</th>
            <th>Delete</th>
          </tr>";
                  $stmt = "SELECT recipe_ID, name_recipe, serving_size, prep_time, cook_time, ingredients, prep_instruct
                                                ,img
                                FROM recipes_main ";
                                echo "<h1 id = 'featured' class = 'label'>---------Featured Recipes---------</h1>";

                  foreach ($conn->query($stmt) as $row) {
                     echo
                      "<tr><td> " .  $row['name_recipe'] .  "</td>" .
                    " <td>" . $row['serving_size'] . "</td>"  .
                    "  <td>" . $row['prep_time'] . "</td>" .
                    "  <td> " . $row['cook_time'] .  "</td>" .
                    "   <td>" . $row['ingredients']  . "</td>" .
                      "   <td>" . $row['prep_instruct']  . "</td>" .
                        "   <td>" . $row['img']  . "</td>" .
                    "  <td>  <a href=recipeUpdateMain.php?recId=" . $row['recipe_ID'] .  ">Update</a></td>" .
                     " <td>  <a href=recipeDeleteMain.php?recId="  .  $row['recipe_ID'] .  ">Delete</a></td></tr> <br>";

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
try {

  $stmt = "SELECT COUNT(*)  FROM recipes_quick_easy ";
  if ($res = $conn->query($stmt))
  {
        if ($res->fetchColumn() > 0) {

      echo  "  <table border='1'>
      <caption>Yummly Recipes Table<button> <a id = 'insert' href='recipeInput.php'>Insert a Recipe</a></button></caption>
          <tr>
            <th>RecipeName</th>
            <th>Serving Size</th>
            <th>Prep Time</th>
            <th>Cook Time</th>
            <th>Ingredients</th>
            <th>Prep Instructions</th>
            <th>Image</th>
            <th>Update</th>
            <th>Delete</th>
          </tr>";
                  $stmt = "SELECT recipe_ID, name_recipe, serving_size, prep_time, cook_time, ingredients, prep_instruct
                                                ,img
                                FROM recipes_quick_easy ";
                          echo "<h1 id = 'quickEasy' class = 'label'>---------Quick and Easy Recipes---------</h1>";

                  foreach ($conn->query($stmt) as $row) {
                     echo
                     "<tr><td> " .  $row['name_recipe'] .  "</td>" .
                    " <td>" . $row['serving_size'] . "</td>"  .
                    "  <td>" . $row['prep_time'] . "</td>" .
                    "  <td> " . $row['cook_time'] .  "</td>" .
                    "   <td>" . $row['ingredients']  . "</td>" .
                      "   <td>" . $row['prep_instruct']  . "</td>" .
                        "   <td>" . $row['img']  . "</td>" .
                    "  <td>  <a href=recipeUpdateQuick.php?recId=" . $row['recipe_ID'] .  ">Update</a></td>" .
                     " <td>  <a href=recipeDeleteQuick.php?recId="  .  $row['recipe_ID'] .  ">Delete</a></td></tr> <br>";

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
try {

  $stmt = "SELECT COUNT(*)  FROM recipes_vegitarian ";
  if ($res = $conn->query($stmt))
  {
        if ($res->fetchColumn() > 0) {

      echo  "  <table border='1'>
      <caption>Yummly Recipes Table<button> <a id = 'insert' href='recipeInput.php'>Insert a Recipe</a></button></caption>
          <tr>
            <th>RecipeName</th>
            <th>Serving Size</th>
            <th>Prep Time</th>
            <th>Cook Time</th>
            <th>Ingredients</th>
            <th>Prep Instructions</th>
            <th>Image</th>
            <th>Update</th>
            <th>Delete</th>
          </tr>";
                  $stmt = "SELECT recipe_ID, name_recipe, serving_size, prep_time, cook_time, ingredients, prep_instruct
                                                ,img
                                FROM recipes_vegitarian ";
                                echo "<h1 id = 'vegitarian' class = 'label'>---------Vegitarian Recipes---------</h1>";

                  foreach ($conn->query($stmt) as $row) {
                     echo
                      "<tr><td> " .  $row['name_recipe'] .  "</td>" .
                    " <td>" . $row['serving_size'] . "</td>"  .
                    "  <td>" . $row['prep_time'] . "</td>" .
                    "  <td> " . $row['cook_time'] .  "</td>" .
                    "   <td>" . $row['ingredients']  . "</td>" .
                      "   <td>" . $row['prep_instruct']  . "</td>" .
                          "   <td>" . $row['img']  . "</td>" .
                    "  <td>  <a href=recipeUpdateVegitarian.php?recId=" . $row['recipe_ID'] .  ">Update</a></td>" .
                     " <td>  <a href=recipeDeleteVegitarian.php?recId="  .  $row['recipe_ID'] .  ">Delete</a></td></tr> <br>";

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
$conn=null;	//Close the database connection
?>

<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<title>Recipe</title>
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
color:  #e65c00;
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
table{
  background-color: #ccffdc ;
  color: black;
    border: 0px;
  border-collapse: collapse;
  border-radius: 20px;
  border-spacing: 2px;
  float: right;
  margin: 30px;
width: 70%;
}
th, td {
    padding: 15px;
    font-size: 14px;

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
#insert:link, #insert:visited{

color: black;
  font-size: 20px;
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
</style>
</head>
<body>

<div><br><br><br><br><br><br><br></div><!--Line Break-->
<div id = "banner">

</div>



<script>
function callBreakfast(){
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
                        var xmlhttp = new XMLHttpRequest();
                                xmlhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        document.getElementById("banner").innerHTML = this.responseText;
                                    }
                                };
                                xmlhttp.open("GET", "recipeVegitarian.php", true);
                                xmlhttp.send();
                              }


      function openTab(evt, tabName) {
          // Declare all variables
          var i, tabcontent, tablinks;

          // Get all elements with class="tabcontent" and hide them
          tabcontent = document.getElementsByClassName("tabcontent");
          for (i = 0; i < tabcontent.length; i++) {
              tabcontent[i].style.display = "none";
          }

          // Get all elements with class="tablinks" and remove the class "active"
          tablinks = document.getElementsByClassName("tablinks");
          for (i = 0; i < tablinks.length; i++) {
              tablinks[i].className = tablinks[i].className.replace(" active", "");
          }

          // Show the current tab, and add an "active" class to the button that opened the tab
          document.getElementById(tabName).style.display = "block";
          evt.currentTarget.className += " active";
      }

      function openTab(evt, tabName) {
          // Declare all variables
          var i, tabcontent, tablinks;

          // Get all elements with class="tabcontent" and hide them
          tabcontent = document.getElementsByClassName("tabcontent");
          for (i = 0; i < tabcontent.length; i++) {
              tabcontent[i].style.display = "none";
          }

          // Get all elements with class="tablinks" and remove the class "active"
          tablinks = document.getElementsByClassName("tablinks");
          for (i = 0; i < tablinks.length; i++) {
              tablinks[i].className = tablinks[i].className.replace(" active", "");
          }

          // Show the current tab, and add an "active" class to the button that opened the tab
          document.getElementById(tabName).style.display = "block";
          evt.currentTarget.className += " active";
      }

      function openTab(evt, tabName) {
          // Declare all variables
          var i, tabcontent, tablinks;

          // Get all elements with class="tabcontent" and hide them
          tabcontent = document.getElementsByClassName("tabcontent");
          for (i = 0; i < tabcontent.length; i++) {
              tabcontent[i].style.display = "none";
          }

          // Get all elements with class="tablinks" and remove the class "active"
          tablinks = document.getElementsByClassName("tablinks");
          for (i = 0; i < tablinks.length; i++) {
              tablinks[i].className = tablinks[i].className.replace(" active", "");
          }

          // Show the current tab, and add an "active" class to the button that opened the tab
          document.getElementById(tabName).style.display = "block";
          evt.currentTarget.className += " active";
      }


</script>
</body>
</html>
