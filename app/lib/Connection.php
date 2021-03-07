<?php
    namespace App\Libs;
    class Conn{
        private static $instance;

        public static function getConn(){
            if(!isset(self::$instance)){
                self::$instance = new \PDO("".BD["DRIVER"].":host=".BD["HOST"].";dbname=".BD["DBNAME"],BD["USER"],BD["PASSWORD"]);
            }
            return self::$instance;
        }
    }