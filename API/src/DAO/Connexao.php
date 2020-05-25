<?php
namespace Source\DAO;

abstract class Conexao
{
/**
* @var \PDO
*/
protected $pdo;

public function __construct()
{
$host = "localhost";
$port = "3306";
$user = "root";
$pass = "";
$dbname = "todolist";

$dsn = "mysql:host={$host};dbname={$dbname};port={$port}";

$this->pdo = new \PDO($dsn, $user, $pass);
$this->pdo->setAttribute(
\PDO::ATTR_ERRMODE,
\PDO::ERRMODE_EXCEPTION
);
}
}