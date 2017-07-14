<?php

namespace Kazoo\AuthToken;

use \stdClass;

use \Kazoo\SDK;
use \Kazoo\AuthToken\PhpSessionHandler as PhpSessionHandler;
use \Kazoo\AuthToken\SessionHandler as SessionHandler;

/**
 *
 */
class Manual implements AuthTokenInterface
{

    /**
     *
     * @var string auth_token
     */
    private static $auth_token;

    /**
     *
     * @var string account_id
     */
    private static $account_id;

    /**
     *
     * @var SDK
     */
    private $sdk;

    /**
     * @var SessionHandler
     *
     * Handler for saving auth token to the session
     */
    private $sessionHandler = null;

    /**
     * __construct
     *
     * @param string $auth_token
     * @param string $account_id
     * @return AuthToken\Manual
     */
    public function __construct($auth_token, $account_id = null, $sessionHandler=null){
        if ($sessionHandler == null)
            $this->sessionHandler = new PhpSessionHandler();
        else
            $this->sessionHandler = $sessionHandler;
        $this->sessionHandler->sessionStart();
        $this->setToken($auth_token);
        $this->setAccountId($account_id);
        $this->sessionHandler->put('Kazoo.AuthToken.Manual', $auth_token);
    }


    /**
     *
     * @return null|SDK
     */
    public function getSDK() {
        return $this->sdk;
    }

    /**
     *
     * @param SDK
     */
    public function setSDK(SDK $sdk) {
        $this->sdk = $sdk;
    }

    /**
     *
     * @return string
     */
    public function setAccountId($account_id) {
        $this->account_id = $account_id;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getAccountId() {
        return $this->account_id;
    }

    /**
     * setToken
     *
     * @param mixed $token
     * @return AuthToken\Manual
     */
    public function setToken($token){
        $this->auth_token = $token;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getToken() {
        return $this->auth_token;
    }

    /**
     *
     *
     */
    public function reset() {
        if ($this->sessionHandler->isValueSet('Kazoo.AuthToken.Manual')) {
            $this->sessionHandler->forget('Kazoo.AuthToken.Manual');
        }
    }
}
