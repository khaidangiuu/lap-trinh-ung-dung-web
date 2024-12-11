<?php
class App
{
    protected $controller = "TaiKhoanController";
    protected $action = "showLoginForm";
    protected $params = [];

    function __construct()
    {

        $arr = $this->xlurl();


        //xu ly controller
        if (isset($arr[0])) {
            if (file_exists("./app/Controllers/" . $arr[0] . ".php")) {
                $this->controller = $arr[0];
                unset($arr[0]);
            }
            // if (!file_exists("./app/Controllers/" . $arr[0] . ".php")) {
            //     header('Location: ../404.php');
            //     exit();
            // }
        }
        require_once "./app/Controllers/" . $this->controller . ".php";
        $this->controller = new $this->controller;

        //xu ly action
        if (isset($arr[1])) {
            if (method_exists($this->controller, $arr[1])) {
                $this->action = $arr[1];
            }
            unset($arr[1]);
        }
        //xu ly params
        $this->params = $arr ? array_values($arr) : [];

        call_user_func_array([$this->controller, $this->action], $this->params);
    }

    function xlurl()
    {
        if (isset($_GET["url"])) {
            return explode("/",  filter_var(trim($_GET["url"], "/")));
        }
    }
}
