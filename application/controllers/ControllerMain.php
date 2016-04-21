<?php
class ControllerMain extends Controller {

    function __construct() {
        $this->view = new View();
    }
	
    function actionIndex() {
        if (empty($_SESSION)) {
            $this->view->generate('MainView.php', 'GuestTemplateView.php');
        } else {
            $this->view->generate('MainView.php', 'TemplateView.php');
        }
    }
}
?>