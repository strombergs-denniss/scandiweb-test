<?php

namespace Application;

use PDO;

class Database {
    public $pdo;

    public function __construct()
    {
        $dsn = "mysql:host=" . Configuration::DB_HOST . ";dbname=" . Configuration::DB_NAME . ";charset=" . Configuration::DB_CHARSET;
        $this->pdo = new PDO($dsn, Configuration::DB_USER, Configuration::DB_PASSWORD);
    }
}
