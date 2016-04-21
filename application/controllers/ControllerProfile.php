<?php
class ControllerProfile extends Controller {

    function __construct() {
        $this->model = new ModelProfile();
        $this->view = new View();
    }

    function actionIndex($username = NULL) {
        if (!isset($username)) {
            $username = $_SESSION["username"];
        }
        $data = $this->model->getData($username);
        if (!empty($data["userInfo"])) {
            $this->view->generate('ProfileView.php', 'TemplateView.php', $data);
        } else {
            Route::ErrorPage404();
        }
    }
}
?>