//Création webRoot
// Get the current script element
const scripts = document.getElementsByTagName("script");
const currentScript = scripts[scripts.length - 1];

// Get the src attribute of the script
const scriptSrc = currentScript.src;

// Derive the web root from the script src
const webRoot = scriptSrc.substring(0, scriptSrc.lastIndexOf("/assets"));
console.log(webRoot);

function modifyTask() {
  let titre_task = document.querySelector("#Update_Titre_Task").value;
  let description_task = document.querySelector(
    "#Update_Description_Task"
  ).value;
  let date_task = document.querySelector("#Update_Date_Task").value;
  let id_priority = document.querySelector("#Update_Id_Priority").value;
  let id_task = document.querySelector("#Update_Id_Task").value;

  let objUpdateTaches = {
    Titre_Task: titre_task,
    Description_Task: description_task,
    Date_Task: date_task,
    Id_Priority: id_priority,
    Id_Task: id_task,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(objUpdateTaches),
  };

  const url = `${webRoot}/modifyTask.php`;
  fetch(url, params)
    .then((res) => res.text())
    .then((data) => {
      let jsonData = JSON.parse(data);
      if (jsonData && jsonData.status) {
        // Check status property while considering possible encoding differences
        if (jsonData.status.trim().toLowerCase() === "succes") {
          // Handle success
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
