// Attend que le document HTML soit entièrement chargé avant d'exécuter le code
document.addEventListener("DOMContentLoaded", function () {
  let userId;
  // Vérifie si l'URL contient l'ID de l'utilisateur actuel ou si c'est un autre utilisateur
  if (
    window.location.pathname.split("/").pop() == document.body.dataset.userId
  ) {
    userId = document.body.dataset.userId;
  } else {
    userId = window.location.pathname.split("/").pop();
  }
  const userRole = document.body.dataset.userRole;

  // Effectue une requête pour récupérer les données du profil de l'utilisateur
  fetch(`http://127.0.0.1:8000/api/user-dashboard/${userId}/profile`)
    .then((response) => response.json())
    .then((data) => {
      console.log(data);

      // Remplit les champs de formulaire avec les données de l'utilisateur
      document.getElementById("id").value = data.id;
      document.getElementById("identifiant").value = data.user[0].identifiant;
      document.getElementById("email").value = data.user[0].email;
      document.getElementById("firstName").value = data.user[0].firstName;
      document.getElementById("lastName").value = data.user[0].lastName;
      document.getElementById("adresse").value = data.user[0].adresse;
      document.getElementById("ville").value = data.user[0].ville;
      document.getElementById("tel").value = data.user[0].telephone;
    });

  // Ajoute un écouteur d'événement pour gérer la soumission du formulaire
  document.querySelector("form").addEventListener("submit", function (e) {
    e.preventDefault();

    // Récupère les données du formulaire
    const formData = new FormData(this);
    const jsonData = {};
    for (const [key, value] of formData.entries()) {
      jsonData[key] = value;
    }
    console.log(JSON.stringify(jsonData));

    // Effectue une requête pour mettre à jour les données de l'utilisateur
    fetch("http://127.0.0.1:8000/api/update-user", {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(jsonData),
    })
      .then((response) => response.json())
      .then((data) => {
        console.log(data.status);
        // Redirige l'utilisateur en fonction de son rôle et de l'ID
        if (data.status) {
          if (userRole == 1 && userId == document.body.dataset.userId) {
            window.location.href = `/AdministrateurDashboard/${userId}/profil`;
          }
          if (userRole == 1 && userId != document.body.dataset.userId) {
            window.location.href = `/AdministrateurDashboard/${document.body.dataset.userId}/user`;
          }
          if (userRole == 2) {
            window.location.href = `/UtilisateurDashboard/${userId}/profil`;
          }
          if (userRole == 3) {
            window.location.href = `/RecruteurDashboard/${userId}/profil`;
          }
          alert("Utilisateur modifié");
        } else {
          alert("Erreur lors de la modification de l'utilisateur");
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });
});
