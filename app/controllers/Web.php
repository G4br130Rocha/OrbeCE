<?php
namespace App\Controllers;


class Web extends Controller{
    /*
     * @param array $data
    */
    public function home($data){
        /*
         * @param array $data 
         * @param String $view
        */
        $this->view = "web";
        $this->tamplate = "dashboard";
        Controller::engine($data, $this->view,$this->tamplate);
    }
    /*
     * @param array $data
    */
    public function error($data){
        $this->view = "error";
        Controller::engine($data,$this->view);
    }
    /*
     * 
    */
    public function redirect(){
       $this->router->redirect("/home");
    }
}