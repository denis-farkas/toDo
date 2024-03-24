//Création webRoot
// Get the current script element
const scripts = document.getElementsByTagName("script");
const currentScript = scripts[scripts.length - 1];

// Get the src attribute of the script
const scriptSrc = currentScript.src;

// Derive the web root from the script src
const webRoot = scriptSrc.substring(0, scriptSrc.lastIndexOf("/assets"));
console.log(webRoot);

//Récupération de tous les champs email et mdp
// let email_connexion = document.querySelector('#Email_User_Connexion').value;
// let mdp_connexion = document.querySelector('#Mdp_User_Connexion').value;

let email_inscription = document.querySelector("#Email_User_Inscription").value;
let mdp_inscription = document.querySelector("#Mdp_User_Inscription").value;
let mdp_inscription2 = document.querySelector("#Mdp_User_Inscription2").value;

// let email_informations = document.querySelector('#Email_User_Informations').value;
// let mdp_informations = document.querySelector('#Mdp_User_Informations').value;
// let mdp_informations2 = document.querySelector('#Mdp_User_Informations2').value;

let email_modif_informations = document.querySelector(
  "#Email_User_Modifier_Informations"
).value;
let mdp_modif_informations = document.querySelector(
  "#Mdp_User_Modifier_Informations"
).value;
let mdp_modif_informations2 = document.querySelector(
  "#Mdp_User_Modifier_Informations2"
).value;

// Récupération de tous les champs nom et prénom
let nom_inscription = document.querySelector("#Nom_User_Inscription").value;
let prenom_inscription = document.querySelector(
  "#Prenom_User_Inscription"
).value;

let nom_informations = document.querySelector("#Nom_User_Informations").value;
let prenom_informations = document.querySelector(
  "#Prenom_User_Informations"
).value;

let nom_modif_informations = document.querySelector(
  "#Nom_User_Modifier_Informations"
).value;
let prenom_modif_informations = document.querySelector(
  "#Prenom_User_Modifier_Informations"
).value;

// Récupération de tous les champs de la ToDoList
let titre_task = document.querySelector("#Titre_Task").value;
let description_task = document.querySelector("#Description_Task").value;
let date_task = document.querySelector("#Date_Task").value;
let id_priority = document.querySelector("#Id_Priority").value;
const categories = document.getElementsByClassName("checkbox");

// Récupération de toutes les modales
let modalToDoList = document.querySelector("#modalToDoList");
let modalConnexion = document.querySelector("#modalConnexion");
let modalInscription = document.querySelector("#modalInscription");
let modalInformations = document.querySelector("#modalInformations");
let modalModifierInformations = document.querySelector(
  "#modalModifierInformations"
);
let modalUpdate = document.querySelector("#modalToDoUpdate");

// Récupération de tous les boutons
let btnAjouterTaches = document.querySelector("#btnAjouterTaches");
let btnConnexion = document.querySelector("#btnConnexion");
let btnCreerCompte = document.querySelector("#btnCreerCompte");
let btnValidationInscription = document.querySelector(
  "#btnValidationInscription"
);
let btnModifierInformations = document.querySelector(
  "#btnModifierInformations"
);
let btnSupprimerInformations = document.querySelector(
  "#btnSupprimerInformations"
);
let btnValiderModificationInformations = document.querySelector(
  "#btnValiderModificationInformations"
);
let btnCompteHeader = document.querySelector("#btnCompteHeader");

// Récupération contenu tâche
let descriptionTache = document.querySelector(".descriptionTache");
let titreTache = document.querySelector(".titreTache");
let dateTache = document.querySelector(".dateTache");
let btnTermine = document.querySelector(".btnTermine");
let btnAFaire = document.querySelector(".btnAFaire");

// Gestion affichage modales

btnValidationInscription.addEventListener("click", function () {
  modalInscription.classList.add("hidden");
  modalToDoList.classList.remove("hidden");
  btnCompteHeader.classList.remove("hidden");
});

function blocAAfficherOuCacher(blocACacher, blocAAfficher) {
  blocACacher.classList.add("hidden");
  blocAAfficher.classList.remove("hidden");
}

