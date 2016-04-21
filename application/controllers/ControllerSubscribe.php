<?php
class ControllerSubscribe extends Controller {

    function __construct() {
        $this->model = new ModelSubscribe();
    }
    
    function actionIndex() {
        $this->model->subscribe();
        header("location:/profile/");
    }
}