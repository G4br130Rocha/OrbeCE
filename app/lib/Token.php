<?php
 namespace App\Libs;

 use Exception;

session_start();

 class Token{
    private static $token;
    public static function generateToken(){
        self::$token = bin2hex(openssl_random_pseudo_bytes(16));
        $_SESSION["tokenOrbe"] = self::$token;
        return self::$token;
    }
    public static function checkToken(String $token){
        if($_SESSION["tokenOrbe"] === $token){
            unset($_SESSION["tokenOrbe"]);
            return true;
        }else{
            throw new Exception("Token inválido");
            return false;
        }
    }
 }