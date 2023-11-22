document.addEventListener("DOMContentLoaded", function () {
  let body = document.querySelector(".container-all");
  let userElement = document.querySelector(".container-description");
  const userId = document.body.dataset.userId;
  //Récupération des données
  fetch(`http://127.0.0.1:8000/api/utilisateur`)
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
      //Condition vérifiant sur la base de données contenant des utilisateurs
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

          let td1 = document.createElement("td");
          td1.innerText = value.identifiant;

          let td2 = document.createElement("td");
          td2.innerText = value.date_creation;

          let td3 = document.createElement("td");
          if (value.roleId == 1) {
            td3.innerText = "Administrateur";
          }
          if (value.roleId == 2) {
            td3.innerText = "Utilisateur";
          }
          if (value.roleId == 3) {
            td3.innerText = "Recruteur";
          }

          let td4 = document.createElement("td");
          td4.innerText = value.email;

          let td5 = document.createElement("td");
          td5.innerText = value.firstName;

          let td6 = document.createElement("td");
          td6.innerText = value.lastName;

          let td7 = document.createElement("td");
          td7.innerText = value.adresse;

          let td8 = document.createElement("td");
          td8.innerText = value.codePostal;

          let td9 = document.createElement("td");
          td9.innerText = value.ville;

          let td10 = document.createElement("td");
          td10.innerText = value.telephone;

          let td11 = document.createElement("td");
          td11.innerText = value.isActive;

          let td12 = document.createElement("td");
          td12.innerText = value.pays;

          let td13 = document.createElement("td");
          td13.innerText = value.idEntreprise;

          //création du bouton de modifications
          let tdModified = document.createElement("td");
          let a1 = document.createElement("a");
          a1.href = `/UpdateUser/${value.id}`;
          a1.classList.add("modifie");
          a1.innerText = "Modifier";
          tdModified.appendChild(a1);

          //Bouton permettant la modification des données sur l'utilisateur
          tdModified.addEventListener("click", function () {
            modifieUser(value.id);
          });

          //création du bouton de suppression
          let tdDelete = document.createElement("td");
          let a2 = document.createElement("a");
          a2.href = `#`;
          a2.classList.add("delete");
          a2.innerText = "Delete";
          tdDelete.appendChild(a2);

          //suppression de l'utilisateur lors du clique sur le bouton
          tdDelete.addEventListener("click", function () {
            deleteUser(value.id);
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
          tr.appendChild(tdModified);
          tr.appendChild(tdDelete);

          //Ajout des éléments au DOM
          userElement.appendChild(tr);
        });
      }
    });

  //création d'une fonction pour que l'administrateur puisse supprimer un utilisateur
  function deleteUser(idUser) {
    fetch("http://127.0.0.1:8000/api/delete-user", {
      method: "DELETE",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        idUser: idUser,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
        if (data.status === true) {
          window.location.reload();
          alert("Utilisateur supprimé");
        } else {
          alert("Erreur lors de la suppression de l'utilisateur");
        }
      });
  }
});
