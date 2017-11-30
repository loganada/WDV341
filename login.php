<?php
session_start();

if ($_SESSION['validUser'] == "yes")	//If this is a valid user allow access to this page
{

  //User is already signed on.  Skip the rest.
  $message = "Welcome Back--" . " " . $_POST['loginUsername'] ;	//Create greeting for VIEW area
}
else
{
  if (isset($_POST['submitLogin']) )			//Was this page called from a submitted form?
  {
    $inUsername = trim($_POST['loginUsername']);	//pull the username from the form
    $inPassword = trim($_POST['loginPassword']);	//pull the password from the form

    include 'connectPDO.php';				//Connect to the database

      $stmt = "SELECT event_user_name,event_user_password
                    FROM event_user
                    WHERE event_user_name = :username
                    AND event_user_password = :password";
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
</head>

<body>

<h2>WDV341 Intro PHP</h2>

<h3>Events Admin System Example</h3>

<?php print "<h1> $message</h1>"; ?>

<?php
	if ($_SESSION['validUser'] == "yes")	//This is a valid user.  Show them the Administrator Page
	{

//turn off PHP and turn on HTML
?>
		<h3>Events Administrator Options</h3>
        <p><a href="eventsForm.php">Input New Events</a></p>
        <p><a href="selectEvents.php">List of Events</a></p>
        <p><a href="logout.php">Logout of Events Admin System</a></p>

<?php
	}
	else									//The user needs to log in.  Display the Login Form
	{
?>
			<h2>Please login to the Administrator System</h2>
                <form method="post" name="loginForm" action="login.php" >
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
