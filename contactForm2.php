
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>WDV341 Intro PHP - Form Processing</title>
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
margin-left: 250px;
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


<form name="form1" method="post" action="contactFormProcessor.php">
  <fieldset>
    <legend><h1>FEEDING AMERICA</h1>
    <h2>Programming Project - Contact Form</h2> </legend>
  <p>&nbsp;</p>
  <p>
    <label><h3>Your Name:</h3>
      <input type="text" name="textfield" id="textfield">
    </label>
  </p>
  <p><h3>Your Email:</h3>
    <input type="text" name="textfield2" id="textfield2">
  </p>
  <p><h3>Reason for contact:</h3>
    <label>
      <select name="select2" id="select2">
        <option value="Default">Please Select a Reason</option>
        <option value="Products">Product Problem</option>
        <option value="Return a Product">Return a Product</option>
        <option value="Billing Questions">Billing Question</option>
        <option value="Technica Problems">Report a Website Problem</option>
        <option value="Other">Other</option>
      </select>
    </label>
  </p>
  <p>
    <label><h3>Comments:</h3>
      <textarea name="textarea" id="textarea" cols="45" rows="5"></textarea>
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
  </p>
  <p>
    <br>
    <input type="submit" name="button" id="button" value="Submit">
    <input type="reset" name="button2" id="button2" value="Reset">
  </p>
</fieldset>
</form>
<p>&nbsp;</p>
<img src="feeding_america_music.jpg" class = "aside"/>
</body>
</html>
