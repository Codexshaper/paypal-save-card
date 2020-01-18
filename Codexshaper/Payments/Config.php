<?php

namespace Codexshaper\Payments;

class Config
{
    protected $config = [];

    public function __construct()
    {
        // foreach (glob(__DIR__ . '/Helpers/*.php') as $filename) {
        //           require_once $filename;
        //       }
        $this->config['paypal']   = (include __DIR__ . '../../config/paypal.php');
        $this->config['database'] = (include __DIR__ . '../../config/database.php');
    }

    public function get($config, $default = null)
    {
        $keys     = explode('.', $config);
        $filename = array_shift($keys);
        $data     = $this->config[$filename];

        foreach ($keys as $key) {
            if (is_array($data) && array_key_exists($key, $data)) {
                $data = $data[$key];
            } else {
                $data = null;
            }
        }

        if (!$data) {
            $data = $default;
        }

        return $data;
    }
}
