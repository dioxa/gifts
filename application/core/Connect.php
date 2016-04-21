<?php
class Connect {

    private $connection;
    private static $instance;

    private function __construct() {
        $dbConfig = parse_ini_file("config.ini");
        $this->connection = new PDO("mysql:dbname=$dbConfig[name];host=$dbConfig[host]", $dbConfig['login'], $dbConfig['pass']);
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