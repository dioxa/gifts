<?php
include_once 'ConfigReader.php';

class Logger {


    private static $directory;
    private static $fileName;
    private static $isDebug;

    private function __construct() {
    }

    public static function init() {
        self::$directory = ConfigReader::getInstance()->getField("Logger", "directory");
        self::$fileName = ConfigReader::getInstance()->getField("Logger", "filename");
        self::$isDebug = ConfigReader::getInstance()->getField("Logger", "DEBUG") === 'true' ? true : false;
    }

    public static function sqlError($message) {
        if ($message[0] != "00000") {
            self::error("SQL " . $message[0] . " " . $message[2]);
        }
    }

    public static function error($message) {
        self::log("ERROR", $message);
    }

    public static function warning($message) {
        self::log("WARNING", $message);
    }

    public static function info($message) {
        self::log("INFO", $message);
    }

    public static function debug($message) {
        if (self::$isDebug = true) {
            self::log("DEBUG", $message);
        }
    }

    public static function fatal($message) {
        self::log("FATAL", $message);
    }

    private static function log($level, $message) {
        $file = fopen(self::$directory . self::$fileName, "a");
        $message ="[" . date("Y:m:d H:i:s") . "]" . "[" . $level . "]" . $message . PHP_EOL;
        fwrite($file, $message);
        fclose($file);
    }
}
Logger::init();

