<?php
require_once 'vendor/autoload.php';

if (isset($_POST['add_card'])) {
    $first_name   = $_POST['first_name'];
    $last_name    = $_POST['last_name'];
    $number       = $_POST['card_number'];
    $type         = $_POST['type'];
    $expire_month = $_POST['expire_month'];
    $expire_year  = $_POST['expire_year'];
    $cvv2         = $_POST['cvv2'];
    $currency     = $_POST['currency'];

    // Store data in Paypal voult storage
    $creditCard = new \Codexshaper\Payments\CreditCard;
    $creditCard->setNumber($number);
    $creditCard->setType($type);
    $creditCard->setExpireMonth($expire_month);
    $creditCard->setExpireYear($expire_year);
    $creditCard->setCvv2($cvv2);
    $creditCard->setFirstName($first_name);
    $creditCard->setLastName($last_name);

    if ($_POST['billing_address'] == 'on') {

        $billing_address = new \PayPal\Api\Address;
        $billing_address->setLine1($_POST['address_line_1']);
        $billing_address->setCity($_POST['city']);
        $billing_address->setState($_POST['state']);
        $billing_address->setPostalCode($_POST['postal_code']);
        $billing_address->setPhone($_POST['phone']);
        $billing_address->setCountryCode($_POST['country_code']);

        $creditCard->setBillingAddress($billing_address);
    }

    $creditCard->store();
    // Store Card details
    $db = \Codexshaper\DB::getInstance();

    $sql = "INSERT INTO cards(
					card_id,
					type,
					card_number,
					expire_month,
					expire_year,
					first_name,
					last_name,
					currency,
					billing_address,
					created_at,
					updated_at
			)
			VALUES(
					:card_id,
					:type,
					:card_number,
					:expire_month,
					:expire_year,
					:first_name,
					:last_name,
					:currency,
					:billing_address,
					:created_at,
					:updated_at
			)";

    $query = $db->prepare($sql);

    $query->bindValue(':card_id', $creditCard->getId());
    $query->bindValue(':type', $creditCard->getType());
    $query->bindValue(':card_number', $creditCard->getNumber());
    $query->bindValue(':expire_month', $creditCard->getExpireMonth());
    $query->bindValue(':expire_year', $creditCard->getExpireYear());
    $query->bindValue(':first_name', $creditCard->getFirstName());
    $query->bindValue(':last_name', $creditCard->getLastName());
    $query->bindValue(':currency', $currency);
    $query->bindValue(':billing_address', $creditCard->getBillingAddress());
    $query->bindValue(':created_at', $creditCard->getCreateTime());
    $query->bindValue(':updated_at', $creditCard->getUpdateTime());

    try {
        $query->execute();
        header('Location: http://localhost/paypal/pay.php');
    } catch (\PDOException $ex) {
        die($ex->getMessage());
    }
}
