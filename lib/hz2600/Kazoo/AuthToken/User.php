<?php

namespace Kazoo\AuthToken;

use \stdClass;

use \Kazoo\SDK;
use \Kazoo\AuthToken\PhpSessionHandler as PhpSessionHandler;
use \Kazoo\AuthToken\SessionHandler as SessionHandler;

/**
 *
 */
class User implements AuthTokenInterface
{
    /**
     *
     * @var SDK
     */
    private $sdk;

    /**
     *
     * @var string
     */
    private $username;

    /**
     *
     * @var string
     */
    private $password;

    /**
     *
     * @var string
     */
    private $sipRealm;

    /**
     *
     * @var null|stdClass
     */
    private $auth_response = null;

    /**
     *
     * @var boolean
     */
    private $disabled = false;

    /**
     *
     * @var string
     *
     * Optional value that can be set so that username and password
     * can remain secret
     */
    private $credentials_hash = '';

    /**
     * @var SessionHandler
     *
     * Handler for saving auth token to the session
     */
    private $sessionHandler = null;

    /**
     *
     * @param string $username
     * @param string $password
     * @param string $sipRealm
     */
    public function __construct($username, $password, $sipRealm, $sessionHandler=null) {
        if ($sessionHandler == null)
            $this->sessionHandler = new PhpSessionHandler();
        else
            $this->sessionHandler = $sessionHandler;
        $this->sessionHandler->sessionStart();
        $this->username = $username;
        $this->password = $password;
        $this->sipRealm = $sipRealm;
    }

    /**
     *
     *
     */
    public function __destruct() {
        if (!is_null($this->auth_response)) {
            $this->sessionHandler->put('Kazoo.AuthToken.User', $this->auth_response);
        }
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
    public function getAccountId() {
        $response = $this->getAuthResponse();
        if (isset($response->account_id)) {
            return $response->account_id;
        }
        return "";
    }

    /**
     *
     * @return string
     */
    public function getLoggedInUserId() {
        $response = $this->getAuthResponse();
        if (isset($response->owner_id)) {
            return $response->owner_id;
        }
        return "";
    }

    /**
     *
     * @return string
     */
    public function getToken() {
        $response = $this->getAuthResponse();
        if (isset($response->auth_token)) {
            return $response->auth_token;
        }
        return "";
    }

    /**
     *
     *
     */
    public function reset() {
        $this->auth_response = null;
        if ($this->sessionHandler->isValueSet('Kazoo.AuthToken.User'))
            $this->sessionHandler->forget('Kazoo.AuthToken.User');
    }

    /**
     *
     * @return string
     */
    private function getAuthResponse() {
        if (is_null($this->auth_response)) {
            $this->checkSessionResponse();
        }

        return $this->auth_response;
    }

    /**
     *
     *
     */
    private function checkSessionResponse() {
        if ($this->sessionHandler->isValueSet('Kazoo.AuthToken.User')) {
            $this->auth_response = $this->sessionHandler->get('Kazoo.AuthToken.User');
        } else {
            $this->requestToken();
        }
    }

    /**
     *
     *
     */
    private function requestToken() {
        if ($this->disabled) {
            return new stdClass();
        }

        $payload = new stdClass();
        $payload->data = new stdClass();
        $payload->data->credentials = ($this->credentials_hash == '') ? ($this->username . ":" . $this->password) : $this->credentials_hash;
        $payload->data->realm = $this->sipRealm;

        $sdk = $this->getSDK();
        $tokenizedUri = $sdk->getTokenizedUri($sdk->getTokenUri() . "/user_auth");

        $this->disabled = true;
        $response = $sdk->getHttpClient()->put($tokenizedUri, json_encode($payload));
        $this->disabled = false;

        $this->auth_response = $response->getData();
        $this->auth_response->auth_token = $response->getAuthToken();
    }

    /**
     * @param string $hash
     */
    public function setCredentialsHash($hash) {
        $this->credentials_hash = $hash;
    }
}
