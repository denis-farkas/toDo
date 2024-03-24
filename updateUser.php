<?php
include('autoload.php');
session_start();
use DbConnexion\DbConnexion;
use User\User;
use UserManager\UserManager;   

    $data = file_get_contents("php://input");
    $user = (json_decode($data, true));

    $objUser =  new user($user);


    $dbConnexion = new DbConnexion();       
    $userManager = new UserManager($dbConnexion);

    

    
        
    if ($userManager->updateUser($objUser)) {
      
         echo json_encode(["status" => "succes", "message" => "Profil modifié avec succés"]);

    } else {

         echo json_encode(["status" => "erreur", "message" => "La modification n'a pas été enregistrée"]);
    }