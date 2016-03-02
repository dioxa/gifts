<?php
class Controller_gift extends controller {

    function __construct() {
        $this->model = new Model_Gift();
        $this->view = new View();
    }

    function action_index() {
        $this->view->generate('gift_view.php', 'template_view.php');
    }

    function action_adding() {
        $this->model->addGift($_POST["gift"]);
        header("location:/");
    }
}