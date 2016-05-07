<?php
class ControllerLogin extends Controller {

    function __construct() {
        $this->model = new ModelLogin();
        $this->view = new View();
    }
    
    function actionIndex() {
        $access = $this->model->login($_POST["login"], $_POST["password"]);
        if(isset($_SESSION["username"])) {
            header("Location:/profile/$_SESSION[username]");
        } else {
            $this->view->generate("MainView.php", $access);
        }
	}
    
}