<?php

namespace TaskManager;

use DbConnexion\DbConnexion;
use Task\Task;
use PDO;


class TaskManager
{

    private $pdo;

    public function __construct(DbConnexion $dbConnexion)
    {
        // On récupère la fonctin getPdo de DbConnexion
        $this->pdo = $dbConnexion->getPDO();
    }
    



    public function getOneTask($id){
        try {
            
                // Le manager récupère l'instance de connexion pdo fournit par la classe DBConnexion
                // Il utilise cette instance de connexion et utilise la fonction query qui commme son nom l'indique
                // requête sur la bdd via notre instance de connexion
                $statement = $this->pdo->query("SELECT * from tdl_task WHERE tdl_task.Id_Task = :id_task");
                $statement->execute([':id_task' => $id]);
                $response = $statement->fetch(PDO::FETCH_ASSOC);
                $statement->closeCursor();
                
            }
            catch (\PDOException $e) {
            
                var_dump($e);
                // Ici si il y a une erreur on la var_dump
            }
            return $response;
        }


    public function getAllTasks($id_user)
{
    $tasks = [];

    try {
        // Prepare the SQL statement
        $stmt = $this->pdo->prepare("SELECT tdl_task.*, GROUP_CONCAT(tdl_category.Nom_Category) AS Category_List, tdl_priority.Nom_Priority FROM `tdl_task` INNER JOIN tdl_categorise ON tdl_task.Id_Task = tdl_categorise.Id_Task INNER JOIN tdl_category ON tdl_category.Id_Category = tdl_categorise.Id_Category INNER JOIN tdl_priority ON tdl_priority.Id_Priority = tdl_task.Id_Priority WHERE tdl_task.Id_User = :id_user GROUP BY tdl_task.Id_Task ORDER BY `Date_Task` DESC ;");
        
       $stmt->execute([':id_user' => $id_user]);

        // Fetch tasks
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $tasks[] = $row;
        }

        // Return tasks
        return $tasks;
    } catch (\PDOException $e) {
        // Log or handle the error
        error_log('Error fetching tasks: ' . $e->getMessage());
        // Return an empty array or throw an exception as needed
        return [];
    }
}



public function createTask(task $objTask )
    {

        $id_user = $_SESSION["userId"];
        print_r($id_user);
        $titre = $objTask->getTitre_task();
        $description =$objTask->getDescription_task();
        $date =$objTask->getDate_task();
        $id_priority=$objTask->getId_priority();
        $array_category=$objTask->getArray_Category();

        try {
                // Ici on requête 
                // prepare sert a nettoyer la donnée avant insertion
                // Attention d'avoir le bon nombre de champs dans la requête)
            $stmt = $this->pdo->prepare("INSERT INTO tdl_task VALUES(NULL,?,?,?,?,?)");

                // Ici la requête est éxécutée après nettoiement, attention à avoir le même 
                // ordre que dans votre bdd.
            $stmt->execute([$titre, $description, $date, $id_user, $id_priority]);

                // SI une ligne a été affectée par le  changement alors on renvoi true
                // Cela permettra d'utiliser cette fonction avec un if dans le traitement
                // If ( ca a fonctionné)
                $id_task =$this->pdo->lastInsertId();

                if($id_task){
                    foreach($array_category as $valeur){
                        try{
                            $stmt = $this->pdo->prepare("INSERT INTO tdl_categorise VALUES(?,?)"); 
                            $stmt->execute([$valeur, $id_task]);
                        }catch (\PDOException $e) {
                        // erreur
                        var_dump($e);
                        }
                    }
                }
                
            return $stmt->rowCount() == 1;
            
            } catch (\PDOException $e) {
                // erreur
                var_dump($e);
            }
        }



    public function modifyTask(task $objTask )
    {
        $id_task = $objTask->getId_task();
        $titre = $objTask->getTitre_task();
        $description =$objTask->getDescription_task();
        $date =$objTask->getDate_task();
        $id_priority=$objTask->getId_priority();
        

        try {
                // Ici on requête 
                // prepare sert a nettoyer la donnée avant insertion
                // Attention d'avoir le bon nombre de champs dans la requête)
            $stmt = $this->pdo->prepare("UPDATE  tdl_task SET Titre_Task= :titre, Description_Task= :description, Date_Task= :date, Id_priority = :id_priority WHERE Id_Task = :id_task");

                // Ici la requête est éxécutée après nettoiement, attention à avoir le même 
                // ordre que dans votre bdd.
            $stmt->execute([$titre, $description, $date, $id_priority, $id_task]);

                // SI une ligne a été affectée par le  changement alors on renvoi true
                // Cela permettra d'utiliser cette fonction avec un if dans le traitement
                // If ( ca a fonctionné)
                
            return $stmt->rowCount() == 1;
            
            } catch (\PDOException $e) {
                // erreur
                var_dump($e);
            }
        }
    
    public function deleteTask($id){
        $statement = $this->pdo->prepare('DELETE FROM tdl_categorise WHERE Id_Task = : id_task');
        if($statement->execute([$id])) {
            $stmt = $this->pdo->prepare('DELETE FROM tdl_task WHERE Id_Task = : id_task');
            if($stmt->execute([$id])) {
            return true;
            }else{
            return false;
            }
        }
    }

    


}