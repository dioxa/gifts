<?php
class Connect {

    private $connection;
    private static $instance;

    private function __construct() {
        include_once "ConfigReader.php";
        $this->connection = new PDO("mysql:dbname=" . ConfigReader::getInstance()->getField('DB', 'name') . ";host=". ConfigReader::getInstance()->getField('DB', 'host'), ConfigReader::getInstance()->getField('DB', 'login'), ConfigReader::getInstance()->getField('DB', 'pass'));
    }

    protected function __clone() {
    }

    static public function getInstance() {
        if(is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}
?>