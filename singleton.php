<?php

class DatabaseConnection {
    private static $instance = null;
    private $connection;
    private function __construct() {
        $this->connection = new PDO("mysql:host=richyou.mysql.ukraine.com.ua;dbname=richyou_bustomove", "richyou_root", "DUPr867p8i");
    }
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new DatabaseConnection();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}

$db = DatabaseConnection::getInstance();
$connection = $db->getConnection();
