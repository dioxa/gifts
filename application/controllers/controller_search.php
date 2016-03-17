<?php
Class Controller_Search extends controller {
    
    function __construct() {
        $this->model = new Model_Search();
        $this->view = new View();
    }

    function action_index() {
        $data = $this->model->get_profile($_POST["username"]);
        $this->view->generate('search_view.php', 'template_view.php', $data);
    }
}