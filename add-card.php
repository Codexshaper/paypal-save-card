<?php
require_once 'store.php';
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
		  	<a href="http://localhost/paypal" class="btn btn-info my-3">Home</a>
		  	<a href="http://localhost/paypal/pay.php" class="btn btn-success my-3">Pay</a>
		    <form method="POST" action="store.php">
		    	<div class="form-group">
		    		<label for="first_name">First Name</label>
		    		<input type="text" name="first_name" class="form-control" placeholder="Enter first name">
		    	</div>
		    	<div class="form-group">
		    		<label for="last_name">Last Name</label>
		    		<input type="text" name="last_name" class="form-control" id="last_name" placeholder="Enter last name">
		    	</div>
		    	<div class="form-group">
		    		<label for="card_number">Card Number</label>
		    		<input type="text" name="card_number" class="form-control" id="card_number" placeholder="Enter your card">
		    	</div>
		    	<div class="form-group">
		    		<label for="type">Type</label>
		    		<select name="type" id="type" class="form-control">
		    			<option value="visa">VISA</option>
		    			<option value="mastercard">Master Card</option>
		    			<option value="amex">AMEX</option>
		    			<option value="discover">Discover</option>
		    			<option value="maestro">Maestro</option>
		    		</select>
		    	</div>
		    	<div class="form-group">
		    		<label for="expire_month">Expire Month</label>
		    		<input type="text" name="expire_month" class="form-control" id="expire_month" placeholder="Enter Expire Month">
		    	</div>
		    	<div class="form-group">
		    		<label for="expire_year">Expire Year</label>
		    		<input type="text" name="expire_year" class="form-control" id="expire_year" placeholder="Enter Expire Year">
		    	</div>
		    	<div class="form-group">
		    		<label for="cvv2">CVV2</label>
		    		<input type="text" name="cvv2" class="form-control" id="cvv2" placeholder="Enter your CVV2">
		    	</div>
		    	<div class="form-group">
		    		<label for="currency">Currency</label>
		    		<select name="currency" id="currency" class="form-control">
		    			<option value="USD">USD</option>
		    			<option value="EUR">EUR</option>
		    			<option value="GBP">GBP</option>
		    		</select>
		    	</div>
		    	<div class="form-group">
		    		<label for="billing_address"><input type="checkbox" name="billing_address" id="billing_address" placeholder="Enter your Address"> Billing Address</label>
		    		<div class="billing_address_box" style="border: 1px solid #17a2b8; padding: 15px; display: none;">
		    			<div class="form-group">
		    				<label for="address_line_1">Address</label>
		    				<input type="text" name="address_line_1" class="form-control" id="address_line_1" placeholder="Enter Address">
		    			</div>
		    			<div class="form-group">
		    				<label for="city">City</label>
		    				<input type="text" name="city" class="form-control" id="city" placeholder="Enter Address">
		    			</div>

		    			<div class="form-group">
		    				<label for="state">State</label>
		    				<input type="text" name="state" class="form-control" id="state" placeholder="Enter State">
		    			</div>

		    			<div class="form-group">
		    				<label for="postal_code">Postal Code</label>
		    				<input type="text" name="postal_code" class="form-control" id="postal_code" placeholder="Enter Address">
		    			</div>

		    			<div class="form-group">
		    				<label for="phone">Phone</label>
		    				<input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Address">
		    			</div>

		    			<div class="form-group">
		    				<label for="country_code">Country Code</label>
		    				<input type="text" name="country_code" class="form-control" id="country_code" placeholder="Enter Country">
		    			</div>
		    		</div>
		    	</div>

		    	<input type="submit" name="add_card" class="btn btn-success" value="Add Card">
		    </form>
		  </div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script>
		$(function(){
			$("#billing_address").on("change", function(){
				console.log("change");
				$(".billing_address_box").toggleClass("active");
				$(".billing_address_box").hide("slow");
				$(".billing_address_box.active").show("slow");
			});
		});
	</script>
</body>
</html>
