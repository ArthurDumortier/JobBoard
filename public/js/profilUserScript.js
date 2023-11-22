// Attend que le document HTML soit entièrement chargé avant d'exécuter le code
document.addEventListener("DOMContentLoaded", function () {
  // Récupère l'élément body et les attributs de l'utilisateur et du rôle depuis le HTML
  const bodyElement = document.body;
  const userId = bodyElement.getAttribute("data-user-id");
  const userRole = bodyElement.getAttribute("data-user-role");
  let fetchUrl;

  // Détermine l'URL de l'API en fonction du rôle de l'utilisateur
  if (userRole == 1) {
    fetchUrl = `http://127.0.0.1:8000/api/admin-dashboard/${userId}/profile`;
  } else if (userRole == 2) {
    fetchUrl = `http://127.0.0.1:8000/api/user-dashboard/${userId}/profile`;
  } else {
    fetchUrl = `http://127.0.0.1:8000/api/recruteur-dashboard/${userId}/profile`;
  }

  // Effectue une requête pour obtenir les informations de l'utilisateur
  fetch(fetchUrl)
    .then((response) => response.json())
    .then((data) => {
      // Afficher des boutons en fonction du rôle de l'utilisateur
      let entrepriseHeaderElement = document.getElementById("entreprise");
      if (data.user[0].nomEntreprise != null && userRole == 3) {
        const a1 = document.createElement("a");
        a1.href = `/EntrepriseInfo/${data.user[0].idEntreprise}`;
        a1.className = "nav-link buttonInscription";
        a1.textContent = "Voir info entreprise";
        entrepriseHeaderElement.appendChild(a1);
      } else if (userRole == 3) {
        const a2 = document.createElement("a");
        a2.href = `/RecruteurDashboard/${userId}/Choose`;
        a2.className = "nav-link buttonInscription";
        a2.textContent = "Rejoindre une entreprise";
        entrepriseHeaderElement.appendChild(a2);
      }

      // Afficher les données de l'utilisateur
      if (data.user[0].isActive == 0) {
        data.user[0].isActive = "Non";
      } else {
        data.user[0].isActive = "Oui";
      }

      const userElement = document.querySelector(".user");
      userElement.innerHTML = `
      <div class="infoUser">
        <p>Identifiant: ${data.user[0].identifiant}</p>
        <p>Adresse: ${data.user[0].adresse}</p>
        <p>Code Postal: ${data.user[0].codepostal}</p>
        <p>Date de Création: ${data.user[0].date_creation}</p>
        <p>Email: ${data.user[0].email}</p>
        <p>Prénom: ${data.user[0].firstName}</p>
        <p>Nom: ${data.user[0].lastName}</p>
        <p>Ayant droit: ${data.user[0].isActive}</p>
        <p>Nom de l'Entreprise: ${data.user[0].nomEntreprise}</p>
        <p>Pays: ${data.user[0].pays}</p>
        <p>Téléphone: ${data.user[0].telephone}</p>
        <p>Ville: ${data.user[0].ville}</p>
      </div>
      `;

      // Ajouter un bouton pour retirer l'utilisateur de l'entreprise
      if (
        (userRole == 2 || userRole == 3) &&
        data.user[0].idEntreprise != null
      ) {
        const removeUserButton = document.createElement("div");
        removeUserButton.innerHTML = `
          <a href="#"><button class="btn btn-danger" id='removeUser'>Ne plus être membre de l'entreprise</button></a>
        `;

        userElement.appendChild(removeUserButton);
      }

      // Ajouter un gestionnaire d'événement pour le bouton de retrait d'entreprise
      const removeUserButton = document.getElementById("removeUser");
      if (removeUserButton != null) {
        removeUserButton.addEventListener("click", function () {
          removeUserCorporate(userId);
        });
      }

      // Fonction pour retirer l'utilisateur de l'entreprise
      function removeUserCorporate(userId) {
        fetch(`http://127.0.0.1:8000/api/remove-corporate`, {
          method: "put",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            id: userId,
          }),
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.status === "success") {
              alert("Entreprise retirée");
              window.location.reload();
            }
          })
          .catch((error) => {
            console.error(
              "Une erreur s'est produite lors de la modification de l'utilisateur :",
              error
            );
          });
      }
    })
    .catch((error) => {
      console.error(
        "Une erreur s'est produite lors du chargement des données :",
        error
      );
    });
});
// Attend que le document HTML soit entièrement chargé avant d'exécuter le code
document.addEventListener("DOMContentLoaded", function () {
  // Récupère l'élément body et les attributs de l'utilisateur et du rôle depuis le HTML
  const bodyElement = document.body;
  const userId = bodyElement.getAttribute("data-user-id");
  const userRole = bodyElement.getAttribute("data-user-role");
  let fetchUrl;

  // Détermine l'URL de l'API en fonction du rôle de l'utilisateur
  if (userRole == 1) {
    fetchUrl = `http://127.0.0.1:8000/api/admin-dashboard/${userId}/profile`;
  } else if (userRole == 2) {
    fetchUrl = `http://127.0.0.1:8000/api/user-dashboard/${userId}/profile`;
  } else {
    fetchUrl = `http://127.0.0.1:8000/api/recruteur-dashboard/${userId}/profile`;
  }

  // Effectue une requête pour obtenir les informations de l'utilisateur
  fetch(fetchUrl)
    .then((response) => response.json())
    .then((data) => {
      // Afficher des boutons en fonction du rôle de l'utilisateur
      let entrepriseHeaderElement = document.getElementById("entreprise");
      if (data.user[0].nomEntreprise != null && userRole == 3) {
        const a1 = document.createElement("a");
        a1.href = `/EntrepriseInfo/${data.user[0].idEntreprise}`;
        a1.className = "nav-link buttonInscription";
        a1.textContent = "Voir info entreprise";
        entrepriseHeaderElement.appendChild(a1);
      } else if (userRole == 3) {
        const a2 = document.createElement("a");
        a2.href = `/RecruteurDashboard/${userId}/Choose`;
        a2.className = "nav-link buttonInscription";
        a2.textContent = "Rejoindre une entreprise";
        entrepriseHeaderElement.appendChild(a2);
      }

      // Afficher les données de l'utilisateur
      if (data.user[0].isActive == 0) {
        data.user[0].isActive = "Non";
      } else {
        data.user[0].isActive = "Oui";
      }

      const userElement = document.querySelector(".user");
      userElement.innerHTML = `
      <div class="infoUser">
        <p>Identifiant: ${data.user[0].identifiant}</p>
        <p>Adresse: ${data.user[0].adresse}</p>
        <p>Code Postal: ${data.user[0].codepostal}</p>
        <p>Date de Création: ${data.user[0].date_creation}</p>
        <p>Email: ${data.user[0].email}</p>
        <p>Prénom: ${data.user[0].firstName}</p>
        <p>Nom: ${data.user[0].lastName}</p>
        <p>Ayant droit: ${data.user[0].isActive}</p>
        <p>Nom de l'Entreprise: ${data.user[0].nomEntreprise}</p>
        <p>Pays: ${data.user[0].pays}</p>
        <p>Téléphone: ${data.user[0].telephone}</p>
        <p>Ville: ${data.user[0].ville}</p>
      </div>
      `;

      // Ajouter un bouton pour retirer l'utilisateur de l'entreprise
      if (
        (userRole == 2 || userRole == 3) &&
        data.user[0].idEntreprise != null
      ) {
        const removeUserButton = document.createElement("div");
        removeUserButton.innerHTML = `
          <a href="#"><button class="btn btn-danger" id='removeUser'>Ne plus être membre de l'entreprise</button></a>
        `;

        userElement.appendChild(removeUserButton);
      }

      // Ajouter un gestionnaire d'événement pour le bouton de retrait d'entreprise
      const removeUserButton = document.getElementById("removeUser");
      if (removeUserButton != null) {
        removeUserButton.addEventListener("click", function () {
          removeUserCorporate(userId);
        });
      }

      // Fonction pour retirer l'utilisateur de l'entreprise
      function removeUserCorporate(userId) {
        fetch(`http://127.0.0.1:8000/api/remove-corporate`, {
          method: "put",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            id: userId,
          }),
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.status === "success") {
              alert("Entreprise retirée");
              window.location.reload();
            }
          })
          .catch((error) => {
            console.error(
              "Une erreur s'est produite lors de la modification de l'utilisateur :",
              error
            );
          });
      }
    })
    .catch((error) => {
      console.error(
        "Une erreur s'est produite lors du chargement des données :",
        error
      );
    });
});
