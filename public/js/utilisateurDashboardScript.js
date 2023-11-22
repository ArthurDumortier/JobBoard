// Attend que le document HTML soit entièrement chargé avant d'exécuter le code
document.addEventListener("DOMContentLoaded", function () {
  const userId = document.body.dataset.userId;

  // Effectue une requête pour récupérer les données de l'utilisateur
  fetch(`http://127.0.0.1:8000/api/user-dashboard/${userId}`)
    .then((response) => response.json())
    .then((data) => {
      // Met à jour le nom et prénom de l'utilisateur
      document.getElementById("nomPrenom").innerText =
        data.user[0].firstName + " " + data.user[0].lastName;

      // Met à jour la liste des types de contrat
      const typeContratList = document.getElementById("typeContrat");
      data.typeContrat.forEach((type) => {
        let option = document.createElement("option");
        option.value = type.id;
        option.innerText = type.libelle;
        typeContratList.appendChild(option);
      });
    });

  // Récupère les éléments HTML
  const searchInput = document.getElementById("search");
  const villeInput = document.getElementById("ville");
  const typeContratInput = document.getElementById("typeContrat");

  // Fonction pour effectuer la recherche d'annonces
  function SearchAnnonces() {
    const searchValue = searchInput.value;
    const villeValue = villeInput.value;
    const typeContratValue = typeContratInput.value;

    // Effectue une requête pour rechercher des annonces
    fetch("http://127.0.0.1:8000/api/recherche-annonce-default", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        search: searchValue,
        ville: villeValue,
        typeContrat: typeContratValue,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        const resultsSection = document.getElementById("resultsSection");

        if (data.results !== null && data.results.length > 0) {
          resultsSection.innerHTML = "";
          data.results.forEach((result) => {
            resultsSection.innerHTML += `
                  <div class="vertical-card">
                      <div class="horizontal-card">
                          <a href="/EntrepriseInfo/${result.idEntreprise}" target="_blank">${result.nomEntreprise}</a>
                          <h6>${result.titre}</h6>
                          <p class="description-coupe">${result.description}
                              <a class="learn-more-button" data-description="${result.description}">Learn more</a>
                          </p>
                          <br>
                          <a href="/AnnonceInfo/${result.id}"><button class="nav-link buttonInscription">Voir plus</button></a>
                      </div>
                  </div>
              `;
          });
        } else {
          resultsSection.innerHTML = "<p>Aucun résultat trouvé.</p>";
        }
      })
      .catch((error) =>
        console.error("Erreur lors de la récupération des données:", error)
      );
  }

  // Vérifie si les éléments existent et ajoute des écouteurs d'événements
  if (
    searchInput !== null &&
    villeInput !== null &&
    typeContratInput !== null
  ) {
    searchInput.addEventListener("input", SearchAnnonces);
    villeInput.addEventListener("input", SearchAnnonces);
    typeContratInput.addEventListener("input", SearchAnnonces);
  }
});
