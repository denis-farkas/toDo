<?php
include("./autoload.php");

use Task\Task;
use Priority\Priority;
use TaskManager\TaskManager;
use UserManager\UserManager;
use PriorityManager\PriorityManager;
use DbConnexion\DbConnexion;

session_start();

$dbConnexion = new DbConnexion();
$TaskManager = new TaskManager($dbConnexion);
$UserManager = new UserManager($dbConnexion);
$PriorityManager = new PriorityManager($dbConnexion);

$id_task = $_GET['param'];
print_r($id_task);

$task = $TaskManager->getOneTask($id_task);

$objTask =  new task($task);

if($task){
$priority = $PriorityManager->getOnePriority($objTask->getId_priority());

$objPriority = new priority($priority);
}
    

   
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&family=Seaweed+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/style.css">
    <title>To Do List</title>
</head>

<body class="font-sans relative">

    <!-- HEADER -->
    <header class="header">
        <h1 class="satisfy-regular flex justify-center mt-20 mb-10 text-5xl text-white">To Do or Not To Do</h1>
    </header>

    <!-- TO DO UPDATE -->
    <div class="messageErreur"></div>
    <div id="ToDoUpdate" class="h-100 w-full flex flex-wrap items-center justify-center font-sans hidden">
        <div class="bg-white rounded shadow p-6 m-4 w-full lg:w-3/4 lg:max-w-lg">
            <div class="mb-4 flex w-full flex-col justify-center items-center">

                <!-- CONTENEUR UPDATE TACHES -->
                <div class="flex flex-col w-full">

                    <!-- titre tâches -->
                    <input id="Update_Titre_Task" name="Titre_Task" value="<?= $objTask->getTitre_task() ?>" class="shadow appearance-none border rounded w-full py-2 px-3 mr-4 text-grey-darker" placeholder="Titre de votre tâche" />

                    <!-- description -->
                    <input id="Update_Description_Task" name="Description_Task" value="<?= $objTask->getDescription_task() ?>"class="shadow appearance-none border rounded w-full py-2 px-3 mr-4 text-grey-darker mt-5" placeholder="Description" />

                    <div class="flex">

                        <!-- conteneur date et priorités -->
                        <div class="w-1/2 flex-row items-center justify-center bg-teal-lightest font-sans p-2">
                            <!-- date -->
                            <input id="Update_Date_Task" name="Date_Task" type="date" value="<?= $objTask->getDate_task() ?>"class="flex shadow appearance-none border rounded w-full py-2 mr-4 mt-5 text-grey-darker sm:text-sm" />

                            <!-- priorités -->

                            <select id="Update_Id_Priority" name="Id_Priority" type="text" required class="flex capitalize block w-full rounded-md border-0 py-1.5 text-gray shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-fuchsia-600 sm:text-sm sm:leading-6 mt-5">
                              <option class="text-gray" value="<?= $objTask->getId_priority() ?>"><?=  $objPriority->getNom_priority(); ?></option>
                              <option class="text-gray" value="1">Normal</option>
                              <option class="text-gray" value="2">Important</option>
                              <option class="text-gray" value="3">Urgent</option>
                            </select>
                        </div>
                    </div>

                </div>
                <input type="hidden" name="Id_Task" value="<?= $objTask->getId_task() ?>" />

                <!-- bouton ajouter -->
                <input id="btnUpdateTaches" name="btnUpdateTaches" value="Modifier" onclick="modifyTask()" type="submit" class="flex-no-shrink w-fit p-2 mt-8 border-2 rounded hover:text-purple-500" />
            </div>
        </div>
    </div>




</body>

<script src="https://cdn.tailwindcss.com"></script>
<script src="https://kit.fontawesome.com/ffa8279fb3.js" crossorigin="anonymous"></script>
<script src="./assets/updateTask.js"></script>


</html>