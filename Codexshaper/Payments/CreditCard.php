<?php

namespace Codexshaper\Payments;

use Codexshaper\Payments\Context;
use PayPal\Api\CreditCard as BaseCreditCard;
use PayPal\Exception\PayPalConnectionException;

class CreditCard extends BaseCreditCard
{
    protected $context;

    public function __construct(array $options = [])
    {
        $this->context = new Context;
    }

    public function store()
    {
        try {
            // Store card in vault and return card details
            return $this->create($this->context);

        } catch (PayPalConnectionException $ex) {
            throw new \Exception($ex->getData(), 1);
        }
    }

    public function update($patchRequest, $apiContext = null, $restCall = null)
    {
        return parent::update($patchRequest, $this->context, $restCall);
    }

    public static function get($creditCardId, $apiContext = null, $restCall = null)
    {
        return parent::get($creditCardId, new Context, $restCall);
    }

    public function delete($apiContext = null, $restCall = null)
    {
        return parent::delete($this->context, $restCall);
    }

    public static function all($params, $apiContext = null, $restCall = null)
    {
        return parent::all($params, new Context, $restCall);
    }
}
