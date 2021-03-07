<?php

 namespace App\Libs;


class Request{
     private $request;
     public function __construct()
     {
         foreach($_REQUEST as $key => $value){
            $this->request->$key = filter_var($value,FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
         }
     }

     public function all(){
        return $this->request;
     }
 }