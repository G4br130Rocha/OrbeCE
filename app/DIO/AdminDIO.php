<?php
    namespace App\DIOS;

    require __DIR__."../../lib/Connection.php";
use App\Libs\Conn;
use App\Models\AdminModel;
use App\Libs\Request;
use Exception;

class AdminDIO{
    private AdminModel $admin;
    /*
     * Create Admin
    */ 
    public function createAdmin(Request $request)
    {
        $this->admin = new AdminModel();
        $this->admin->setSobrenome($request->all()->sobrenome);
        $this->admin->setNome($request->all()->nome);
        $this->admin->setEmail($request->all()->email);
        $this->admin->setPassword(password_hash($request->all()->password, PASSWORD_DEFAULT));
        $this->admin->setDepartamento($request->all()->departamento);
        
        /*
         * Check e-mail
        */
        $this->checkEmail($this->admin);

        $id_user = $this->createUser($this->admin);
        $this->admin->setIdUser($id_user);
        $sql = 'INSERT INTO admins(id_user,departamento) VALUES( ?, ?)';
        $stm = Conn::getConn()->prepare($sql);
        $stm->bindValue(1,$this->admin->getIdUser());
        $stm->bindValue(2,$this->admin->getDepartamento());
        $res = $stm->execute();
        if(!$res){
            throw new Exception("Falha ao cadastrar Admin");
            return false;
        }
        return true;
    }
    /*
     * Create User
    */ 
    private function createUser(AdminModel $admin){
        $sql = 'INSERT INTO users(nome, sobrenome, email, password) VALUES( ?, ?, ?, ?)';
        $bd = Conn::getConn();
        $stm = $bd->prepare($sql);
        $stm->bindValue(1,$admin->getNome());
        $stm->bindValue(2,$admin->getSobrenome());
        $stm->bindValue(3,$admin->getEmail());
        $stm->bindValue(4,$admin->getPassword());
        $res = $stm->execute();
        // $ultimo_id = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$res){
            throw new Exception("Falha ao cadastrar usuário");
            return false;
        }


         return $bd->lastInsertId();
    }
    /*
     * Checking E-mail
    */ 
    private function checkEmail(AdminModel $admin){
        $sql = 'SELECT * FROM users WHERE email = ?';
        $stm = Conn::getConn()->prepare($sql);
        $stm->bindValue(1,$admin->getEmail());
        $stm->execute();
        if(!empty($stm->fetch(\PDO::FETCH_ASSOC))){
            throw new Exception("Esse email já está vinculado a uma conta");
            return false;
        }
        return true;
    }
} 