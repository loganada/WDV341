<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script
    src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
    integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
    crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css?family=Cuprum" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<title>Recipe</title>
<style>
*{
  margin:0;
  padding:0;
}
.radio{
  border: none;
  margin: 2px;
  font-size: 10px;
  padding: 5px;
  float: right;
}
#container{
width: 90%;
color: black;
margin: 2%;
padding: 30px;
border-radius: 20px;
background-color: white;
height: 700px;
}
#heading{
background-color: white;
color:black;
padding: 5px;
}
#secondary{
    background-color: white;
    color: black;
}
.food{
  float: right;
  width: 52%;
  clear: right;
}
#tab1, #tab2{
float: left;
width: 42%;
padding: 7px;
}
p{
  font-weight: bold;
  font-size: 20px;
  text-decoration: underline;
}
li {
  text-decoration: none;
  color: black;
  display: inline;
  float: right;
  font-size: 30px;
  padding: 15px;
  margin-top: 20px;
  font-weight: bold;
}
body{
  background-image: url(pinapple.jpg);
   background-size: 100%;
   font-family: 'Cuprum', sans-serif;

}
a:link, a:hover, a:visited, a:active{
  text-decoration: none;
  color: black;
}
.picture{
  float: left;
  width: 300px;
margin: 20px;
}
h1{
  color: black;
  font-size: 50px;
  padding: 5px;
}
h3, h2{
  float: right;
  padding: 5px;
  display: inline;
  color: black;

}
#img{
  width:500px;
}
#banner{
width: 99%;
}
#breakfast,#crockpot, #main, #quickEasy, #vegitarian {
  background: linear-gradient(to bottom right, green, yellow); /* Standard syntax */
  padding: 15px;
  font-size: 40px;
  color: black;
  font-weight: bold;
  border: none;
  margin-left: 3%;
  width: 220px;
  border-radius: 20px;
  display: inline;
}



#contactForm{
  text-align: center;
    background-color: #333333;
}
hr{
border: solid 5px #e65c00;
border-radius: 20px;
}

</style>
<script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
</head>
<body>

<!--Navigation Menu-->
  <div id = "navBackground">
    <div id = "navSecondary">
      <div>
        <a href "recipe.php"><img class = "picture" src="Yummly-logo.png" /></a>
      </div>

    <nav> <!-- Navigation Menu Creation-->
      <ul>


        <li><a href="recipeContact.php">Contact</a></li>
        <li><a href="recipeLogin.php">Login</a></li>
      </ul>
    </nav>
  </div>
  </div>


<div><br><br><br><br><br><br><br><br></div><!--Line Break-->
<div id = "contain">
<button id = "breakfast" onclick= "callBreakfast()">Breakfast</button>
<button id = "crockpot" onclick= "callCrockpot()">CrockPot</button>
<button id = "main" onclick= "callMain()">Featured</button>
<button id = "quickEasy" onclick= "callQuickEasy()">Quick</button>
<button id = "vegitarian" onclick= "callVegitarian()">Vegetarian</button>
</div>


<hr>


<div id = "banner">

</div>
<br>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
    <li data-target="#myCarousel" data-slide-to="4"></li>
    <li data-target="#myCarousel" data-slide-to="5"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="squash.jpg" alt="Bowl">
    </div>

    <div class="item">
      <img src="broccoli.jpg" alt="Soup">
    </div>

    <div class="item">
      <img src="denver.jpg" alt="Cassarole">
    </div>

    <div class="item">
      <img src="mac.jpg" alt="Cassarole">
    </div>

    <div class="item">
      <img src="smoothie.jpg" alt="Cassarole">
    </div>

    <div class="item">
      <img src="panini.jpg" alt="Cassarole">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
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


      function openTab(event, tabName) {
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
