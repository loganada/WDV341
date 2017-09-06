<?php
$yourName = "Adam Logan";
$number1 = 10;
$number2 = 5;
$total = "";
$total = $number1+$number2;
$language = array("HTML", "PHP", "Javascript");

 ?>
<!doctype html>
<html>
<head>

</head
<body>
<?php echo "<h1> $yourName</h1>" . PHP_EOL ;?>
<h2> <?php echo $yourName;?></h2>
<?php
echo "<h3> Number 1: $number1</h3>" . PHP_EOL;
echo "<h3> Number 2: $number2</h3>" . PHP_EOL;
echo "<h2> Total: $total</h2>" . PHP_EOL;
echo "<script> document.write( '$language[0]' + ', ' + '$language[1]' + ', ' + '$language[2]') </script>";
?>

</body>
</html>
