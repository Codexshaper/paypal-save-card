<?php
require_once 'vendor/autoload.php';

if (isset($_POST['charge_card'])) {

    $id     = $_POST['card_id'];
    $amount = $_POST['amount'];

    $db = \Codexshaper\DB::getInstance();

    $cardSql = "SELECT * FROM `cards` WHERE `id` = :id";

    $cardQuery = $db->prepare($cardSql);
    $cardQuery->bindparam(':id', $id);
    $cardQuery->execute();
    $card = $cardQuery->fetch(PDO::FETCH_OBJ);

    $options = [
        'card'     => $card->card_id,
        'amount'   => $amount,
        'currency' => $card->currency,
        'intent'   => 'sale',
        'method'   => 'credit_card',
    ];
    // Charge Payment
    $payment = new \Codexshaper\Payments\Payment;
    $payment = $payment->charge($options);

    //Get Charge details
    $transactions = $payment->getTransactions();
    $related      = $transactions[0]->getRelatedResources()[0];
    $sale         = $related->getSale();
    $fee          = $sale->getTransactionFee()->getValue();
    $total        = $sale->getAmount()->getTotal();
    $deposit      = $total - $fee;
    $creditCard   = \Codexshaper\Payments\CreditCard::get($card->card_id);

    // Store Charge Details

    $sql = "INSERT INTO payments(
    			payment_id,
    			card_id,
    			method,
    			status,
    			amount,
    			deposit,
    			charge,
    			created_at,
    			updated_at
    		)
    		VALUES(
    			:payment_id,
    			:card_id,
    			:method,
    			:status,
    			:amount,
    			:deposit,
    			:charge,
    			:created_at,
    			:updated_at
    		)";

    $query = $db->prepare($sql);

    $query->bindValue(':payment_id', $payment->getId());
    $query->bindValue(':card_id', $creditCard->getType());
    $query->bindValue(':method', $creditCard->getNumber());
    $query->bindValue(':status', $sale->getState());
    $query->bindValue(':amount', $total);
    $query->bindValue(':deposit', $deposit);
    $query->bindValue(':charge', $fee);
    $query->bindValue(':created_at', $sale->getCreateTime());
    $query->bindValue(':updated_at', $sale->getUpdateTime());

    try {
        $query->execute();
        header('Location: http://localhost/paypal/pay.php');
    } catch (\PDOException $ex) {
        die($ex->getMessage());
    }

}
