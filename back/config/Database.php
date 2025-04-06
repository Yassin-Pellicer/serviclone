<?php
class Database
{
  private $host;
  private $dbname;
  private $user;
  private $password;
  private $pdo;

  public function __construct()
  {
    $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
    $dotenv->load();

    $this->host = $_ENV['HOST'];
    $this->dbname = $_ENV['DB'];
    $this->user = $_ENV['USER'];
    $this->password = $_ENV['PASS'];
  }

  public function connect()
  {
    if ($this->pdo == null) {
      try {
        $dsn = "pgsql:host={$this->host};dbname={$this->dbname}";
        $this->pdo = new PDO($dsn, $this->user, $this->password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
        throw new Exception("Database connection error: " . $e->getMessage());
      }
    }
    return $this->pdo;
  }
}