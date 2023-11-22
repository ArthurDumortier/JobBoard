document.addEventListener("DOMContentLoaded", function () {
  // Récupère l'ID de l'annonce à partir de l'URL
  const idAnnonce = window.location.pathname.split("/").pop();
  // Récupère l'ID de l'utilisateur actuel
  const idUser = document.body.dataset.userId;
  const userRole = document.body.dataset.userRole;

  // Récupère les données de l'annonce à modifier depuis l'API
  fetch(`http://127.0.0.1:8000/api/get-annonce/${idAnnonce}`)
    .then((response) => response.json())
    .then((data) => {
      // Remplit le formulaire avec les données de l'annonce
      document.getElementById("idAnnonce").value = data.annonce.id;
      document.getElementById("titre").value = data.annonce.titre;
      document.getElementById("description").value = data.annonce.description;

      // Ajoute les options de type de contrat au formulaire et sélectionne celle correspondant à l'annonce
      let typeContratList = document.getElementById("typeContrat");
      data.typeContrat.forEach((type) => {
        let doc = document.createElement("option");
        doc.value = type.id;
        doc.innerText = type.libelle;
        typeContratList.appendChild(doc);
        if (data.annonce.typeContratId == type.id) {
          typeContratList.selectedIndex = doc.index;
        }
      });

      document.getElementById("salaireMin").value = data.annonce.salaireMinAn;
      document.getElementById("salaireMax").value = data.annonce.salaireMaxAn;
      document.getElementById("duration").value = data.annonce.duree;
      document.getElementById("adresse").value = data.annonce.adresse;
      document.getElementById("ville").value = data.annonce.ville;
      document.getElementById("codePostal").value = data.annonce.codePostal;
      document.getElementById("adresse").value = data.annonce.adresse;
    });

  // Ajoute un gestionnaire d'événements pour soumettre le formulaire
  document.querySelector("form").addEventListener("submit", function (e) {
    e.preventDefault();

    // Récupère les données du formulaire
    const formData = new FormData(this);
    const jsonData = {};
    for (const [key, value] of formData.entries()) {
      jsonData[key] = value;
    }

    // Envoie les données mises à jour de l'annonce à l'API
    fetch("http://127.0.0.1:8000/api/update-annonce", {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(jsonData),
    })
      .then((response) => response.json())
      .then((data) => {
        console.log(data.status);
        if (data.status) {
          alert("Annonce modifiée");
          if (userRole == 1) {
            window.location.href = `/AdministrateurDashboard/${idUser}/annonce`;
          } else if (userRole == 3) {
            window.location.href = `/RecruteurDashboard/${idUser}`;
          }
        } else {
          alert("Erreur lors de la modification de l'annonce");
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });
});
