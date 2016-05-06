<?php
class Model {
    
    public $connection;
    
    function __construct() {
        require_once 'application/core/Connect.php';

        $instance = Connect::getInstance();
        $this->connection = $instance->getConnection();
    }
}
?>