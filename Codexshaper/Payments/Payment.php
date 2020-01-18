<?php

namespace Codexshaper\Payments;

use Codexshaper\Payments\Context;
use PayPal\Api\Amount;
use PayPal\Api\CreditCardToken;
use PayPal\Api\FundingInstrument;
use PayPal\Api\Payer;
use PayPal\Api\Payment as PaypalPayment;
use PayPal\Api\Transaction;
use PayPal\Exception\PayPalConnectionException;

class Payment extends PaypalPayment
{
    protected $context;
    protected $options = [
        'card'     => '',
        'amount'   => '',
        'currency' => 'USD',
        'intent'   => 'sale',
        'method'   => 'credit_card',
    ];

    public function __construct()
    {
        $this->context = new Context;
    }
    public function charge(array $options)
    {
        // Set options
        $card     = $options['card'];
        $total    = $options['amount'];
        $currency = $options['currency'] ?? $this->options['currency'];
        $intent   = $options['intent'] ?? $this->options['intent'];
        $method   = $options['method'] ?? $this->options['method'];
        // Set creditcard token
        $creditCardToken = new CreditCardToken();
        $creditCardToken->setCreditCardId($card);
        //set fundting instrument
        $fundingInstrument = new FundingInstrument();
        $fundingInstrument->setCreditCardToken($creditCardToken);
        //Set payer
        $payer = new Payer();
        $payer->setPaymentMethod($method);
        $payer->setFundingInstruments(array($fundingInstrument));
        // Set amount
        $amount = new Amount();
        $amount->setCurrency($currency);
        $amount->setTotal($total);
        // Set transaction
        $transaction = new Transaction();
        $transaction->setAmount($amount);
        // Set paymenmt
        $this->setIntent($intent);
        $this->setPayer($payer);
        $this->setTransactions(array($transaction));

        try {
            // Execute paymnet
            $this->create($this->context);
            return $this->get($this->getId(), $this->context);

        } catch (PayPalConnectionException $ex) {
            throw new \Exception($ex->getData(), 1);
        }
    }
}
