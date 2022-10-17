<?php

namespace TopSystem\UCenter\Services;

use Closure;
use Omnipay\Common\GatewayFactory;
use Omnipay\Common\Helper;
use Omnipay\Common\CreditCard;

class PaymentService {
    /**
     * The array of resolved queue connections.
     *
     * @var array
     */
    protected $gateways = [];

    /**
     * The current gateway to use
     * @var string
     */
    protected $gateway;

    /**
     * Omnipay Factory Instance
     * @var \Omnipay\Common\GatewayFactory
     */
    protected $factory;

    /**
     * The Guzzle client to use (null means use default)
     * @var \Guzzle\Http\Client|null
     */
    protected $httpClient = null;


    public function __construct()
    {
        $this->factory = new GatewayFactory;

    }

    /**
     * Get an instance of the specified gateway
     * @param  index of config array to use
     * @return Omnipay\Common\AbstractGateway
     */
    public function gateway($name = null)
    {
        $name = $name ?: $this->getGateway();

        if ( ! isset($this->gateways[$name]))
        {
            $this->gateways[$name] = $this->resolve($name);
        }

        return $this->gateways[$name];
    }

    public function getGateway()
    {
        if(!isset($this->gateway))
        {
            $this->gateway = $this->getDefault();
        }
        return $this->gateway;
    }

    public function setGateway($name)
    {
        $this->gateway = $name;
    }

    protected function getDefault()
    {
        return config("payment.default");
    }

    public function setHttpClient($httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getHttpClient()
    {
        return $this->httpClient;
    }

    protected function getConfig($name)
    {
        return config("payment.gateways.{$name}");
    }

    public function creditCard($cardInput)
    {
        return new CreditCard($cardInput);
    }



    protected function resolve($name)
    {
        $config = $this->getConfig($name);

        if(is_null($config))
        {
            throw new \UnexpectedValueException("Gateway [$name] is not defined.");
        }

        $gateway = $this->factory->create($config['driver'], $this->getHttpClient());

        $class = trim(Helper::getGatewayClassName($config['driver']), "\\");

        $reflection = new \ReflectionClass($class);

        foreach($config['options'] as $optionName=>$value)
        {
            $method = 'set' . ucfirst($optionName);

            if ($reflection->hasMethod($method)) {
                $gateway->{$method}($value);
            }
        }

        return $gateway;
    }

    public function __call($method, $parameters)
    {
        $callable = [$this->gateway(), $method];

        if(method_exists($this->gateway(), $method))
        {
            return call_user_func_array($callable, $parameters);
        }

        throw new \BadMethodCallException("Method [$method] is not supported by the gateway [$this->gateway].");
    }


}
