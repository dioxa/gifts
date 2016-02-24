<?php
class Settings {

    private $connection;
    private static $instance;

    private function __construct() {
        $db_config = parse_ini_file("config.ini");
        $this->connection = new PDO("mysql:dbname=$db_config[name];host=$db_config[host]", $db_config['login'], $db_config['pass']);
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