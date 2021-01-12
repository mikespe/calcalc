<?php
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "weightlog";

$usern = htmlspecialchars($_SESSION["username"]);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
//  echo "connected successfully";
}

$sqlcrdb = "CREATE DATABASE weightlog";
if ($conn->query($sqlcrdb) === TRUE) {
    echo "Database created successfully";
} else {
 //   echo "Error creating database: " . $conn->error;
}


$sqlcrtb = "CREATE TABLE calorie (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
calorie INT(5) NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
username varchar(255) NOT NULL
)";

if ($conn->query($sqlcrtb) === TRUE) {
 //   echo "Table weight created successfully";
} else {
 //   echo "Error creating table: " . $conn->error;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
  if (empty($_REQUEST['calorie'])) {
    $calerror2 = "calories eaten is required!";
  } else {
    $calorie = test_input($_REQUEST['calorie']);
    // insert staement if the bodyweight is present
    $sqlinsert = "INSERT INTO calorie (calorie, username) VALUES ('$calorie', '$usern')";
    if ($conn->query($sqlinsert) === TRUE) {
//    echo "record created successfully";
    } else {
    echo "Error: " . $sqlinsert . "<br>" . $conn->error;
    }

  }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
  <meta name="author" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.17/d3.min.js"></script>
<style>
path.line	{
    fill: none;
    stroke: #000;
}
</style>
</head>
<body>
  <?php include 'header.php'; ?>
  <div class="container">
  <div class="row text-center m-4">
    <div class="col-xs-10 text-center">
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  <fieldset>
    <legend>Calories:</legend>
  <div class="col-xs-12 p-2">Calories Consumed: 
    <input type="number" name="calorie">
      <input type="submit" value="Submit">
    <span class="error">* <?php echo $calerror2; ?></span>
  </div>
</fieldset>
</form>
<hr>
<div class="resultscontainer">
<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "weightlog";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
//  echo "Connected successfully";
}

$sqlselect = "SELECT * FROM calorie WHERE username='$usern' ORDER BY reg_date DESC";

$result = $conn->query($sqlselect);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    $realid = $row["id"];
    echo "<div class='results' id='$realid' style='display:flex;flex-wrap:wrap;'>" . 
    "<p class='entry'>" . 
    "date: " . 
    $row["reg_date"] . 
    " - Calories: " . 
    $row["calorie"] . 
    "</p>" . 
    '<button style="padding-left: 5px;
    padding-bottom: 16px;"" type="button" class="close" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>' . 
"</div>";
    }
} else {
    echo "0 results";
}
$conn->close();

?>  
</div>
<div id="my_dataviz"></div>
</div>
</div>
</div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <script>
$('.close').click(function() {
  let parent = $( this ).parent();
  let id = parent[0].id;
  
  xmlhttp = new XMLHttpRequest();

  /*xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      $('.resultscontainer')[0].innerHTML = this.responseText;
    } else {
      console.log('ready state is not ready for some reason??');
    }}
*/
  xmlhttp.open("POST","delete-calorie.php?q="+id,true);
  xmlhttp.send();
  parent[0].remove();
});
</script>
<script>
var json = []
let entryelements = $('.entry')
$.each(entryelements, function(index, value) {
obj = {datee: value.textContent.slice(6,25), weight: parseInt(value.textContent.slice(-4,).trim())}
json.push(obj)
})
var data = json


// Set the dimensions of the canvas / graph
var margin = {top: 30, right: 20, bottom: 30, left: 50},
    width = 500 - margin.left - margin.right,
    height = 400 - margin.top - margin.bottom;

// Parse the date / time
var parseDate = d3.time.format("%Y-%m-%d %H:%M:%S").parse;

// Set the ranges
var x = d3.time.scale().range([0, width]);
var y = d3.scale.linear().range([height, 0]);

// Define the axes
var xAxis = d3.svg.axis().scale(x)
    .orient("bottom").ticks(7);

var yAxis = d3.svg.axis().scale(y)
    .orient("left").ticks(7);

// Define the line
var valueline = d3.svg.line()
    .x(function(d) { return x(d.datee); })
    .y(function(d) { return y(d.weight); });
    
// Adds the svg canvas
var svg = d3.select("#my_dataviz")
    .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
    .append("g")
        .attr("transform", 
              "translate(" + margin.left + "," + margin.top + ")");

// Get the data

//d3.csv("data.csv", function(error, data) {
   data.forEach(function(d) {
        d.datee = parseDate(d.datee);
        d.weight = d.weight;
    });

    // Scale the range of the data
    x.domain(d3.extent(data, function(d) { return d.datee; }));
    y.domain([300, d3.max(data, function(d) { return d.weight; })]);

    // Add the valueline path.
    svg.append("path")
        .attr("class", "line")
        .attr("d", valueline(data));
        console.log(valueline(data));

    // Add the X Axis
    svg.append("g")
        .attr("class", "x axis")
        .attr("transform", "translate(0," + height + ")")
        .call(xAxis);

    // Add the Y Axis
    svg.append("g")
        .attr("class", "y axis")
        .call(yAxis);

//});


  </script>


</body>
</html>
