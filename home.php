<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Weightloss website</title>
  <meta name="author" content="speranza">
  <meta name="description" content="A Weightloss website explaining the how and providing basic tools to help">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.17/d3.min.js"></script>
	    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
  <?php include 'header.php'; ?>
    <div class="container">
  <div class="row text-center m-4">
    <div class="col-12 text-center">
	        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to the Weight Loss website.</h1>
	       </div>
	<div class="col-12 text-left">
		<p>Weightloss is a tough journey with a lot of incentivized players fighting for your attention and $$$. This website is meant to provide useful unopinionated tools like the <a href="calcalc.php">calorie calculator</a>, <a href="nutrition-search.php">nutrition search</a>, <a href="calorie-log.php">calorie</a> and <a href="weightlog.php">weight log</a> for your journey and to provide high quality nutrition/exercise information to whomever needs it</p>
		<h3>Summary of what is important:</h3>
		<p>Calories in vs Calories out is the most important thing to weight loss</p>

		<p>You burn calories everyday, eat less than you take in to lose, reverse to gain</p>

		<p>Roughly 3500 calories = 1 lb. Aim for 1-1.5% of bodyweight lost per week until your at your goal, then eat at maintenance and enjoy</p>
				<p>Lift weights or provide resistance to muscle to signal to the body to not eat the muscle and eat to the fat instead</p>
		<h3>Useful Links & Resources</h3>
		<ul>
		<li>Nutrition and Bodybuilding science <a href="https://bodyrecomposition.com/" target="new">https://bodyrecomposition.com/</a></li>
		<li>Practical Diet and exercise information <a href="https://leangains.com/" target="new">https://leangains.com/</a></li>
		<li>Nutrition and fasting info <a href="https://bradpilon.com/" target="new">https://bradpilon.com/</a></li>
		<li>Strength and Powerlifting <a href="https://startingstrength.com/" target="new">https://startingstrength.com/</a></li>
		</ul>
		</div>
</div>
		 </div>
  </body>
  </html>
