<?php
include('autoload.php');
session_start();
use DbConnexion\DbConnexion;
use TaskManager\TaskManager;

//Récupération éléments formulaire inscription

// Assuming $data is your array
$data = file_get_contents("php://input");
$jsonData = json_decode($data);
// Check if JSON decoding was successful
if ($jsonData === null && json_last_error() !== JSON_ERROR_NONE) {
    // JSON decoding failed
    echo json_encode(["status" => "error", "message" => "Erreur de décodage JSON"]);
    exit;
}

// Check if the id_user property exists in the JSON data
if (!isset($jsonData->idUser)) {
    // id_user property is missing
    echo json_encode(["status" => "error", "message" => "Propriété 'id_user' manquante"]);
    exit;
}

$id_user = $jsonData->idUser;

// Now $id_user contains the value of id_user from the $data array

$dbConnexion = new DbConnexion();       
$taskManager = new TaskManager($dbConnexion);

$tasks = $taskManager->getAllTasks($id_user);

if (!empty($tasks)) {
    echo json_encode(["status" => "success", "tasks" => $tasks]);
} else {
    echo json_encode(["status" => "error", "message" => "Pas de tâches enregistrées"]);
}
?>