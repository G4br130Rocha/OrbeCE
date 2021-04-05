<?php
namespace App\Controllers;


use CoffeeCode\Router\Router;
/*
* Abstrac cass of controllers
*/ 

abstract class Controller{
    protected $router;
    private String $view;
    public String $tamplate;

    public function __construct($router)
    {
        $this->router = $router;
    }
    public function engine(array $param,String $view ,String $tamplate = "html") : void{
            /*
             * @var HTML $tam Tamplate
            */
            $tam = file_get_contents(dirname(__DIR__,1)."/view/tamplate/".$tamplate.".html");
            /*
             * Twig
            */ 
            $loader = new \Twig\Loader\FilesystemLoader("app/view/web");
            $twig = new \Twig\Environment($loader);
            $tamplate = $twig->load($view.".html");
            $param["URL"] = URL;
            $conteudo = $tamplate->render($param);

            echo str_replace("{{container.dinamic}}",$conteudo,$tam);
    }
}