<?php
require_once 'vendor/autoload.php';
$db = \Codexshaper\DB::getInstance();

$sql   = "SELECT * FROM `cards`";
$query = $db->prepare($sql);
$query->execute();
$cards = $query->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Paypal Card payment</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<div class="card mt-5 mx-auto" style="width: 50rem;">
		  <div class="card-body">
		  	<h3 class="card-title">Pay from saved card</h3>
		  	<a href="http://localhost/paypal" class="btn btn-info my-3">Home</a>
		  	<a href="http://localhost/paypal/add-card.php" class="btn btn-success my-3">Add New Card</a>
		    <form method="POST" action="charge.php">
		    	<div class="form-group">
		    		<label for="card_id">Card</label>
		    		<select name="card_id" id="card_id" class="form-control">
		    			<?php foreach ($cards as $card): ?>
		    				<option value="<?php echo $card->id ?>"><?php echo $card->card_number; ?></option>
		    			<?php endforeach;?>
		    		</select>
		    	</div>

				<div class="form-group">
		    		<label for="amount">Amount</label>
		    		<input type="text" name="amount" class="form-control" placeholder="Enter first name">
		    	</div>

		    	<input type="submit" name="charge_card" class="btn btn-success" value="Pay">
		    </form>
		  </div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>
