<?php
 namespace App\Controllers;
 
 require __DIR__."../../lib/Alert.php";
 require __DIR__."../../lib/Token.php";
 require __DIR__."../../lib/Request.php";
 require __DIR__."../../DIO/AuthDIO.php";
 
 use App\Libs\Alert;
 use App\Libs\Token; 
 use App\Libs\Request;
 use App\DIOS\Auth;
 use Exception;

 class Login extends Controller{
    /*
     * @param array $data
    */
    public function login($data){
        /*
         * @param array $data 
         * @param String $view
        */
        $data["token"] = Token::generateToken();
        $data["alert"] = Alert::getAlert();
        Alert::destroyAlert();
        $this->view = "login";
        Controller::engine($data, $this->view);
    }
    /*
     * @param array $data
    */
    public function auth($data){
        try{
            $request = new Request();
            Token::checkToken($request->all()->token);
            $auth = new Auth();
            $auth->authenticate($request);
            $this->router->redirect("/");
        }catch(Exception $e){
            Alert::createAlert($e->getMessage());
            $this->router->redirect("/login/loginOrbe");
        }
    }
 }