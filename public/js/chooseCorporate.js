document.addEventListener("DOMContentLoaded", function () {
  // Obtient l'ID de l'utilisateur connecté
  const userId = document.body.dataset.userId;
  fetch(`http://127.0.0.1:8000/api/recruteur-dashboard/${userId}/choose`)
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
      let corporateInput = document.getElementById("inputCorporate");
      // Fonction de recherche d'entreprise dynamiquement (envoie une requête POST à l'API)
      function SearchCorporate() {
        fetch("http://127.0.0.1:8000/api/search-corporate", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            nameCorporate: corporateInput.value,
          }),
        })
          .then((response) => response.json())
          .then((data) => {
            const resultsSection = document.getElementById("resultsSection");
            if (data.corporates !== null && data.corporates.length > 0) {
              resultsSection.innerHTML = "";
              data.corporates.forEach((result) => {
                resultsSection.innerHTML += `
                  <div class="corporate">
                    <h3>${result.nomEntreprise}</h3>
                    <a href="#" class="requestJoin" data-id="${result.id}">Faire la demande</a>
                  </div>
                `;
              });

              const requestJoinLinks =
                document.querySelectorAll(".requestJoin");

              requestJoinLinks.forEach((link) => {
                link.addEventListener("click", function (event) {
                  event.preventDefault();
                  const idCorporate = event.target.getAttribute("data-id");
                  RequestJoin(idCorporate);
                });
              });
            } else {
              resultsSection.innerHTML = "<p>Aucun résultat trouvé.</p>";
            }
          })
          .catch((error) =>
            console.error("Erreur lors de la récupération des données:", error)
          );
      }

      // Fonction de demande de rejoindre une entreprise par un recruteur (envoie une requête POST à l'API)
      function RequestJoin(idCorporate) {
        fetch("http://127.0.0.1:8000/api/request-join-corporate", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            idEntreprise: idCorporate,
            idUser: userId,
          }),
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.status) {
              alert("Demande envoyée");
              window.location.href = `/RecruteurDashboard/${userId}`;
            } else {
              alert("Une erreur est survenue");
            }
          })
          .catch((error) =>
            console.error("Erreur lors de la récupération des données:", error)
          );
      }

      if (corporateInput !== null) {
        corporateInput.addEventListener("input", SearchCorporate);
      }
    });
});
