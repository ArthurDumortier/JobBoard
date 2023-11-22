document.addEventListener("DOMContentLoaded", function () {
  // Récupère l'ID de l'entreprise à partir de l'URL
  const idEntreprise = window.location.pathname.split("/").pop();
  // Récupère l'ID de l'utilisateur actuel
  const idUser = document.body.dataset.userId;

  // Récupère les données de l'entreprise à partir de l'API
  fetch(`http://127.0.0.1:8000/api/get-entreprise/${idEntreprise}`)
    .then((response) => response.json())
    .then((data) => {
      console.log(data); // Affiche les données de l'entreprise dans la console

      // Remplit le formulaire avec les données de l'entreprise
      document.getElementById("idEntreprise").value = data.entreprise.id;
      document.getElementById("entrepriseName").value =
        data.entreprise.nomEntreprise;
      document.getElementById("description").value =
        data.entreprise.descriptionEntreprise;
      document.getElementById("siegeSocial").value =
        data.entreprise.siegeSocial;
      document.getElementById("nombreSalaries").value =
        data.entreprise.nbSalarie;
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

    // Envoie les données mises à jour de l'entreprise à l'API
    fetch("http://127.0.0.1:8000/api/update-entreprise", {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(jsonData),
    })
      .then((response) => response.json())
      .then((data) => {
        console.log(data.status); // Affiche le statut de la mise à jour dans la console

        if (data.status) {
          alert("Entreprise modifiée");
          window.location.href = `/AdministrateurDashboard/${idUser}/entreprise`;
        } else {
          alert("Erreur lors de la modification de l'entreprise");
        }
      })
      .catch((error) => {
        console.error("Error:", error); // Affiche des erreurs dans la console en cas de problème
      });
  });
});
