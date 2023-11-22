# Application Job Board

L'application Job Board est une solution logicielle visant à faciliter la recherche d'emploi et à simplifier le processus de recrutement pour les entreprises. Cette documentation fournit un aperçu des fonctionnalités, de l'installation, de la configuration et de l'utilisation de cette application.

## Fonctionnalités Principales

**. Recherche d'emploi :** Les utilisateurs peuvent facilement rechercher et consulter des offres d'emploi avec des options de filtrage permettant d'affiner les résultats.

**.Postulation en ligne :** Les chercheurs d'emploi peuvent postuler directement au poste souhaité grâce à l'application.

**.Gestion des profils :** Les utilisateurs ont directement accès à leurs données et possèdent la possibilité de modifier leurs informations comme ils le souhaitent.

**.Simplification du processus de recrutement :** Les entreprises bénéficie d'un accès au nombre de candidats ayant postulé à leurs offres. Les recruteurs peuvent ensuite accepter ou refuser chaque candidat en fonction de chaque poste correspondant.

## Installation et configuration

Pour l'installation de l'application Job Board suivez les instructions détaillées ci-dessous:

Installez Composer sur votre ordinateur (pour pouvoir lancer le framwork Laravel):  
**.windows** :  
Télécharger l'exécutable sur *https://getcomposer.org/download/Composer-Setup.exe*, puis  
`composer install` depuis le terminal

**.linux** :  
`sudo apt update`  
`sudo apt install php-cli unzip`  
`php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"`  
`php -r "if (hash_file('sha384', 'composer-setup.php') === 'VERIFIER') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"`  
`sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer`.

**.macOS** :  
Si Homebrew n'est pas installé : `/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"`  
, puis `brew install composer`.

Installez XAMPP:

**.windows et macOS:**  
Télécharger la version correspondant à votre système d'exploitation sur : `https://www.apachefriends.org/index.html` puis suivez les instructions.

**.linux** :  
Ouvrez un terminal, tapez `wget https://www.apachefriends.org/xampp-files/{version}/xampp-linux-x64-{version}-installer.run`  
et remplacez _{version}_ par la version actuelle de XAMPP.  
Rendez le fichier exécutable en utilisant chmod : `chmod +x xampp-linux-x64-{version}-installer.run`  
, executez le fichier d'installation `` sudo ./xampp-linux-x64-{version}-installer.run`, suivez les instructions puis démarrez XAMPP `sudo /opt/lampp/lampp start ``.

Un fois le projet ajouté sur VsCode, dans le terminal écrivez 'composer update'. Puis apres 'composer install' afin d'ajouter toutes les dépendences au projet.

Installez l'extension _Laravel Artisan_ depuis VScode.

Créez votre base de données. (Appeler la comme vous le souhaitez).

Dupliquez le fichier .env copy.example à la racine du projet.  
Renommez celui-ci par .env puis remplacer les informations présentes de la ligne 11 à 16 par vos informations de votre base mysql :

_DB_CONNECTION=mysql  
DB_HOST=127.0.0.1  
DB_PORT=3306  
DB_DATABASE=[nom de base de donnée]  
DB_USERNAME= [username]  
DB_PASSWORD= [password]_

Pour créez les tables dans la base :
Lancer la migration suivante : `php artisan migrate`

Pour ajoutez les données dans chaque table :
Lancer le seeder suivant : `php artisan db:seed`

Nous avons mis le mot de passe par défaut à 'Azerty@123'

Lancez un serveur en local :
`php artisan serve`

## Utilisation

_Lors de la connection apres avoir injecté des données dans votre base de donnée, pour identifier avec quel utilisateur il faut se connecter. Aller dans la table user et verifier le roleId de chaque utilisateur (1 = admin, 2 = utilisateur, 3 = recruteur). De plus un recruteur peux avoir/ou non les droits de crée des annonces il faut donc verifier dans la même ligne si le change isActive est à 0 ou 1._

Étape 1:  
Grace à la migration que vous avez pu faire auparavant, utilisez la base de donnée...  
[base de donnée](./database/migrations)

Étape 2:
Allez à la ligne 56 du fichier _annonceInfo.js_ pour trouver le boutton _learn more_.  
[learn more button](./public/js/annonceInfo.js)

Étape 3:  
Allez à la ligne 56 du fichier _annonceInfo.js_ pour trouver la fonctionnalité du boutton _learn more_.  
[learn more js](./public/js/scriptLearnMore.js)

Étape 4:  
L'API fournissant les opérations CRUD pour les annonces.
[CRUD Annonce](./app/Models/RecruteurModel.php)

Étape 5:  
Le bouton _Postuler_ en tant que utilisateur non connecté est à la ligne 166.
[Formulaire de postulage](./public/js/annonceInfo.js)

Étape 6:  
Mécanisme d'identification.
[Traitement formulaire Inscription avant requete SQL](./app/Http/Controllers/InscriptionController.php)
[Traitement formulaire Inscription envoie en base](./app/Models/InscriptionModel.php)

[Traitement formulaire Connection avec verification de Hash](./app/Http/Controllers/ConnectionController.php)

Étape 7:  
La page qui surveille la base de données. Elle est accessible seulement par l'administrateur.
[CRUD Utilisateur](./app/Http/Controllers/AdministrateurApiController.php)
[CRUD Utilisateur](./app/Models/AdministrateurModel.php)

Étape 8:  
La mise en page de notre application a été faite dans ce dossier.
[style css](./public/css)

## Auteurs

    Arthur Dumortier
