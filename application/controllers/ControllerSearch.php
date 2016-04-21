<?php
Class ControllerSearch extends Controller {
    
    function __construct() {
        $this->model = new ModelSearch();
        $this->view = new View();
    }

    function actionIndex() {
        $data = $this->model->getProfile($_POST["username"]);
        $this->view->generate('SearchView.php', 'TemplateView.php', $data);
    }
}