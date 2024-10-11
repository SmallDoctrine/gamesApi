<?php

try {
    $dsn = 'pgsql:host=localhost;dbname=Games';
    $pdo = new PDO($dsn, 'postgres', '1234');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
