<?php
class Settings {

    private $connection;
    private static $instance;

    private function __construct() {
        $this->connection = new PDO('mysql:dbname=gifts;host=127.0.0.1:3300', 'root', '655776');
    }
    protected function __clone() {
    }

    static public function getInstance() {
        if(is_null(self::$instance))
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}
?>