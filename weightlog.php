<?php
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "weightlog";

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


$sqlcrtb = "CREATE TABLE weight (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
weight INT(3) NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sqlcrtb) === TRUE) {
 //   echo "Table weight created successfully";
} else {
 //   echo "Error creating table: " . $conn->error;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
  if (empty($_REQUEST['bw'])) {
    $bwerror2 = "bodyweight in lbs is required!";
  } else {
    $bw2 = test_input($_REQUEST['bw']);
    // insert staement if the bodyweight is present
    $sqlinsert = "INSERT INTO weight (weight) VALUES ($bw2)";
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
</head>
<body>
  <div class="container">
  <div class="row text-center m-4">
    <div class="col-xs-10 text-center">
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  <fieldset>
    <legend>Body Weight (lbs):</legend>
  <div class="col-xs-12 p-2">Body Weight (lbs): 
    <input type="number" name="bw">
      <input type="submit" value="Submit">
    <span class="error">* <?php echo $bwerror2; ?></span>
  </div>
</fieldset>
</form>
<hr>
<div class="resultscontainer">
<?php
// Create connection
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "weightlog";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
//  echo "Connected successfully";
}

$sqlselect = "SELECT * FROM weight";

$result = $conn->query($sqlselect);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    $realid = $row["id"];
    echo "<div class='results' id='$realid' style='display:flex;flex-wrap:wrap;'>" . 
    "<p class='entry'>" . 
    "date: " . 
    $row["reg_date"] . 
    " - Weight: " . 
    $row["weight"] . 
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
  xmlhttp.open("POST","delete-weight.php?q="+id,true);
  xmlhttp.send();
  parent[0].remove();
});
</script>
</body>
</html>
