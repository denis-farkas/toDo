<?php
include('autoload.php');
session_start();
use DbConnexion\DbConnexion;

use TaskManager\TaskManager;//Récupération éléments tâches


    $dbConnexion = new DbConnexion();       
    $taskManager = new TaskManager($dbConnexion);

    

    
        
    if ($taskManager->deleteTask($id)) {
      
         echo json_encode(["status" => "succes", "message" => "Tâche éliminée avec succés"]);

    } else {

         echo json_encode(["status" => "erreur", "message" => "La tâche n'a pas été éliminée"]);
    }