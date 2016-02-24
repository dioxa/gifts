<?php
class Controller_Settings extends Controller {

    function __construct() {
        $this->model = new Model_Settings();
        $this->view = new View();
    }

    function action_index() {
        $this->view->generate('settings_view.php', 'template_view.php');
    }

    function action_setphoto() {
        $this->model->setProfilePhoto();
        header("location:/");
    }
}