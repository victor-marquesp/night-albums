<?php

namespace App\Data;

use PDO;
use PDOException;

use App\Shared\Exceptions\CannotConnectException;

final class DatabaseConnection {

    private PDO $connection;

    public function __construct() {

        try {

            $this->connection = new PDO('sqlite:' .'././' .'/database/database.db');

            $this->connection->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        
        } catch (PDOException $e) {
            throw new CannotConnectException('ERRO AO CONECTAR COM O BANCO DE DADOS: ' .$e->getMessage());
        }

    }

    public function getConnection(): PDO {

        return $this->connection;
        
    }

}