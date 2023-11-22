document.addEventListener("DOMContentLoaded", function () {
  const idAnnonce = window.location.pathname.split("/").pop();
  let bodyElement = document.body;
  let userId = bodyElement.getAttribute("data-user-id");
  let userRole = bodyElement.getAttribute("data-user-role");
  if (userId == null) {
    $fetch = `http://127.0.0.1:8000/api/annonce-info/${idAnnonce}`;
  } else {
    $fetch = `http://127.0.0.1:8000/api/annonce-info/${idAnnonce}?id=${userId}`;
  }

  fetch($fetch, {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      console.log(data);

      document.getElementById("titre").innerText = data.annonce.titre;

      const infoEntreprise = document.getElementById("infoEntreprise");
      infoEntreprise.innerHTML = `
          <a href="/EntrepriseInfo/${data.annonce.entrepriseId}" target="_blank">
              ${data.annonce.nomEntreprise}
          </a>
          <p>${data.annonce.nbSalarie} salariés</p>
        `;

      const infoAnnonce = document.getElementById("infoAnnonce");
      const adresse = data.annonce.adresse || "Adresse non définie";
      const description = data.annonce.description;
      const duree =
        "Durée " + data.annonce.duree + " mois" || "Durée non définie";
      const salaireMinAn = data.annonce.salaireMinAn;
      const salaireMaxAn = data.annonce.salaireMaxAn;
      const ville = data.annonce.ville || "Ville non définie";
      const creationDate = data.annonce.creationDate;
      const dateDebut = data.annonce.dateDebut || "Date de début non définie";
      const dateFin = data.annonce.dateFin || "Date de fin non définie";
      const libelle = data.annonce.libelle;
      const petite_description = description.slice(0, description.length / 3);
      const infoRecruteur = document.getElementById("infoRecruteur");
      const lastName = data.annonce.lastName || "Non défini";
      const firstName = data.annonce.firstName || "Non défini";
      const email = data.annonce.email || "Non défini";
      const tel = data.annonce.telephone || "Non défini";

      infoAnnonce.innerHTML = `
          <div class="description">
              <p class="description">Description : ${petite_description}</p>
              <a href="#" id="learn-more">Voir plus</a>
          </div>
        `;
      if (document.querySelector("#learn-more")) {
        document
          .querySelector("#learn-more")
          .addEventListener("click", function (e) {
            e.preventDefault();
            document.querySelector(".description").innerHTML = `
            <p class="description">Description : ${description}</p>

            <div class="adresse">
              <p>Adresse : ${adresse}</p>
            </div>

            <div class="duree">
              <p>${duree}</p>
            </div>

          <div class="salaire">
              <p>Salaire : ${salaireMinAn}€ - ${salaireMaxAn}€</p>
          </div>

          <div class="ville">
              <p>Ville : ${ville}</p>
          </div>

          <div class="creationDate">
              <p>Date de Création de l'annonce : ${creationDate}</p>
          </div>

          <div class="dateDebut">
              <p>Date de début : ${dateDebut}</p>
          </div>

          <div class="dateFin">
              <p>Date de fin : ${dateFin}</p>
          </div>

          <div class="libelle">
              <p>Type de contrat : ${libelle}</p>
          </div>
        `;
            const infoRecruteur = document.createElement("div");
            infoRecruteur.className = "infoRecruteur";

            infoRecruteur.innerHTML = `
        <div class="recruteur">
          <p>Contact recruteur : </p>
          <div class="lastName">
              <p>Nom : ${lastName}</p>
          </div>
          <div class="firstName">
              <p>Prénom : ${firstName}</p>
          </div>
          <div class="email">
              <p>Email : ${email}</p>
          </div>
          <div class="tel">
              <p>Téléphone : ${tel}</p>
          </div>
        </div>
        `;
            infoAnnonce.appendChild(infoRecruteur);
          });
      }

      const candidaturesContainer = document.querySelector(".candidatures");

      if (userRole == 3 && data.candidatures != null) {
        data.candidatures.forEach((candidature) => {
          const div = document.createElement("div");
          div.className = "candidature";
          console.log(candidature);
          if (candidature.idUser != null) {
            candidature.firstName = candidature.nomUser;
            candidature.lastName = candidature.prenomUser;
          }
          div.innerHTML = `
              <div class="candidat">
              <p>${candidature.firstName} ${candidature.lastName} à postuler le ${candidature.datePostulage}
              <a href="/CandidatureInfo/${candidature.postuleurId}">Voir le profil</a></p>
              </div>
              `;
          candidaturesContainer.appendChild(div);
        });
      } else if (userRole == 3 && data.candidatures == null) {
        candidaturesContainer.innerHTML = `
        <p>Il n'y a pas encore de candidatures</p>
        `;
      }
      const annonceButton = document.getElementById("annonceButton");
      const countPostuler = data.countPostuler;

      if (userId != null && countPostuler == 0 && userRole == 2) {
        annonceButton.innerHTML = `
            <form action="#" method="post" id="formPostuler" class="postuler">
              <div class="formContent">
                <div class="input">
                  <label for="inputCv">C.V</label>
                  <input type="file" id="inputCv" name="inputCv" required>
                </div>
                <div class="input">
                  <label for="inputLettreMotivation">Lettre de motivation</label>
                  <input type="file" id="inputLettreMotivation" name="inputLettreMotivation" required>
                </div>
                <button type="submit" class="nav-link buttonInscription">Postuler</button>
              </div>
            </form>
          `;
      } else if (userId == null) {
        annonceButton.innerHTML = `
            <form action="#" method="post" id="PostulerNonConnecter" class="postuler">
              <div class="formContent">
              <div class="input">
                <label for="firstName">Prénom</label>
                <input type="text" id="firstName" name="firstName" required>
              </div>
              <div class="input">
                <label for="lastName">Nom</label>
                <input type="text" id="lastName" name="lastName" required>
              </div>
              <div class="input">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
              </div>
              <div class="input">
                <label for="inputCv">C.V</label>
                <input type="file" id="inputCv" name="inputCv" required>
              </div>
              <div class="input">
                <label for="inputLettreMotivation">Lettre de motivation</label>
                <input type="file" id="inputLettreMotivation" name="inputLettreMotivation" required>
              </div>
                <button type="submit" class="nav-link buttonInscription">Postuler</button>
              </div>
            </form>
          `;
      } else if (countPostuler != 0 && userRole == 2) {
        annonceButton.innerHTML = `
            <div class="postuler">
                <p>Vous avez déjà postulé à cette annonce</p>
            </div>
          `;
      }

      const formElement = document.getElementById("formPostuler");
      if (formElement != null) {
        document
          .querySelector("#formPostuler")
          .addEventListener("submit", function (e) {
            e.preventDefault();
            const formData = {
              idUser: userId,
              idAnnonce: data.annonce.id,
              inputCv: document.getElementById("inputCv").value,
              inputLettreMotivation: document.getElementById(
                "inputLettreMotivation"
              ).value,
            };
            fetch(`http://127.0.0.1:8000/api/postuler`, {
              method: "POST",
              headers: {
                "Content-Type": "application/json",
              },
              body: JSON.stringify(formData),
            })
              .then((response) => response.json())
              .then((data) => {
                console.log(data);
                if (data.success) {
                  window.location.href = `/AnnonceInfo/${idAnnonce}`;
                  alert("Votre candidature a bien été envoyée");
                } else {
                  alert("Erreur lors de l'envoi de la candidature");
                }
              })
              .catch((error) => {
                console.error(
                  "Erreur lors de l'envoi de la candidature:",
                  error
                );
              });
          });
      }
      const formElementNonConnecter = document.getElementById(
        "PostulerNonConnecter"
      );
      if (formElementNonConnecter != null) {
        document
          .getElementById("PostulerNonConnecter")
          .addEventListener("submit", function (e) {
            e.preventDefault();
            fetch(`http://127.0.0.1:8000/api/postuler-non-connecter`, {
              method: "POST",
              headers: {
                "Content-Type": "application/json",
              },
              body: JSON.stringify({
                idAnnonce: data.annonce.id,
                inputCv: document.getElementById("inputCv").value,
                inputLettreMotivation: document.getElementById(
                  "inputLettreMotivation"
                ).value,
                firstName: document.getElementById("firstName").value,
                lastName: document.getElementById("lastName").value,
                email: document.getElementById("email").value,
              }),
            })
              .then((response) => response.json())
              .then((data) => {
                console.log(data);
                if (data.status) {
                  alert("Votre candidature a bien été envoyée");
                  window.location.reload();
                } else {
                  alert("Erreur lors de l'envoi de la candidature");
                }
              })
              .catch((error) => {
                console.error(
                  "Erreur lors de l'envoi de la candidature:",
                  error
                );
              });
          });
      }
    });
});
