<?php

namespace system;
use PDO;

class Model
{

    public $databaseConnection;

    public function __construct() {

        $conn = new PDO("mysql:host=localhost;dbname=bank_system", 'root', 'root');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->databaseConnection = $conn;

    }

}