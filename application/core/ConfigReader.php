<?php
Class ConfigReader {

    private $configPath = 'config.ini';
    private $content;
    private static $configReader;

    private function __construct() {
        $this->content = parse_ini_file($this->configPath, true);
    }

    protected function __clone() {
    }

    public static function getInstance() {
        if(is_null(self::$configReader)) {
            self::$configReader = new self();
        }
        return self::$configReader;
    }

    public function getField( $block, $field) {
        return $this->content[$block][$field];
    }

}
?>