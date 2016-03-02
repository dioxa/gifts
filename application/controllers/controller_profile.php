<?php
class Controller_Profile extends Controller {

    function __construct($username) {
        $this->model = new Model_Profile($username);
        $this->view = new View();
    }

    function action_index() {
        $data = $this->model->get_data();
        $this->view->generate('profile_view.php', 'template_view.php', $data);
    }
}
?>