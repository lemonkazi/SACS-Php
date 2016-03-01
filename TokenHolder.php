<?php
include_once 'Auth.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TokenHolder
 *
 * @author SG0946321
 */
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

