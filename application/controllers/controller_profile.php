<?php
class Controller_Profile extends Controller {

    function __construct() {
        $this->view = new View();
    }

    function action_index($username) {
        $this->view->generate('profile_view.php', 'template_view.php');
    }
}
?>