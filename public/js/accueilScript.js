// Attend que le DOM soit complètement chargé
document.addEventListener("DOMContentLoaded", function () {
  // Effectue une requête GET vers l'API locale
  fetch("http://127.0.0.1:8000/api/")
    .then((response) => response.json()) // Convertit la réponse en JSON
    .then((data) => {
      // Mise à jour du nombre d'annonces affichées
      document.getElementById("nbAnnonces").innerText = data.nbAnnonces;

      // Mise à jour de la liste des types de contrat dans un menu déroulant
      const typeContratList = document.getElementById("typeContrat");
      data.typeContrat.forEach((type) => {
        let doc = document.createElement("option");
        doc.value = type.id;
        doc.innerText = type.libelle;
        typeContratList.appendChild(doc);
      });

      // Sélection des éléments HTML pour la recherche
      let searchInput = document.getElementById("search");
      let villeInput = document.getElementById("ville");
      let typeContratInput = document.getElementById("typeContrat");

      // Fonction de recherche d'annonces
      function SearchAnnonces() {
        const searchValue = searchInput.value;
        const villeValue = villeInput.value;
        const typeContratValue = typeContratInput.value;

        // Effectue une requête POST vers une autre URL pour la recherche
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
          .then((response) => response.json()) // Convertit la réponse en JSON
          .then((data) => {
            // Sélection de la section des résultats
            const resultsSection = document.getElementById("resultsSection");
            if (data.results !== null && data.results.length > 0) {
              // Efface les résultats précédents
              resultsSection.innerHTML = "";
              data.results.forEach((result) => {
                // Ajoute chaque résultat à la section
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

      // Écouteurs d'événements pour la recherche
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
});
