<?php
include('autoload.php');
session_start();
use DbConnexion\DbConnexion;
use Task\Task;
use TaskManager\TaskManager;//Récupération éléments tâches

    $data = file_get_contents("php://input");
    $task = (json_decode($data, true));

    $objTask =  new task($task);


    $dbConnexion = new DbConnexion();       
    $taskManager = new TaskManager($dbConnexion);

    

    
        
    if ($taskManager->createTask($objTask)) {
      
         echo json_encode(["status" => "succes", "message" => "Tâche enregistré avec succés"]);

    } else {

         echo json_encode(["status" => "erreur", "message" => "La tâche n'a pas été enregistrée"]);
    }
   