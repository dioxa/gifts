<?php
Class ControllerSearch extends Controller {
    
    function __construct() {
        $this->model = new ModelSearch();
        $this->view = new View();
    }

    function actionIndex($username) {
        $data = $this->model->getProfile($username);
        $this->view->generate('SearchView.php', $data);
    }
}