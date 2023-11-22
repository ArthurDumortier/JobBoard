// Attend que le document HTML soit entièrement chargé avant d'exécuter le code
document.addEventListener("DOMContentLoaded", function () {
  // Récupère l'ID de l'utilisateur à partir de l'attribut de données (data-user-id)
  const userId = document.body.dataset.userId;

  // Récupère l'ID de la candidature à partir de l'URL
  const candidatureId = window.location.pathname.split("/").pop();

  // Effectue une requête pour obtenir les données de la candidature en fonction de l'ID de l'utilisateur et de l'ID de la candidature
  fetch(
    `http://127.0.0.1:8000/api/user-dashboard/${userId}/candidature/${candidatureId}`
  )
    .then((response) => response.json())
    .then((data) => {
      console.log(data);

      // Récupère l'élément HTML représentant la candidature
      let candidatureElement = document.querySelector(".candidature");

      // Récupère les détails de la candidature
      let candidature = data.candidature[0];

      // Change la couleur de l'élément de candidature en fonction de la couleur récupérée
      candidatureElement.style.backgroundColor = candidature.couleur;

      // Crée les éléments de la table pour afficher les détails de la candidature
      let tr = document.createElement("tr");

      let td1 = document.createElement("td");
      td1.textContent = candidature.nomEntreprise;

      let td2 = document.createElement("td");
      td2.textContent = candidature.titre;

      let td3 = document.createElement("td");
      let descriptionParagraph = document.createElement("p");
      descriptionParagraph.className = "description";
      descriptionParagraph.textContent =
        "Description: " + candidature.description;
      td3.appendChild(descriptionParagraph);

      let td4 = document.createElement("td");
      td4.textContent = candidature.libelle;

      let td5 = document.createElement("td");
      td5.textContent = candidature.libelleStatus;

      let td6 = document.createElement("td");
      td6.textContent = candidature.cv;

      let td7 = document.createElement("td");
      td7.textContent = candidature.lettreMotivation;

      let td8 = document.createElement("td");
      td8.textContent = candidature.datePostulage;

      // Ajoute les cellules à la ligne (tr)
      tr.appendChild(td1);
      tr.appendChild(td2);
      tr.appendChild(td3);
      tr.appendChild(td4);
      tr.appendChild(td5);
      tr.appendChild(td6);
      tr.appendChild(td7);
      tr.appendChild(td8);

      // Ajoute la ligne avec les détails de la candidature à l'élément de candidature
      candidatureElement.appendChild(tr);
    })
    .catch((error) => {
      console.error("Error:", error);
    });
});
