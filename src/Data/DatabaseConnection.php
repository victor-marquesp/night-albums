<?php

namespace App\Data;

use PDO;

final class DatabaseConnection {

    private PDO $connection;

    public function __construct() {

        $this->connection = new PDO('sqlite:' .'././' .'/database/database.db');

        $this->connection->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );

    }

    public function getConnection(): PDO {

        return $this->connection;
        
    }

}