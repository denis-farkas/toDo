<?php
include('autoload.php');
session_start();
use DbConnexion\DbConnexion;
use User\User;
use UserManager\UserManager;


    //Récupération éléments formulaire inscription

    $data = file_get_contents("php://input");
    $user = (json_decode($data, true));
    print_r($user);
    $obj =  new user($user);


    $dbConnexion = new DbConnexion();       
    $userManager = new UserManager($dbConnexion);

    
    
    if($userManager->userExist($obj) !== true){
        $id_user = $userManager->saveUser($obj);
        if ($id_user > 0) {
               
                echo json_encode(["status" => "succes", "message" => "Vous êtes inscrit", "id_user" => $id_user]);
            } else {
                echo json_encode(["status" => "erreur", "message" => "Erreur système"]);
            }
    }   else{ echo json_encode(["status" => "erreur", "message" => "Cet email est déja inscrit."]);}