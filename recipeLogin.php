<?php
session_start();

if ($_SESSION['validUser'] == "yes")	//If this is a valid user allow access to this page
{

  //User is already signed on.  Skip the rest.
  $message = "Welcome Back" ;	//Create greeting for VIEW area
}
else
{
  if (isset($_POST['submitLogin']) )			//Was this page called from a submitted form?
  {
    $inUsername = trim($_POST['loginUsername']);	//pull the username from the form
    $_SESSION['username'] = $inUsername;
    $inPassword = trim($_POST['loginPassword']);	//pull the password from the form

    include 'connectPDO.php';				//Connect to the database

      $stmt = "SELECT recipe_user_name,recipe_user_password
                    FROM recipe_user
                    WHERE recipe_user_name = :username
                    AND recipe_user_password = :password";
      $query= $conn->prepare($stmt);
                          $query->bindParam('username', $inUsername, PDO::PARAM_STR);
                          $query->bindValue('password', $inPassword, PDO::PARAM_STR);
                          $query->execute();

      $count = $query->rowCount();
      $row   = $query->fetch(PDO::FETCH_ASSOC);

 if($count == 1 && !empty($row)) {
    $_SESSION['validUser'] = "yes";				//this is a valid user so set your SESSION variable
    $message = "Welcome Back, $inUsername";
    //Valid User can do the following things:
  }
  else
  {
    //error in processing login.  Logon Not Found...
    $_SESSION['validUser'] = "no";
    $message = "Sorry, there was a problem with your username or password. Please try again.";
  }

    //Close the database connection
  $conn=null;

}//end if submitted
else
{
  //user needs to see form
}//end else submitted

}//end else valid user
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WDV341 Intro PHP - Login and Control Page</title>

<!--  User Login Page

if user is valid (Session variable - already logged on)
	display admin options
else
    if form has been submitted
        Get input from $_POST
        Create SELECT QUERY
        Run SELECT to determine if they are valid username/password
        if user if valid
            set Session variable to true
            display admin options
        else
            display error message
            display login form
    else
    display login form

-->
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
  padding: 5px;
  color:#009973;
  font-size: 45px;
  text-align: center;
}
h2{
color:  black;
  text-align: center;
  text-decoration: underline;
  padding: 20px;
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
#container{
  background-color: #ccffdc;
  width: 600px;
  margin: auto;
  border: solid black 2px;
  border-radius: 20px;
  padding: 25px;
}
form{
  text-align: center;
  margin: auto;
  padding: 20px;
  background-color: #ccffdc;
  border: solid black 2px;
  border-radius: 20px;
  width: 700px;
}
h1{
  text-align: center;
  margin: 10px;

}
footer{
  text-align: center;
  margin: 10px;
}
#message{
  text-align: center;
  margin: auto;
  font-size: 30px;
}
a:link, a:visited{
  color: black;
  text-decoration: none;
  font-size: 25px;
  padding: 5px;
}
a:hover{
  color: orange;
  text-decoration: none;
}

</style>
</head>

<body>

<h3><img width= "400px"src="Yummly-logo.png"</img> </h3>

<?php print "<h1> $message</h1>"; ?>

<?php
	if ($_SESSION['validUser'] == "yes")	//This is a valid user.  Show them the Administrator Page
	{

//turn off PHP and turn on HTML
?>
<form>
		<h2>Yummly Administrator Options</h2>
        <p><a href="recipeInput.php">Input New Recipes</a></p>
        <p><a href="recipeDisplay.php">Recipe List</a></p>
        <p><a href="recipeLogout.php">Logout of Yummly Admin </a></p>
</form>
<?php
	}
	else									//The user needs to log in.  Display the Login Form
	{
?>

                <form method="post" name="loginForm" action="recipeLogin.php" >
                  <h2 id = 'message'>Please login to the Yummly Admin System</h2>
                  <p>Username: <input name="loginUsername" type="text" /></p>
                  <p>Password: <input name="loginPassword" type="password" /></p>
                  <p><input name="submitLogin" value="Login" type="submit" /> <input name="" type="reset" />&nbsp;</p>
                </form>

<?php //turn off HTML and turn on PHP
}//end of checking for a valid user

//turn off PHP and begin HTML
?>
</body>
</html>
