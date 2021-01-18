<?php
include '../app/config.php';
$q = $_REQUEST["q"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to delete a record
$sql = "DELETE FROM weight WHERE id=$q";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}
/*
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
*/
$conn->close();
?>
