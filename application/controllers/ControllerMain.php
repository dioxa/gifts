<?php
class ControllerMain extends Controller {

    function __construct() {
        $this->view = new View();
    }
	
    function actionIndex() {
            $this->view->generate('MainView.php');
    }
}
?>