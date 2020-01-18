<?php

namespace Codexshaper\Payments;

use Codexshaper\Payments\Config;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class Context extends ApiContext
{
    protected $context = null;

    public function __construct()
    {
        $config        = new Config;
        $client_id     = $config->get('paypal.client_id');
        $client_secret = $config->get('paypal.client_secret');
        $mode          = $config->get('paypal.mode');
        $log           = $config->get('paypal.log');
        $LogEnabled    = $config->get('paypal.log.LogEnabled');
        $FileName      = $config->get('paypal.log.FileName');
        $LogLevel      = $config->get('paypal.log.LogLevel');

        parent::__construct(
            new OAuthTokenCredential(
                $client_id, // ClientID
                $client_secret // ClientSecret
            )
        );

        $this->setConfig(
            array(
                "mode"           => $mode,
                'log.LogEnabled' => $LogEnabled,
                'log.FileName'   => $FileName,
                'log.LogLevel'   => $LogLevel,
            )
        );
    }
}
