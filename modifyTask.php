<?php
include('autoload.php');
session_start();
use DbConnexion\DbConnexion;
use Task\Task;
use TaskManager\TaskManager;




    //Récupération éléments formulaire inscription

    $data = file_get_contents("php://input");
    $task = (json_decode($data, true));
    print_r($user);
    $objTask =  new task($task);


    $dbConnexion = new DbConnexion();       
    $userManager = new TaskManager($dbConnexion);

    
    
         
    if ($taskManager->modifyTask($objTask)) {
      
         echo json_encode(["status" => "succes", "message" => "Tâche modifiée avec succés"]);

    } else {

         echo json_encode(["status" => "erreur", "message" => "La tâche n'a pas été enregistrée"]);
    }


    