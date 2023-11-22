document.addEventListener("DOMContentLoaded", function () {
  let body = document.querySelector(".container-all");
  let entrepriseElement = document.querySelector(".container-description");
  const userId = document.body.dataset.userId;

  //Récupération des données
  fetch(`http://127.0.0.1:8000/api/entreprise`)
    .then((response) => response.json())
    .then((data) => {
      //Condition vérifiant sur la base de données contenant des entreprises
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
          td1.innerText = value.nomEntreprise;

          const td2 = document.createElement("td");
          td2.innerText = value.descriptionEntreprise;

          const td3 = document.createElement("td");
          td3.innerText = value.siegeSocial;

          const td5 = document.createElement("td");
          td5.innerText = value.nbSalarie;

          const td6 = document.createElement("td");
          td6.innerText = value.date_creation;

          //création du bouton de modifications
          let tdModified = document.createElement("td");
          let a1 = document.createElement("a");
          a1.href = `/UpdateEntreprise/${value.id}`;
          a1.classList.add("modifie");
          a1.innerText = "Modifier";
          tdModified.appendChild(a1);

          //Bouton permettant la modification des données sur l'annonce
          tdModified.addEventListener("click", function () {
            modifieEntreprise(value.id);
          });

          //création du bouton de suppression
          let tdDelete = document.createElement("td");
          let a2 = document.createElement("a");
          a2.href = `#`;
          a2.classList.add("delete");
          a2.innerText = "Delete";
          tdDelete.appendChild(a2);

          //suppression de l'entreprise lors du clique sur le bouton
          tdDelete.addEventListener("click", function () {
            deleteEntreprise(value.id);
          });

          //Ajout des éléments à l'élément tr
          tr.appendChild(td1);
          tr.appendChild(td2);
          tr.appendChild(td3);
          tr.appendChild(td5);
          tr.appendChild(td6);
          tr.appendChild(tdModified);
          tr.appendChild(tdDelete);

          //Ajout des éléments au DOM
          entrepriseElement.appendChild(tr);
        });
      }
    });

  //création d'une fonction pour que l'administrateur puisse modifier une entreprise
  function modifieEntreprise(idEntreprise) {
    fetch("http://127.0.0.1:8000/api/modifie-entreprise", {
      method: "UPDATE",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        idEntreprise: idEntreprise,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.status === true) {
          window.location.reload();
          alert("Entreprise modifiée");
        } else {
          alert("Erreur lors de la modification de l'entreprise");
        }
      });
  }

  //création d'une fonction pour que l'administrateur puisse supprimer une entreprise
  function deleteEntreprise(idEntreprise) {
    fetch("http://127.0.0.1:8000/api/delete-entreprise", {
      method: "DELETE",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        idEntreprise: idEntreprise,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
        if (data.status === true) {
          window.location.reload();
          alert("Entreprise supprimée");
        } else {
          alert("Erreur lors de la suppression de l'entreprise");
        }
      });
  }
});
