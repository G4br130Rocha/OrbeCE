<?php
    namespace App\DIOS;

    require __DIR__."../../DIO/UserDIO.php";

    use App\Libs\Conn;
    use App\Models\AdminModel;
    use App\DIOS\UserDIO;
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
        

        $id_user = UserDIO::createUser($this->admin);
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
} 