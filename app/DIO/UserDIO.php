<?php
    namespace App\DIOS;

    require __DIR__."../../lib/Connection.php";
use App\Libs\Conn;
use App\Models\UserModel;
use Exception;

class UserDIO extends UserModel{
    private static UserModel $user;
    /*
     * Create User
    */ 
    public static function createUser($user){
        self::$user = $user;
        /*
         * Check E-mail
        */
        self::checkEmail(self::$user);
        
        $sql = 'INSERT INTO users(nome, sobrenome, email, password) VALUES( ?, ?, ?, ?)';
        $bd = Conn::getConn();
        $stm = $bd->prepare($sql);
        $stm->bindValue(1,self::$user->getNome());
        $stm->bindValue(2,self::$user->getSobrenome());
        $stm->bindValue(3,self::$user->getEmail());
        $stm->bindValue(4,self::$user->getPassword());
        $res = $stm->execute();
        
        if(!$res){
            throw new Exception("Falha ao cadastrar usuário");
            return false;
        }


         return $bd->lastInsertId();
    }
    /*
     * Checking E-mail
    */ 
    private static function checkEmail(UserModel $user){
        $sql = 'SELECT * FROM users WHERE email = ?';
        $stm = Conn::getConn()->prepare($sql);
        $stm->bindValue(1,$user->getEmail());
        $stm->execute();
        if(!empty($stm->fetch(\PDO::FETCH_ASSOC))){
            throw new Exception("Esse email já está vinculado a uma conta");
            return false;
        }
        return true;
    }
} 