// Gestion tâche temrinée / à faire
if (btnTermine) {
  btnTermine.addEventListener("click", function () {
    descriptionTache.classList.add("line-through");
    titreTache.classList.add("line-through");
    dateTache.classList.add("line-through");
  });
}

if (btnAFaire) {
  btnAFaire.addEventListener("click", function () {
    descriptionTache.classList.remove("line-through");
    titreTache.classList.remove("line-through");
    dateTache.classList.remove("line-through");
  });
}

// Récupération identifiants connexion

function handleLoginConnexion() {
  let email_connexion = document.querySelector("#Email_User_Connexion").value;
  let mdp_connexion = document.querySelector("#Mdp_User_Connexion").value;

  /*let modalToDoList = document.querySelector("#modalToDoList");
  let modalConnexion = document.querySelector("#modalConnexion");
  let btnCompteHeader = document.querySelector("#btnCompteHeader");*/

  if (email_connexion == "" || mdp_connexion == "") {
    document.querySelector(
      ".messageErreur"
    ).innerText = `Merci de remplir Email et Password.`;
  }

  let emailCrendentials = {
    email: email_connexion,
    password: mdp_connexion,
  };
  console.log(emailCrendentials);

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(emailCrendentials),
  };

  const url = `${webRoot}/login.php`;

  fetch(url, params)
    .then((res) => res.text())
    .then((data) => {
      let jsonData = JSON.parse(data);
      if (jsonData && jsonData.status) {
        // Check status property while considering possible encoding differences
        if (jsonData.status.trim().toLowerCase() === "succes") {
          // Handle success
          modalConnexion.classList.add("hidden");
          localStorage.setItem("idUser", jsonData.id_user);
          listTask(jsonData.id_user);
          modalToDoList.classList.remove("hidden");
          btnCompteHeader.classList.remove("hidden");
        } else if (jsonData.status.trim().toLowerCase() === "erreur") {
          // Handle error
          document.querySelector(".messageErreur").innerText =
            "Le mot de passe est erroné";
        }
      } else {
        // Handle the case where data or data.status is not defined
        console.error("Invalid data received from server:", data);
      }
    });
}
// Récupération informations formulaire inscription

function userInscription() {
  let prenom_inscription = document.querySelector(
    "#Prenom_User_Inscription"
  ).value;
  let nom_inscription = document.querySelector("#Nom_User_Inscription").value;
  let email_inscription = document.querySelector(
    "#Email_User_Inscription"
  ).value;
  let mdp_inscription = document.querySelector("#Mdp_User_Inscription").value;

  let infosInscription = {
    prenom_user: prenom_inscription,
    nom_user: nom_inscription,
    email_user: email_inscription,
    mdp_user: mdp_inscription,
    inputInscription: true,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(infosInscription),
  };
  console.log(infosInscription);
  const url = `${webRoot}/traitementUser.php`;
  fetch(url, params)
    .then((res) => res.text())
    .then((data) => {
      let jsonData = JSON.parse(data);
      if (jsonData && jsonData.status) {
        // Check status property while considering possible encoding differences
        if (jsonData.status.trim().toLowerCase() === "succes") {
          // Handle success
          const idUser = jsonData.id_user;
          localStorage.setItem("idUser", idUser);
          window.location.href = `${webRoot}/index.php`;
        } else if (jsonData.status.trim().toLowerCase() === "erreur") {
          // Handle error
          document.querySelector(".messageErreur").innerText = jsonData.message;
        }
      } else {
        // Handle the case where data or data.status is not defined
        console.error("Invalid data received from server:", data);
      }
    });
}

//création ListTask

