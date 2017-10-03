<?php
$recipient =  $_POST["textfield2"] ;
$message =     strip_tags("<html><body> \r\n");
$message .=   strip_tags("<h2>Hello there,  " . $_POST["textfield"] . "</h2> \r\n");
$message .=  strip_tags("<h2>Your email address is:  " .  $_POST["textfield2"]."</h2> \r\n" );
$message .=  strip_tags("<h2>Reason for Contact:  ".  $_POST["select2"]."</h2> \r\n" );
$message .=  strip_tags( "<h2>Comments:  ".   $_POST["textarea"]."</h2> \r\n" );
$message .=   strip_tags("<h2>Mailing list? ".  $_POST["checkbox"]."</h2> \r\n" );
$message .=  strip_tags( "<h2>More Information? ".  $_POST["checkbox2"]."</h2> \r\n" );
$message .=   strip_tags("<h1>Thank You for contacting us! </h1></body></html>");


  include 'exform.php';
  $contactEmail = new Email("");  //instantuate contactEmail
  $contactEmail -> setRecipient($recipient);
  $contactEmail -> setSender("amlogan2@dmacc.edu");
  $contactEmail -> setSubject("Contact Form");
  $contactEmail -> setMessage(" The Message that you sent us follows.    " .  $message);
  $emailStatus = $contactEmail-> sendMail(); //Sends the mail

  $businessEmail = new Email("");// instatuate businessEmail
  $businessEmail-> setRecipient("amlogan2@dmacc.edu");
  $businessEmail -> setSender("Me");
  $businessEmail -> setSubject("Contact Form");
  $businessEmail -> setMessage(" The Message that you sent us follows.    " . $message);
  $emailStatus = $businessEmail-> sendMail(); //Sends the mail
 ?>

<!doctype html>
 <html>
 <head>
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
   input{
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
   img{
     box-shadow: 0px 12px 8px 0px #bfbfbf;
     height: 115px;
   }
h2 h1{
  margin-left: 200px;
  font-family: helvetica, serif;
  font-weight: bold;

}
body{
  background-color: #e6ffee;
}
   </style>
<body>
  <div id = "navBackground">
    <div id = "navSecondary">
      <div class="picture">
        <img src="FALogo.jpg" />
      </div>
      <input type = "button" value = "DONATE!">
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
  <?php

  if ($emailStatus) {

    ?>
    	<form id="form1" name="form1" method="" action="">
          <p>
            <h2>Hello there,   <?php echo $_POST["textfield"] ; ?></h2>
          </p>
          <p>
              <h2>Your email address is:  <?php echo $_POST["textfield2"] ; ?></h2>
          </p>
          <p>
            <h2>Reason for Contact:  <?php echo $_POST["select2"] ; ?></h2>

          </p>
          <p>
            <h2>Comments:  <?php echo $_POST["textarea"] ; ?></h2>

          </p>
          <p>
            <h2>Mailing list?  <?php echo $_POST["checkbox"];  ?></h2>

          </p>
          <p>
            <h2>More Information?  <?php echo $_POST["checkbox2"] ; ?></h2>
          </p>
          <h1>Thank You for contacting us!</h1>
        </form>

    <?php

    }		//ends the true branch

    else
    {
    ?>
        <h3>Dear  <?php echo $_POST["textfield"] ?> , </h3>

        <p>Thank you for contacting us, although we regret to inform you. YOUR MESSAGE WAS NOT SENT.</p>
        <p> Email: <?php echo $_POST["textfield2"]  ?></p>
        <p>Comments: <?php echo $_POST["textarea"]  ?></p>

        <h1>YOUR MESSAGE HAS NOT BEEN SENT!</h1>

    <?php
    }//ends else branch and the if statement
    ?>
</body>
</head>
</html>
