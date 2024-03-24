<?php
namespace PriorityManager;

use Priority\Priority;
use DbConnexion\DbConnexion;
use PDO;

class PriorityManager
{
    private $pdo;

    public function __construct(DbConnexion $dbConnexion)
    {
        $this->pdo = $dbConnexion->getPDO();
    }

    public function allPriorities()
    {
        $priorities = [];

        try {
            $stmt = $this->pdo->query("SELECT * FROM tdl_priority");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $priorities[] = new Priority($row);
            }
        } catch (\PDOException $e) {
            return $priorities;
        }
        return $priorities;
    }

    public function getOnePriority($id_priority){

        try {
            $sql = "SELECT * FROM `tdl_priority` WHERE Id_Priority = :id_priority";
            $statement = $this->pdo->prepare($sql);
            $statement->execute([':id_priority' => $id_priority]);
            $response = $statement->fetch(PDO::FETCH_ASSOC);
        }
        catch (\PDOException $e) {
            
            var_dump($e);
            // Ici si il y a une erreur on la var_dump
        }
      return $response;
    }

    // public function insertPriority(Priority $objet)
    // {
    //     $name = $objet->getNameCategory();
    //     try {
    //         $stmt = $this->pdo->prepare("INSERT INTO tdl_priority (name) VALUES (?)");
    //         $stmt->execute([$name]);

    //         return $stmt->rowCount() == 1;
    //     } catch (\PDOException $e) {
    //         return false;
    //     }
    // }
}
