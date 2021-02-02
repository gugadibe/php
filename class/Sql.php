<?php

class Sql extends PDO
{
  private $conn;

  public function __construct()
  {
    $this->conn = new PDO("mysql:host=localhost;dbname=dbphp7", "root", "");
  }

  private function setparams($statment, $parameters = [])
  {
    foreach ($parameters as $key => $value) {
      $this->setParam($statment, $key, $value);
    }
  }

  private function setParam($statment, $key, $value)
  {
    $statment->bindParam($key, $value);
  }

  public function query($rawQuery, $params = [])
  {
    $stmt = $this->conn->prepare($rawQuery);
    $this->setparams($stmt, $params);
    $stmt->execute();

    return $stmt;
  }

  public function select($rawQuery, $params = []): array
  {
    $stmt = $this->query($rawQuery, $params);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
