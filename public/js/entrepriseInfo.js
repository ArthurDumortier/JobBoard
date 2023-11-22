// Attend que le document HTML soit entièrement chargé avant d'exécuter le code
document.addEventListener("DOMContentLoaded", function () {
  // Récupère l'identifiant de l'entreprise à partir de l'URL
  const idEntreprise = window.location.pathname.split("/").pop();

  // Effectue une requête pour obtenir les informations de l'entreprise
  fetch(`http://127.0.0.1:8000/api/entreprise-info/${idEntreprise}`)
    .then((response) => response.json())
    .then((data) => {
      // Redirige vers une page d'erreur 404 si aucune entreprise n'est trouvée
      if (data.entreprise === null) {
        window.location.replace("/404");
      }

      // Afficher les informations de l'entreprise
      document.getElementById("nomEntreprise").innerText =
        data.entreprise.nomEntreprise || "non définie";
      document.getElementById("descriptionEntreprise").innerText =
        data.entreprise.descriptionEntreprise || "non définie";
      document.getElementById("nbSalarie").innerText =
        data.entreprise.nbSalarie || "non définie";
      document.getElementById("siegeSocial").innerText =
        data.entreprise.siegeSocial || "non définie";
      document.getElementById("nbOffres").innerText =
        data.nbOffres || "Aucune annonce";

      // Afficher les salariés de l'entreprise
      const salariesContainer = document.querySelector(".salaries");
      const div = document.createElement("div");
      div.className = "salarie";
      div.innerHTML = `
          <p>Voici les personnes présentes dans l'entreprise :</p>
      `;
      data.salaries.forEach((salarie) => {
        // Convertit l'état d'activité en texte lisible
        if (salarie.isActive === 1) {
          salarie.isActive = "Recruteur";
        } else if (salarie.isActive === 0) {
          salarie.isActive = "Non recruteur";
        }

        const divInfoSalarie = document.createElement("div");
        divInfoSalarie.className = "infoSalarie";
        divInfoSalarie.innerHTML = `
        <div>
          ${salarie.firstName || "non définie"} ${
          salarie.lastName || "non définie"
        }
        </div>
        <div>
            Mail : ${salarie.email || "non définie"}
        </div>
        <div>
            Tel : ${salarie.telephone || "non définie"}
        </div>
        <div>
            Status : ${salarie.isActive || "non définie"}
        </div>
        <br>
        `;
        div.appendChild(divInfoSalarie);
        salariesContainer.appendChild(div);
      });

      // Afficher les domaines d'activité de l'entreprise
      const domainesContainer = document.querySelector(".infoDomaines");
      if (data.domaines.length === 0) {
        domainesContainer.style.display = "none"; // Masque la section s'il n'y a pas de domaines
      } else {
        domainesContainer.innerHTML = "Voici les domaines d'activité :";
        data.domaines.forEach((domaine) => {
          const div = document.createElement("div");
          div.className = "domaine";
          div.innerText = domaine.libelle || "non définie";
          domainesContainer.appendChild(div);
        });
      }

      // Afficher les réseaux sociaux de l'entreprise
      const reseauxContainer = document.querySelector(".infoReseaux");
      if (data.reseaux.length === 0) {
        reseauxContainer.style.display = "none"; // Masque la section s'il n'y a pas de réseaux sociaux
      }
      data.reseaux.forEach((reseau) => {
        const div = document.createElement("div");
        div.className = "reseau";
        const a = document.createElement("a");
        a.href = reseau.libelleSociaux || "#"; // Lien vers le réseau social
        a.target = "_blank"; // Ouvre le lien dans un nouvel onglet
        a.innerText = reseau.libelleReseaux || "non définie"; // Nom du réseau social
        div.appendChild(a);
        reseauxContainer.appendChild(div);
      });
    })
    .catch((error) => {
      console.error("Error:", error); // Gestion des erreurs
    });
});
