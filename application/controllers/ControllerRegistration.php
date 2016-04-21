<?php
class ControllerRegistration extends Controller {

    function __construct() {
        $this->model = new ModelRegistration();
        $this->view = new View();
    }

    function actionIndex() {
        $this->view->generate('RegistrationView.php', 'TemplateView.php');
    }

    function actionLoad() {
        $this->model->setData($_POST["info"]);
        header("location:/");
    }
}
?>