<?php
class ControllerSettings extends Controller {

    function __construct() {
        $this->model = new ModelSettings();
        $this->view = new View();
    }

    function actionIndex() {
        $this->view->generate('SettingsView.php');
    }

    function actionSetPhoto() {
        $this->model->setProfilePhoto();
        header("location:/");
    }
}