
<!DOCTYPE html>
<html>
<head>
  <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</script>
  <meta charset="utf-8">
  <title></title>
  <meta name="author" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
  <div class="container">
<div class="row">
  <div class="col-xs-12 text-center">
    <form class="mainform" method="get">
  <fieldset>
    <legend>Nutrition Search:</legend>
  <div class="col-xs-12 p-2">Enter a Food: 
    <input class="maininput" type="search" name="foodsearch">
      <input type="submit" value="Submit">
    <span class="error">* <?php echo $fooderror; ?></span>
  </div>
</fieldset>
</form>

<div class="results">
  </div>

  </div>
</div>
</div>
<script>
  $(".mainform").submit(function(e) {
  e.preventDefault();
  let str = $('.maininput').val();
  var querystr = 'https://api.nal.usda.gov/fdc/v1/search?api_key=ffm9P5caEuLE7aUT7l2OttpQ68hCEId9rS6TT08H&generalSearchInput='+str;
  //console.log('i was submitted')
  $.get(querystr, function(results) {
    $('.results').empty();
  for (i=0; i < 10; i++) {
    let fdcid = results.foods[i].fdcId;
    $('.results').append('<p id='+'"'+fdcid+'"'+ ' class=fooditem' +'>' + results.foods[i].allHighlightFields + '</p>');
  }

  })
});

$('.results').on('click', '.fooditem' , function() {
  //console.log(this.id);
  let selectedid = this.id;
  var detailsquery = 'https://api.nal.usda.gov/fdc/v1/'+selectedid+'?api_key=ffm9P5caEuLE7aUT7l2OttpQ68hCEId9rS6TT08H';

  $.get(detailsquery, function(results) {
  console.log(results);
  $('.results').empty();
  let servingsize = results.servingSize;
  let servingunit = results.servingSizeUnit
  let servingdescrip = results.householdServingFullText;
  for(i = 0; i < results.foodNutrients.length; i++) {
    if(results.foodNutrients[i].nutrient.name == 'Protein') {
      $('.results').append(
    '<p>Protein =' + results.foodNutrients[i].amount + 'grams</p>')
    } else if (results.foodNutrients[i].nutrient.name == 'Total lipid (fat)') {
      $('.results').append(
    '<p>Fat =' + results.foodNutrients[i].amount + 'grams</p>')
    } else if (results.foodNutrients[i].nutrient.name == 'Carbohydrate, by difference') {
    $('.results').append(
    '<p>Carbs =' + results.foodNutrients[i].amount + 'grams</p>')
    }
  }
  //console.log(results.householdservingFullText);
    $('.results').append(
    '<p>Serving Info =' + servingsize + servingunit + '<br>'+ servingdescrip +' </p>')
  })
})
  
</script>

</body>
</html>