<?php
class Controller {

    protected $model;
    protected $view;
	
    function __construct() {
        $this->view = new View();
    }
	
    function action_index() {
    }
}
?>