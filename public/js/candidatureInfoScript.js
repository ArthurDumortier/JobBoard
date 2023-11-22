document.addEventListener("DOMContentLoaded", function () {
  // Obtient l'ID du postulant à partir de l'URL
  const postuleurId = window.location.pathname.split("/").pop();

  // Envoie une requête pour obtenir des informations sur la candidature
  fetch(`http://127.0.0.1:8000/api/candidature-info/${postuleurId}`)
    .then((response) => response.json())
    .then((data) => {
      console.log(data);

      // Affiche les détails de la candidature
      document.querySelectorAll(".firstName").forEach((element) => {
        if (data.candidature.idUser != null) {
          element.innerText = data.candidature.prenomUser;
        } else {
          element.innerText = data.candidature.firstName;
        }
      });

      document.querySelectorAll(".lastName").forEach((element) => {
        if (data.candidature.idUser != null) {
          element.innerText = data.candidature.nomUser;
        } else {
          element.innerText = data.candidature.lastName;
        }
      });

      document.getElementById("cv").innerText = data.candidature.cv;

      document.getElementById("lettreMotivation").innerText =
        data.candidature.lettreMotivation;

      document.getElementById("idUser").value = data.candidature.idUser;
      document.getElementById("idAnnonce").value = data.candidature.idAnnonce;

      const selectElement = document.getElementById("idStatus");

      // Remplit le menu déroulant avec les réponses possibles
      data.reponses.forEach((reponse) => {
        const option = document.createElement("option");
        option.value = reponse.id;
        option.style.backgroundColor = reponse.couleur;
        option.innerText = reponse.libelleStatus;

        selectElement.appendChild(option);
      });

      // Ajoute un gestionnaire d'événements pour le formulaire
      document.querySelector("form").addEventListener("submit", (e) => {
        e.preventDefault();

        // Récupère les données du formulaire
        const formData = {
          idUser: document.getElementById("idUser").value,
          idAnnonce: document.getElementById("idAnnonce").value,
          idStatus: document.getElementById("idStatus").value,
        };

        // Envoie une requête pour mettre à jour la candidature
        fetch(`http://127.0.0.1:8000/api/candidature-response`, {
          method: "PUT",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(formData),
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.status === "success") {
              // Redirige vers la page de l'annonce
              window.location.href = `/AnnonceInfo/${formData.idAnnonce}`;
              alert("Candidature modifiée");
            } else {
              alert("Erreur lors de la modification de la candidature");
            }
          });
      });
    });
});
