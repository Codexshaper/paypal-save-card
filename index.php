<?php
require_once 'vendor/autoload.php';

$db    = \Codexshaper\DB::getInstance();
$sql   = "SELECT * FROM cards";
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
		<div class="card mt-5 mx-auto">
		  <div class="card-body">
		  	<a href="http://localhost/paypal/add-card.php" class="btn btn-success my-3">Add New Card</a>
		  	<a href="http://localhost/paypal/pay.php" class="btn btn-success my-3">Pay</a>
		  	<?php if (count($cards) > 0): ?>
			<table class="table table-bordered">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">First Name</th>
			      <th scope="col">Last Name</th>
			      <th scope="col">Card Number</th>
			      <th scope="col">Card Type</th>
			      <th scope="col">Currency</th>
			      <th scope="col">Expire Month</th>
			      <th scope="col">Expire Year</th>
			      <th scope="col">Billing Address</th>
			      <th scope="col">Created At</th>
			      <th scope="col">Updated At</th>
			    </tr>
			  </thead>
			  <tbody>
<?php
foreach ($cards as $key => $card):
?>
			    <tr>
			      <th scope="row"><?php echo $key + 1 ?></th>
			      <td><?php echo $card->first_name ?></td>
			      <td><?php echo $card->last_name ?></td>
			      <td><?php echo $card->card_number ?></td>
			      <td><?php echo $card->type ?></td>
			      <td><?php echo $card->currency ?></td>
			      <td><?php echo $card->expire_month ?></td>
			      <td><?php echo $card->expire_year ?></td>
			      <td><?php echo $card->billing_address ?></td>
			      <td><?php echo $card->created_at ?></td>
			      <td><?php echo $card->updated_at ?></td>
			    </tr>
			    <?php endforeach;?>
			  </tbody>
			</table>
			<?php else: ?>
				<p>There is no card</p>
			<?php endif;?>
		  </div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>
