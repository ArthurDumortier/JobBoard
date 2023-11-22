document.addEventListener("DOMContentLoaded", function () {
  let body = document.querySelector(".container-all");
  let annonceElement = document.querySelector(".container-description");
  const userId = document.body.dataset.userId;

  //Récupération des données
  fetch(`http://127.0.0.1:8000/api/annonces`)
    .then((response) => response.json())
    .then((data) => {
      //Condition vérifiant sur la base de données contenantt des annonces
      //si elle est vide on l'indique
      //sinon on rempli le tableau par les données
      if (data == "") {
        document.querySelector("h1.admin-page-title").style.display = "none";
        document.querySelector("table").style.display = "none";
        let empty = document.createElement("p");
        empty.innerText = "Votre base de donnée d'utilisateurs est vide.";
        body.appendChild(empty);
      } else {
        data.forEach((value) => {
          //Ajout des éléments pour les intégrer au DOM par la suite
          let tr = document.createElement("tr");

          const td1 = document.createElement("td");
          td1.innerText = value.titre;

          const td2 = document.createElement("td");
          const smallDescription = value.description.substring(0, 50);
          td2.innerText = smallDescription;

          td2.addEventListener("click", function () {
            td2.innerText = value.description;
          });
          const td3 = document.createElement("td");
          td3.innerText = value.entrepriseId;

          const td4 = document.createElement("td");
          td4.innerText = value.typeContratId;

          const td5 = document.createElement("td");
          td5.innerText = value.salaireMinAn;

          const td6 = document.createElement("td");
          td6.innerText = value.salaireMaxAn;

          const td7 = document.createElement("td");
          td7.innerText = value.creationDate;

          const td8 = document.createElement("td");
          td8.innerText = value.duree;

          const td9 = document.createElement("td");
          td9.innerText = value.adresse;

          const td10 = document.createElement("td");
          td10.innerText = value.ville;

          const td11 = document.createElement("td");
          td11.innerText = value.codePostal;

          const td12 = document.createElement("td");
          td12.innerText = value.idUser;

          const td13 = document.createElement("td");
          td13.innerText = value.dateDebut;

          const td14 = document.createElement("td");
          td14.innerText = value.dateFin;

          //création du bouton de modifications
          let tdModified = document.createElement("td");
          let a1 = document.createElement("a");
          a1.href = `/UpdateAnnonce/${value.id}`;
          a1.classList.add("modifie");
          a1.innerText = "Modifier";
          tdModified.appendChild(a1);

          //Bouton permettant la modification des données sur l'annonce
          tdModified.addEventListener("click", function () {
            modifieAnnonce(value.id);
          });

          //création du bouton de suppression
          let tdDelete = document.createElement("td");
          let a2 = document.createElement("a");
          a2.href = `#`;
          a2.classList.add("delete");
          a2.innerText = "Delete";
          tdDelete.appendChild(a2);
          //suppression de l'annonce lors du clique sur le bouton
          tdDelete.addEventListener("click", function () {
            deleteAnnonce(value.id);
          });

          //Ajout des éléments à l'élément tr
          tr.appendChild(td1);
          tr.appendChild(td2);
          tr.appendChild(td3);
          tr.appendChild(td4);
          tr.appendChild(td5);
          tr.appendChild(td6);
          tr.appendChild(td7);
          tr.appendChild(td8);
          tr.appendChild(td9);
          tr.appendChild(td10);
          tr.appendChild(td11);
          tr.appendChild(td12);
          tr.appendChild(td13);
          tr.appendChild(td14);
          tr.appendChild(tdModified);
          tr.appendChild(tdDelete);

          //Ajout des éléments au DOM
          annonceElement.appendChild(tr);
        });
      }
    });

  //création d'une fonction pour que l'administrateur puisse modifier une annonce
  function modifieAnnonce(idAnnonce) {
    fetch("http://127.0.0.1:8000/api/modifie-annonce", {
      method: "UPDATE",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        idAnnonce: idAnnonce,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.status === true) {
          window.location.reload();
          alert("annonce modifiée");
        } else {
          alert("Erreur lors de la modification de l'annonce");
        }
      });
  }

  //création d'une fonction pour que l'administrateur puisse supprimer une annonce
  function deleteAnnonce(idAnnonce) {
    fetch("http://127.0.0.1:8000/api/delete-annonce", {
      method: "DELETE",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        idAnnonce: idAnnonce,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.status === "success") {
          window.location.reload();
          alert("Annonce supprimé");
        } else {
          alert("Erreur lors de la suppression de l'annonce");
        }
      });
  }
});
