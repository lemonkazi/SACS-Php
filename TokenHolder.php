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

    private static $token=null;
    
    public static function getToken() {
        if (TokenHolder::$token == null) {
            $authCall = new Auth();
            TokenHolder::$token = $authCall->callForToken();
        }
        return TokenHolder::$token;
    }
}

