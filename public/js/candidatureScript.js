document.addEventListener("DOMContentLoaded", function () {
  // Obtient l'ID de l'utilisateur connecté
  const userId = document.body.dataset.userId;

  // Envoie une requête pour obtenir les informations sur les candidatures de l'utilisateur
  fetch(`http://127.0.0.1:8000/api/user-dashboard/${userId}/candidature`)
    .then((response) => response.json())
    .then((data) => {
      console.log(data);

      if (data.candidatures.length == 0) {
        // S'il n'y a pas de candidatures, masque la table et affiche un message
        document.querySelector("table").style.display = "none";
        let h4 = document.createElement("h4");
        h4.innerHTML = "<p>Vous n'avez pas encore postulé à une annonce</p>";
        document.querySelector(".col-md-12").appendChild(h4);
      }

      // Affiche les candidatures de l'utilisateur dans le tableau
      let candidatureElement = document.querySelector(".candidatures");
      data.candidatures.forEach((candidature) => {
        const tr = document.createElement("tr");
        const td1 = document.createElement("td");
        const a1 = document.createElement("a");
        a1.href = `/EntrepriseInfo/${candidature.idEntreprise}`;
        a1.textContent = candidature.nomEntreprise;
        td1.appendChild(a1);

        const td2 = document.createElement("td");
        td2.innerText = candidature.titre;

        const td3 = document.createElement("td");
        td3.innerText = candidature.libelle;

        const td4 = document.createElement("td");
        td4.style.backgroundColor = candidature.couleur;
        td4.textContent = candidature.libelleStatus;

        const td5 = document.createElement("td");
        const a2 = document.createElement("a");
        a2.href = `/UtilisateurDashboard/${userId}/candidature/${candidature.idAnnonce}`;
        a2.textContent = "Voir";
        td5.appendChild(a2);

        tr.appendChild(td1);
        tr.appendChild(td2);
        tr.appendChild(td3);
        tr.appendChild(td4);
        tr.appendChild(td5);

        candidatureElement.appendChild(tr);
      });
    });
});
