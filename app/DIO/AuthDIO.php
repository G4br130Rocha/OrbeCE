<?php
 namespace App\DIOS;

 require __DIR__."../../lib/Connection.php";
use App\Libs\Conn;
use App\Libs\Request;
use App\Models\UserModel;
use Exception;

class Auth extends UserModel{
    /*
     * @param Request $request
     * @return SESSION $_SESSION["id_user"] 
    */ 
    public function authenticate(Request $request){
        $this->setEmail($request->all()->email);
        $this->setPassword($request->all()->password);
        $sql = "SELECT * FROM users WHERE email = ?";
        $stm = Conn::getConn()->prepare($sql);
        $stm->bindValue(1,$this->getEmail());
        $stm->execute();
        $stm->setFetchMode(\PDO::FETCH_CLASS,__CLASS__);
        $user = $stm->fetch();

        if(!password_verify($this->getPassword(),$user->password)){
            throw new Exception("Login Invalido");
            return false;
        }
        return $this->createSession($user->id);
    }
    /*
     * @param ID_user $id
     * @return SESSION $_SESSION["id_user"] 
    */ 
    private function createSession($id){
        if(!$_SESSION["id_user"] || $_SESSION["id_user"]){
            session_start();
            $_SESSION["id_user"] = $id;
            return true;
        }else{
            throw new Exception("Erro ao criar sessão");
            return false;
        }
    }


 }