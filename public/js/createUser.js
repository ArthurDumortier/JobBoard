document.addEventListener("DOMContentLoaded", function () {
  fetch(`http://127.0.0.1:8000/api/getrole`)
    .then((response) => response.json())
    .then((data) => {
      const select = document.getElementById("role");
      data.role.forEach((r) => {
        const option = document.createElement("option");
        option.value = r.id;
        option.innerText = r.libelle;
        select.appendChild(option);
      });
    });
  document.querySelector("form").addEventListener("submit", function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    const jsonData = {};
    for (const [key, value] of formData.entries()) {
      jsonData[key] = value;
    }
    console.log(JSON.stringify(jsonData));
    fetch("http://127.0.0.1:8000/api/create-user", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(jsonData),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.status) {
          alert("Utilisateur créé");
          window.location.href = `/AdministrateurDashboard/${document.body.dataset.userId}/user`;
        } else {
          alert("Erreur lors de la création de l'utilisateur");
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });
});
