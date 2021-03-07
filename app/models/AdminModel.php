<?php
 namespace App\Models;

 class AdminModel extends UserModel{
     private int $id;
     private String $departamento;
     private int $id_user;

     /*
      * Sets
      * @param $departamento
     */
    public function setDepartamento(String $departamento) : void{
        $this->departamento = $departamento;
    }
     /*
      * @param $id_user
     */
    public function setIdUser(int $id_user) : void{
        $this->id_user = $id_user;
    }

     /*
      * Gets
      * @return $departamento
     */
    public function getDepartamento() : String{
        return $this->departamento;
    }
     /*
      * @return $id_user
     */
    public function getIdUser() : int{
        return $this->id_user;
    }
     /*
      * @return $id
     */
    public function getId() : int{
        return $this->id;
    }
 }