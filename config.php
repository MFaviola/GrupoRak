<?php
$host = '127.0.0.1';
$db = 'dbgruporac';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';
$port = 3307;

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

global $pdo;

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>