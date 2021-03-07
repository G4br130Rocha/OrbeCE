<?php
 namespace App\Controllers;
 
 require __DIR__."../../lib/Alert.php";
 require __DIR__."../../lib/Token.php";
 require __DIR__."../../lib/Request.php";
 require __DIR__."../../DIO/AdminDIO.php";
 
 use App\Libs\Alert;
 use App\Libs\Token; 
 use App\Libs\Request;
 use App\DIOS\AdminDIO;
 use Exception;
 class Cadastro extends Controller{

    /*
     * @param array $data
    */
    public function register($data){
        /*
         * @param array $data 
         * @param String $view
        */
        $data["token"] = Token::generateToken();
        $data["alert"] = Alert::getAlert();
        Alert::destroyAlert();
        $this->view = "register";
        Controller::engine($data, $this->view);
    }
    /*
     * @param array $data
    */
    public function create($data){
        try{
            $request = new Request();
            Token::checkToken($request->all()->token);
            $admin = new AdminDIO();
            $admin->createAdmin($request);
            $this->router->redirect("/");
        }catch(Exception $e){
            Alert::createAlert($e->getMessage());
            $this->router->redirect("/cadastrar/adminOrbe");
        }
    }
 }