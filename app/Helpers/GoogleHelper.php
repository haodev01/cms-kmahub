<?php

namespace App\Helpers;

use Google\Exception;
use Google_Client;
use Google_Service_Oauth2;

class GoogleHelper
{
    public $client;
    public $response_code;

    /**
     * @throws Exception
     */

    public function __construct($code = null)
    {
        $this->client = $this->getConfig();
        if (!empty($code)) {
            $this->response_code = $code;
        }
    }

    public function getConfig(): Google_Client
    {
        $client = new Google_Client();
        $client->setAuthConfig(base_path('secrets/google/auth_client_secret.json'));
        return $client;
    }

    public function configAuthorization()
    {
        $this->client->addScope(['email', 'profile']);
        $this->client->setAccessType('offline');
        $this->client->setIncludeGrantedScopes(true);
        return $this->client;
    }

    public function getUrlAuthentication($callback = null)
    {
        $this->configAuthorization();
        $this->client->setRedirectUri($callback ?: env('GOOGLE_AUTH_CALLBACK_URL', route('admin.loginViaGoogle')));
        return $this->client->createAuthUrl();
    }

    public function getProfile()
    {
        $this->configAuthorization();
        $token_data = $this->client->fetchAccessTokenWithAuthCode($this->response_code);
        $google_oauth = new Google_Service_Oauth2($this->client);
        return [
            'email' => $google_oauth->userinfo->get()->email,
            'token' => $token_data
        ];
    }
}
