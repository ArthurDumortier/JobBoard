// Attend que le document HTML soit entièrement chargé avant d'exécuter le code
document.addEventListener("DOMContentLoaded", function () {
  // Récupère l'ID de l'utilisateur à partir de l'attribut de données (data-user-id)
  const userId = document.body.dataset.userId;

  // Effectue une requête pour obtenir les données du tableau de bord du recruteur
  fetch(`http://127.0.0.1:8000/api/recruteur-dashboard/${userId}`)
    .then((response) => response.json())
    .then((data) => {
      console.log(data);

      // Affiche le nom et le prénom de l'utilisateur
      document.getElementById("nomPrenom").innerText =
        data.user[0].lastName + " " + data.user[0].firstName;

      // Récupère l'élément d'en-tête pour les actions liées à l'entreprise
      let entrepriseHeaderElement = document.getElementById("entreprise");

      // Si l'utilisateur appartient à une entreprise, affiche un lien pour voir les informations de l'entreprise
      if (data.user[0].nomEntreprise != null) {
        const a1 = document.createElement("a");
        a1.href = `/EntrepriseInfo/${data.user[0].idEntreprise}`;
        a1.className = "nav-link buttonInscription";
        a1.textContent = "Voir info entreprise";
        entrepriseHeaderElement.appendChild(a1);
      }
      // Sinon, affiche un lien pour rejoindre une entreprise
      else {
        const a2 = document.createElement("a");
        a2.href = `/RecruteurDashboard/${userId}/Choose`;
        a2.className = "nav-link buttonInscription";
        a2.textContent = "Rejoindre une entreprise";
        entrepriseHeaderElement.appendChild(a2);
      }

      // Met à jour le nom et prénom de l'utilisateur (double assignation)
      document.getElementById("nomPrenom").innerText =
        data.user[0].lastName + " " + data.user[0].firstName;

      // Affiche des actions en fonction de l'état actif de l'utilisateur et de son appartenance à une entreprise
      if (data.user[0].isActive === 0 && data.user[0].nomEntreprise != null) {
        document.getElementById("demande").innerHTML = `
          <div class="col-md-12">
              <div>
                  <p>Vous n'avez pas encore de droits :</p>
                  <p>Faire une demande : <a href="#" class="buttonInscription">Obtenir les droits</a></p>
              </div>
          </div>
          `;
      } else if (
        data.user[0].isActive === 0 &&
        data.user[0].nomEntreprise == null
      ) {
        document.getElementById("demande").innerHTML = `
          <div class="col-md-12">
              <div>
                  <p>Vous n'avez pas encore d'entreprise :</p>
                  <p>Faire une demande : <a href="/RecruteurDashboard/${userId}/Choose"  class="buttonInscription">Rejoindre une entreprise</a></p>
                  <p>Ou : <a href="/FormCreateCorporate"  class="buttonInscription">Créer votre propre entreprise</a></p>
              </div>
          </div>
          `;
      } else {
        document.getElementById("demande").innerHTML = `
          <div class="col-md-12">
              <div>
                  <p>Vous avez les droits :</p>
                  <p><a href="/GoToFormAnnonce" class="buttonInscription">Créer une annonce</a></p>
              </div>
          </div>
          `;
      }

      // Affiche les annonces créées par l'entreprise
      const annoncesContainer = document.querySelector(".annonces");

      if (data.annonces.length === 0 && data.user[0].nomEntreprise === null) {
        annoncesContainer.innerHTML = `
          <p>Tu n'as pas d'annonce créée, tu ne fais pas partie d'une entreprise</p>
          `;
      } else if (data.annonces.length === 0) {
        annoncesContainer.innerHTML = `
          <p>Tu n'as pas d'annonce créée</p>
          `;
      } else {
        data.annonces.forEach((annonce) => {
          const div = document.createElement("div");
          div.className = "annonce";

          const h5 = document.createElement("h5");
          h5.innerText = annonce.titre;

          const p = document.createElement("p");
          const aLearnMore = document.createElement("a");
          aLearnMore.className = "learn-more-button";

          // Affiche une partie de la description avec un lien pour en savoir plus
          const halfDescription = annonce.description.substring(0, 100);
          p.className = "description";
          p.innerText = halfDescription;
          aLearnMore.innerText = "Learn more";
          aLearnMore.addEventListener("click", function () {
            p.innerText = annonce.description;
            p.appendChild(aLearnMore);
          });

          const a = document.createElement("a");
          a.href = `/AnnonceInfo/${annonce.id}`;

          const buttonVoir = document.createElement("button");
          buttonVoir.className = "buttonInscription";
          buttonVoir.textContent = "Voir Candidature";

          a.appendChild(buttonVoir);
          div.appendChild(h5);
          div.appendChild(p);
          div.appendChild(a);

          // Si l'utilisateur a des droits actifs (est un recruteur), affiche un bouton pour supprimer l'annonce
          if (data.user[0].isActive === 1) {
            const buttonDelete = document.createElement("button");
            buttonDelete.className = "btn btn-danger";
            buttonDelete.textContent = "Supprimer la tâche";

            const buttonEdit = document.createElement("button");
            buttonEdit.className = "buttonInscription";
            buttonEdit.textContent = "Modifier la tâche";

            // Ajout d'un gestionnaire d'événement pour modifier l'annonce
            buttonEdit.addEventListener("click", function () {
              window.location.href = `/UpdateAnnonce/${annonce.id}`;
            });

            // Ajoute un gestionnaire d'événement pour supprimer l'annonce
            buttonDelete.addEventListener("click", function () {
              deleteAnnonce(annonce.id);
            });

            div.appendChild(buttonEdit);
            div.appendChild(buttonDelete);
          }

          annoncesContainer.appendChild(div);
        });
      }
    });

  // Fonction pour supprimer une annonce
  function deleteAnnonce(annonceId) {
    fetch("http://127.0.0.1:8000/api/delete-annonce", {
      method: "DELETE",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        idAnnonce: annonceId,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.status === "success") {
          window.location.reload();
          alert("Annonce supprimée");
        } else {
          alert("Erreur lors de la suppression de l'annonce");
        }
      });
  }
});
