<?php
class ControllerGift extends Controller {

    function __construct() {
        $this->model = new ModelGift();
        $this->view = new View();
    }

    function actionIndex($giftId) {
        $data = $this->model->getData($giftId);
        if (!empty($data["gift"])) {
            $this->view->generate('GiftView.php', $data);
        } else {
            Route::ErrorPage404();
        }
    }
    
    function actionAdd() {
        $this->view->generate('GiftAddView.php');
    }

    function actionAdding() {
        $this->model->addGift($_POST["gift"]);
        header("location:/");
    }

    function actionBind($id) {
        $this->model->bindGift($id);
        
    }
}