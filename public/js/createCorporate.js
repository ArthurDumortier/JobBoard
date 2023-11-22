document.addEventListener("DOMContentLoaded", function () {
  // Obtient l'ID de l'utilisateur connecté depuis les données de l'élément body
  const userId = document.body.dataset.userId;

  // Ajoute un gestionnaire d'événement à la soumission du formulaire
  document.querySelector("form").addEventListener("submit", function (e) {
    e.preventDefault(); // Empêche la soumission par défaut du formulaire

    // Récupère les valeurs du formulaire et les stocke dans un objet JSON
    const formData = {
      idUser: userId,
      nomEntreprise: document.getElementById("nomEntreprise").value,
      descriptionEntreprise: document.getElementById("descriptionEntreprise")
        .value,
      siegeSocial: document.getElementById("siegeSocial").value,
      nbSalarie: document.getElementById("nbSalarie").value,
    };

    // Envoie une requête POST pour créer une nouvelle entreprise
    fetch("http://127.0.0.1:8000/api/create-corporate", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(formData),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.status) {
          window.location.href = `/RecruteurDashboard/${userId}`;
          alert("Entreprise créée");
        } else {
          alert("Erreur lors de la création de l'entreprise");
        }
      })
      .catch((error) => {
        console.error("Erreur lors de la création de l'entreprise:", error);
      });
  });
});
