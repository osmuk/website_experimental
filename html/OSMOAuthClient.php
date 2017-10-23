<?php
require_once('/home/www-data/oauthinc.php');

class OSMOAuthClient {

    private $oauth;

    public function __construct() {
        $this->oauth = new OAuth (OAUTH_CONSUMER_KEY, OAUTH_CONSUMER_SECRET);
        $this->user = false;
    }

    public function login()  {
        if($requestToken = $this->oauth->getRequestToken
                ("https://www.openstreetmap.org/oauth/request_token")) {
            $_SESSION['request_secret'] = $requestToken['oauth_token_secret'];
            header("Location: https://www.openstreetmap.org/oauth/authorize?".
                    "oauth_token=$requestToken[oauth_token]");
        } else {
            throw new OAuthException("Could not obtain a request token: ". 
                $this->oauth->getLastResponse());
        }
    }

    public function getAccessToken($oauth_token, $secret)  {
        $this->oauth->setToken($oauth_token, $secret);
        $at=$this->oauth->getAccessToken('https://www.openstreetmap.org/'.
                                                'oauth/access_token');
        if($at) {
            return $at; 
        } else {
            throw new OAuthException("Could not exchange tokens: ". 
                    $this->oauth->getLastResponse());
        }
    }

    public function setToken ($token, $secret) {
        $this->oauth->setToken ($token, $secret);
    }

    public function getUser() {
        $this->oauth->fetch
            ("https://api.openstreetmap.org/api/0.6/user/details");
        $response = simplexml_load_string($this->oauth->getLastResponse());
        return $response->user->attributes()["display_name"]; 
    }
}
?>
