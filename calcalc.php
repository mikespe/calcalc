<?php

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function malecal($bw, $inches, $yrs, $activity) {
  $bw2 = 6.3 * $bw;
  $inches2 = 12.9 * $inches;
  $yrs2 = 6.8 * $yrs;
  $malecal = 66 + $bw2 + $inches2 - $yrs2;
  $malecal2 = round($malecal * $activity);
  echo "Calorie to Maintain Weight:" . $malecal2;;
}

function femalecal($bw, $inches, $yrs, $activity) {
  $bw2 = 4.3 * $bw;
  $inches2 = 4.7 * $inches;
  $yrs2 = 4.7 * $yrs;
  $femalecal = 655 + $bw2 + $inches2 - $yrs2;
  $femalecal2 = round($femalecal * $activity);
  echo "Calorie to Maintain Weight:" . $femalecal2;;
}
?>

<?php 
$bwerror = $incherror = $yrserror = $activityerror = $sexerror = "";
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
  if (empty($_REQUEST['bw'])) {
    $bwerror = "bodyweight in lbs is required!";
  } else {
    $bw = test_input($_REQUEST['bw']);
  }

  if (empty($_REQUEST['inches'])) {
    $incherror = "inches are required!";
  } else {
    $inches = test_input($_REQUEST['inches']);
    }

  if (empty($_REQUEST['yrs'])) {
    $yrserror = "years are required!";
  } else {
    $yrs = test_input($_REQUEST['yrs']);  
  }

  if (empty($_REQUEST['activity'])) {
    $activityerror = "choose an activity!";
  } else {
    $activity = test_input($_REQUEST['activity']);  
  }

  if (empty($_REQUEST['sex'])) {
    $sexerror = "Choose if your Male or Female!";
  } else {
    $sex = test_input($_REQUEST['sex']);
  }
}
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
<style>
  .error {
    color:red;
    font-size:12px;
  }
</style>
<div class="row">
  <div class="col-xs-12 m-4">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
      <fieldset>
        <legend>Calorie Calculator</legend>
  <div class="col-xs-12 p-2">Body Weight (lbs): <input type="number" name="bw"><span class="error">* <?php echo $bwerror; ?></span></div>
  <div class="col-xs-12 p-2">Height (in) : <input type="number" name="inches"><span class="error">* <?php echo $incherror; ?></span></div>
  <div class="col-xs-12 p-2">Age (yrs) : <input type="number" name="yrs"><span class="error">* <?php echo $yrserror; ?></span></div>
  <div class="col-xs-12 p-2">Activity Level: <select name="activity" size="5">
  <option value="1.2">Sedentary</option>
  <option value="1.375">Lightly Active</option>
  <option value="1.55">Moderate</option>
  <option value="1.725">Very Active</option>
  <option value="1.9">Extra</option>
</select><span class="error">* <?php echo $activityerror; ?></span></div>
<div class="col-xs-12 p-2">Male or Female: <select name="sex" size="2">
  <option value="Male">Male</option>
  <option value="Female">Female</option>
</select><span class="error">* <?php echo $sexerror; ?></span></div>
  <input type="submit" value="Submit">
  </fieldset>
</form>
  </div>
</div>
<h2 class="col-xs-12 p-2">
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if ($sex == "Male") {
  malecal($bw, $inches, $yrs, $activity);
  } else {
  femalecal($bw, $inches, $yrs, $activity);
  }
}
 ?>
</h2>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
