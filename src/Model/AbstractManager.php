<?php
/**
 * Created by PhpStorm.
 * User: patricia
 * Date: 14/10/18
 * Time: 20:38
 */

namespace Model;


class AbstractManager
{
    protected $pdo; // connexion
    protected $table;
    protected $className;

    public function __construct( $table, \PDO $pdo)
    {

        $this->table = $table;
        $this->className = __NAMESPACE__ . '\\' . ucfirst($table);
        $this->pdo = $pdo;
    }

    public function selectAll(): array
    {
        return $this->pdo->query('SELECT * FROM ' . $this->table, \PDO::FETCH_CLASS, $this->className)->fetchAll();
    }

    public function selectOneById(int $id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE id=:id");
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch();
    }
}