<?php
 namespace App\Models;

 abstract class UserModel{
     private int $id;
     private String $nome;
     private String $sobrenome;
     private String $email;
     private String $password;

    /*
      * Sets
      * @param $email
    */
     public function setEmail(String $email) : void{
        $this->email = $email;
     }
    /*
      * @param $password 
    */
     public function setPassword(String $password) : void{
        $this->password = $password;
     }
    /*
      * @param $nome
    */
     public function setNome(String $nome) : void{
        $this->nome = $nome;
     }
     /*
      * @param $sobrenome
    */
     public function setSobrenome(String $sobrenome) : void{
        $this->sobrenome = $sobrenome;
     }

    /*
      * Gets
      * @return $email
    */
     public function getEmail() : String{
        return $this->email;
     }
    /*
      * @return $id
    */
     public function getId(){
        return $this->id;
     }
    /*
      * @return $password 
    */
     public function getPassword() : String{
        return $this->password;
     }
    /*
      * @return $nome
    */
     public function getNome() : String{
        return $this->nome;
     }
     /*
      * @return $sobrenome
    */
     public function getSobrenome() : String{
        return $this->sobrenome;
     }
 }