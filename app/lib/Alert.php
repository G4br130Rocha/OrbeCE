<?php
 namespace App\Libs;
 class Alert{
    /*
     * @param $message
    */
     public static function createAlert(String $message) : void{ 
        session_start();
        $_SESSION["alert"] = $message;
     }
     /*
      * @return $_SESSION["alert"]
     */
    public static function getAlert(){
        if(!isset($_SESSION["alert"])){
            return null;
        }else{
            return $_SESSION["alert"];
        }
    }
     /*
      * @return true
     */
    public static function destroyAlert(){
        if(isset($_SESSION["alert"])){
            unset($_SESSION["alert"]);
            return true;
        }
    }
 }