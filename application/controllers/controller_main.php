<?php
class Controller_Main extends Controller {

    function __construct() {
        $this->view = new View();
    }
	
    function action_index() {
        if (empty($_SESSION)) {
            $this->view->generate('main_view.php', 'guest_template_view.php');
        } else {
            $this->view->generate('main_view.php', 'template_view.php');
        }
    }
}
?>