function listTask(idUser) {
  let container = document.querySelector("#container_list_tasks");
  let output = "";

  // Create an object with id_user key
  const raw = JSON.stringify({
    idUser: idUser,
  });

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    // Send requestData as the body
    body: raw,
  };

  const url = `${webRoot}/listTask.php`;

  // Add try...catch block to handle errors during fetch operation
  try {
    fetch(url, params)
      .then((res) => res.text())
      .then((data) => {
        let jsonData = JSON.parse(data);

        if (jsonData && jsonData.status) {
          // Check status property while considering possible encoding differences
          if (jsonData.status.trim().toLowerCase() === "success") {
            // Handle success
            const tasks = jsonData.tasks;
            console.log(tasks);
            tasks.forEach((task) => {
              let nomPriority = task.Nom_Priority;
              let categoryList = task.Category_List;
              let idTask = task.Id_Task;
              let dateTask = task.Date_Task;
              let titreTask = task.Titre_Task;
              let descriptionTask = task.Description_Task;

              output +=
                '<div class="conteneurTache flex-col bg-white rounded shadow m-4 w-full lg:w-3/4 lg:max-w-lg flex mb-4">' +
                '<div class="bandeauCouleurPriority w-full ' +
                (nomPriority === "Normal"
                  ? "bg-green-600"
                  : nomPriority === "Important"
                  ? "bg-orange-600"
                  : "bg-red-600") +
                ' px-1 min-h-fit text-w hite top-0 flex justify-end">' +
                '<p class="w-fit text-sm text-white align-middle">' +
                escapeHTML(categoryList) +
                "</p>" +
                '<button class="flex-no-shrink text-white p-1 ml-2 mr-1 border-1 w-fit text-sm rounded cursor-pointer" onclick="goToUpdateTask(' +
                idTask +
                ')"><i class="fa-solid fa-pencil"></i></button>' +
                '<button class="flex-no-shrink text-white p-1 ml-1 border-1 w-fit text-sm rounded cursor-pointer" onclick="deleteTask(' +
                idTask +
                ')"><i class="fa-solid fa-trash-can"></i></button>' +
                "</div>" +
                '<div class="conteneurTexteTache p-3">' +
                '<p class="dateTache">' +
                escapeHTML(dateTask) +
                "</p>" +
                '<p class="titreTache w-full text-lg text-grey-darkest">' +
                escapeHTML(titreTask) +
                "</p>" +
                '<p class="descriptionTache w-full text-sm text-grey-darkest">' +
                escapeHTML(descriptionTask) +
                "</p>" +
                "</div>" +
                '<div class="btns flex justify-end p-1 mt-2">' +
                '<button class="btnTermine flex-no-shrink p-1 ml-1 mr-1 border-2 w-fit rounded hover:text-purple-500 text-xs">Terminé !</button>' +
                '<button class="btnAFaire flex-no-shrink p-1 ml-1 mr-1 border-2 w-fit rounded hover:text-purple-500 text-xs">A faire</button>' +
                "</div>" +
                "</div>";
            });

            container.innerHTML = output;
          } else if (jsonData.status.trim().toLowerCase() === "error") {
            container.innerHTML = "<p>Pas de tâches enregistrées</p>";
          }
        }
      });
  } catch (error) {
    console.error("Fetch error:", error);
    container.innerHTML =
      "<p>Une erreur est survenue lors de la récupération des tâches</p>";
  }
}

// Function to escape HTML entities
function escapeHTML(html) {
  var escapeEl = document.createElement("textarea");
  escapeEl.textContent = html;
  return escapeEl.innerHTML;
}

// Récupération infos tâche

function addTask() {
  let titre_task = document.querySelector("#Titre_Task").value;
  let description_task = document.querySelector("#Description_Task").value;
  let date_task = document.querySelector("#Date_Task").value;
  let id_priority = document.querySelector("#Id_Priority").value;

  function getValueCategory() {
    let arrayCat = [];
    for (index = 0; index <= 3; index++) {
      if (categories[index].checked) {
        arrayCat.push(categories[index].value);
      }
    }
    return arrayCat;
  }

  let arrayCategories = getValueCategory();

  let btnAjouterTaches = {
    Titre_Task: titre_task,
    Description_Task: description_task,
    Date_Task: date_task,
    Id_Priority: id_priority,
    Array_Category: arrayCategories,
    btnAjouterTaches: true,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(btnAjouterTaches),
  };
  console.log(btnAjouterTaches);
  const url = `${webRoot}/addTask.php`;
  fetch(url, params)
    .then((res) => res.text())
    .then((data) => {
      const id_user = localStorage.getItem("idUser");
      listTask(id_user);
      modalToDoList.classList.remove("hidden");
      btnCompteHeader.classList.remove("hidden");
    });
}

function goToUpdateTask(id) {
  window.location.href =
    `${webRoot}/updateTask.php?param=` + encodeURIComponent(id);
}
