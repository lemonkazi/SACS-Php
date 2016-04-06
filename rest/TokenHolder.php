<?php
include_once 'rest/Auth.php';

class TokenHolder {

    private static $token = null;
    
    private static $expirationDate = 0;
    
    public static function getToken() {
        
        if (TokenHolder::$token == null || mktime() > TokenHolder::$expirationDate) {
            $authCall = new Auth();
            TokenHolder::$token = $authCall->callForToken();
            TokenHolder::$expirationDate = mktime() + TokenHolder::$token->expires_in;
            
        }
        return TokenHolder::$token;
    }
}

