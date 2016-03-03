<?php
class Controller_Subscribe extends Controller {

    function __construct() {
        $this->model = new Model_Subscribe();
    }
    
    function action_index() {
        $this->model->subscribe();
        header("location:/profile/");
    }
}