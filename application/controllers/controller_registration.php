<?php
class Controller_Registration extends Controller {

    function __construct() {
        $this->model = new Model_registration();
        $this->view = new View();
    }

    function action_index() {
        $this->view->generate('registration_view.php', 'template_view.php');
    }

    function action_load() {
        $this->model->set_data($_POST["info"]);
        header("location:/");
    }
}
?>