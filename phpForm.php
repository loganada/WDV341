<!DOCTYPE html>
<html>
<head>

</head>
<body>
  <h1>WDV341 Intro PHP</h1>
  <h2>WDV101 Intro HTML and CSS Chapter 9 - Creating Forms - Code Example</h2>
  <p><strong>Basic Form Handler</strong> - This process will display the 'name = value' pairs for all the elements of a form. This summary will on any number of form elements regardless of their name attribute value. </p>
  <p>Use <strong>basicFormExample.php</strong> in the action attribute of your form. </p>
  <p>Field '<strong>name</strong>' - The value of the name attribute from the HTML form element.</p>
  <p>Field <strong>'value</strong>' - The value entered in the field. This will vary depending upon the HTML form element.</p>

  <form action="formHandler.php" method="post">
  <p>First Name:
    <input type="text" name="firstName" id="firstName" />
</p>
  <p>Last Name:
    <input type="text" name="lastName" id="lastName" />
  </p>
  <p>School:
    <input type="text" name="school" id="school" />
  </p>
  <p>
  <?php

  echo "<h2>Choose your Gender!</h2>";
  ?>
  <input type="radio" name="gender" value="male" checked> Male<br>
  <input type="radio" name="gender" value="female"> Female<br>
  <input type="radio" name="gender" value="other"> Other
<br>
<?php
echo "<h2>Enter Job Position</h2>";
?>
<input type="text" name="job" value=""> <br>
<?php
echo "<h2>Choose your mode of Transport!</h2>";
?>
  <input type="checkbox" name="vehicle1" value="Bike"> I have a bike<br>
 <input type="checkbox" name="vehicle2" value="Car"> I have a car

  <br>
  <?php
  echo "<h2>Choose your type of car!</h2>";
  ?>
  <select name = "selectList">
  <option value="volvo">Volvo</option>
  <option value="saab">Saab</option>
  <option value="mercedes">Mercedes</option>
  <option value="audi">Audi</option>
</select>

<br>
  <input type="submit" name="Submit" value="Submit">
  <input type="reset" name="Reset" value="Reset">
</form>


</body>
</html>
