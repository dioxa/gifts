<?php
class Controller_gift extends controller {

    function __construct() {
        $this->model = new Model_Gift();
        $this->view = new View();
    }

    function action_index($giftId) {
        $data = $this->model->get_data($giftId);
        $this->view->generate('gift_view.php', 'template_view.php', $data);
    }
    
    function action_add() {
        $this->view->generate('giftAdd_view.php', 'template_view.php');
    }

    function action_adding() {
        $this->model->addGift($_POST["gift"]);
        header("location:/");
    }

    function action_bind($id) {
        $this->model->bindGift($id);
        
    }
}