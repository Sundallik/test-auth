<?php

namespace App\Core;

use Exception;
use PDO;

trait Database
{
    private function connect()
    {
        try {
            return new PDO(
                DRIVER . ':host=' . HOST . ';dbname=' .
                DB_NAME . ';port=' . PORT . ';$charset=' . CHARSET,
                DB_USER, DB_PASS,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (Exception $e) {
            die("Error DB connection: {$e->getMessage()}");
        }
    }

    public function query($sql, $data = [])
    {
        $con = $this->connect();
        $stmt = $con->prepare($sql);

        $stmt->execute($data);
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetchAll();
            return $result;
        }
        return false;
    }
}