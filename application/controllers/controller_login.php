<?php
class Controller_Login extends Controller {

    function __construct() {
        $this->model = new Model_Login();
    }
    
    function action_index() {
        $this->model->login($_POST["login"], $_POST["password"]);
        if(isset($_SESSION["username"])) {
            header("Location:/profile/$_SESSION[username]");
        } else {
            header("Location:/");
        }
	}
    
    function action_logout() {
        session_unset();
        session_destroy();
        header("Location:/");
    }
}