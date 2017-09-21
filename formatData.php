<?php
$tableBody = "";
foreach($_POST as $key => $value)		//This will loop through each name-value in the $_POST array
{
  $tableBody .= "<tr>";				//formats beginning of the row
  $tableBody .= "<td>$key</td>";		//dsiplay the name of the name-value pair from the form
  $tableBody .= "<td>$value</td>";	//dispaly the value of the name-value pair from the form
  $tableBody .=  "</tr>";				//End this row
}
function date1(){
  $date = $_POST["date"];
  $date = $date[0].$date[1].'/'.$date[2].$date[3].'/'.$date[4].$date[5];
  echo ("<h1>#1. Date in MM/DD/YYYY format</h1>");
  echo "<br>";
  echo date('m/d/y', strtotime($date));
  echo "<br>";
}
date1();
function date2(){
  $dateInt = $_POST["dateInt"];
  $dateInt = $dateInt[0].$dateInt[1].'/'.$dateInt[2].$dateInt[3].'/'.$dateInt[4].$dateInt[5];
  echo ("<h1>#2. Date in DD/MM/YYYY format</h1>");
  echo "<br>";
  echo date('d/m/y', strtotime($dateInt));
  echo "<br>";
}
date2();
function lengths(){
  $string = $_POST["string"];
  $length = strlen ( $string );
  echo("<h1>#3. Length of String.</h1>");
  echo "<br>";
  echo ("$length");
  echo "<br>";
}
lengths();
function trims(){
  $string = $_POST["string"];
  echo ("<h1>#4. Trim the whitespace.</h1>");
  echo "<br>";
  echo (trim($string));
  echo "<br>";
}

trims();
function lower(){
  $string = $_POST["string"];
  echo("<h1>#5. String to lower case.</h1>");
  echo "<br>";
  echo (strtolower($string));
  echo "<br>";
}
lower();
function dmacc(){
  $string = $_POST["string"];
  echo ("<h1>#6. Does the string contain DMACC?</h1>");
  echo "<br>";
  if (strpos($string, 'DMACC') !== false) {
    echo ('True');
    }
  if (strpos($string, 'DMACC') !== true) {
      echo ('False');
      }
  if (strpos($string, 'dmacc') !== false) {
        echo ('True');
    }
  if (strpos($string, 'dmacc') !== true) {
      echo (' False');
      }

  echo "<br>";
}
dmacc();
function number1(){
  $num = $_POST["num"];
  echo ("<h1>#7. Number Format.</h1>");
  echo "<br>";
  echo (number_format ($num));
  echo "<br>";
}
number1();
function number2(){
  $money = $_POST["currency"];
  echo ("<h1>#8. Currency Format</h1>");
  echo "<br>";
  echo ('$' . number_format($money, 2));
}
number2();
 ?>
 <!DOCTYPE html>
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 </head>

 <body>
 <h2>Form Handler Result Page</h2>

 <p>
 	<table border='a'>
     <tr>
     	<th>Field Name</th>
         <th>Value of Field</th>
     </tr>
 	<?php echo $tableBody;  ?>
 	</table>
 </p>



 </body>
 </html>
