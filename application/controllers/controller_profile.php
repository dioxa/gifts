<?php
class Controller_Profile extends Controller {

    function __construct() {
        $this->model = new Model_Profile();
        $this->view = new View();
    }

    function action_index($username = NULL) {
        if (!isset($username)) {
            $username = $_SESSION["username"];
        }
        $data = $this->model->get_data($username);
        if (!empty($data["user_info"])) {
            $this->view->generate('profile_view.php', 'template_view.php', $data);
        } else {
            Route::ErrorPage404();
        }
    }
}
?>