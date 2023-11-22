document.addEventListener("DOMContentLoaded", () => {
  // Récupère l'ID de l'utilisateur actuel à partir de l'attribut "data-user-id"
  const userId = document.body.dataset.userId;

  // Envoie une requête à l'API pour obtenir les types de contrat
  fetch(`http://127.0.0.1:8000/api/go-to-form-annonce`)
    .then((response) => response.json())
    .then((data) => {
      // Sélectionne l'élément de liste déroulante pour les types de contrat
      const selectElement = document.getElementById("typeContrat");

      // Parcourt les types de contrat et crée des options pour la liste déroulante
      data.typeContrat.forEach((type) => {
        const option = document.createElement("option");
        option.value = type.id;
        option.innerText = type.libelle;

        selectElement.appendChild(option);
      });

      // Ajoute un gestionnaire d'événements pour le formulaire d'annonce
      document.querySelector("form").addEventListener("submit", (e) => {
        e.preventDefault();

        // Récupère les données du formulaire
        const formData = {
          titre: document.getElementById("titre").value,
          description: document.getElementById("description").value,
          typeContrat: document.getElementById("typeContrat").value,
          salaireMin: document.getElementById("salaireMin").value,
          salaireMax: document.getElementById("salaireMax").value,
          duree: document.getElementById("duree").value,
          adresse: document.getElementById("adresse").value,
          ville: document.getElementById("ville").value,
          codePostal: document.getElementById("codePostal").value,
          dateDebut: document.getElementById("dateDebut").value,
          dateFin: document.getElementById("dateFin").value,
          idUser: userId,
        };

        // Envoie les données du formulaire à l'API pour créer une annonce
        fetch(`http://127.0.0.1:8000/api/create-annonce`, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(formData),
        })
          .then((response) => response.json())
          .then((data) => {
            console.log(data);

            // Si la création est réussie, redirige l'utilisateur vers son tableau de bord et affiche une alerte
            if (data.success) {
              window.location.href = `/RecruteurDashboard/${userId}`;
              alert("Annonce créée");
            } else {
              alert("Erreur lors de la création de l'annonce");
            }
          })
          .catch((error) => {
            console.error("Erreur lors de la création de l'annonce:", error);
          });
      });
    });
});
