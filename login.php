<?php
include("autoload.php");
session_start();

use DbConnexion\DbConnexion;
use UserManager\UserManager;   

   
    $data = file_get_contents("php://input");

    $user = (json_decode($data, true));


    
    if (isset($user["email"]) && isset($user["password"]) && !empty($user["email"]) && !empty($user["password"]) ) {
        $dbConnexion = new DbConnexion();
        $userManager = new UserManager($dbConnexion);
    }

    $response= $userManager->login($user["email"], $user["password"]);
  
    if ($response) {
            $hashedPassword = $response["Mdp_User"];
            if (password_verify($user["password"], $hashedPassword)) {
                
                $_SESSION["userId"] = $response['Id_User'];
               
                echo json_encode(["status" => "succes", "message" => "Vous êtes connecté", "id_user" => $response['Id_User']]);
            } else {
                echo json_encode(["status" => "erreur", "message" => "Le mot de passe est erroné"]);
            }
        } else {
            echo json_encode(["status" => "erreur", "message" => "Vous n'êtes pas enregistré"]);
        }


 ?>


