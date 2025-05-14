JobStep – Suivi d’Activité pour Candidats

Bienvenue sur JobStep, une application Symfony 6 de gestion de parcours, ressources, et échanges entre candidats, conseillers et administrateurs.

Le site est en ligne ici : http://borie2.alwaysdata.net/

---

Fonctionnalités

Côté utilisateur (ROLE_USER)

- Inscription / Connexion ✅ OK
- Messagerie interne (inbox + envoi de messages) ✅ OK
- Visualisation de son parcours et des étapes ✅ OK
- Accès aux ressources pédagogiques par étape ✅ OK

Côté conseiller (ROLE_CONSEILLER)

- Création et édition de parcours ✅ OK
- Ajout d'étapes à un parcours ✅ OK
- Ajout de ressources à une étape ✅ OK
- Suivi des utilisateurs et de leurs parcours ✅ OK

Côté administrateur (ROLE_ADMIN)

- Gestion des utilisateurs (édition des rôles/types) ✅ OK
- Interface EasyAdmin pour la supervision ✅ OK
- Sécurisation des routes sensibles ✅ OK
- Visualisation des rendus d’activités ✅ OK
- CRUD complet : Parcours, Étapes, Messages, Ressources ✅ OK

---

Technologies utilisées

- Symfony 6
- Doctrine ORM
- Twig
- Bootstrap 5.3
- MySQL
- EasyAdmin
- ImportMap / Webpack Encore

---

Installation en local

1. Clone du projet :

git clone https://github.com/Baptiste-Borie/evaluation.git
cd evalutation
composer install

2. Crée une base de données et exécute :

php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

3. Lance le serveur :

symfony server:start

---

Comptes de test

Email : admin@jobstep.fr / Mot de passe : admin123 / Rôle : ROLE_ADMIN
Email : conseiller@jobstep.fr / Mot de passe : conseil123 / Rôle : ROLE_CONSEILLER
Email : candidat@jobstep.fr / Mot de passe : test123 / Rôle : ROLE_USER

---

Ce projet met l’accent sur l’accompagnement des utilisateurs à travers un parcours pédagogique et un système de messagerie interne sécurisé.

Objectif : offrir une plateforme simple mais robuste pour le suivi et la progression d’un candidat dans un cadre encadré par un conseiller.

# Réponse question

### Entité crée :

toutes

### Sécurité :

authentification, enregistrement,Seul un conseiller peut créer un parcours, une étape, une ressource

### CRUD

Toute sauf rendu

### Dépot d'un message

oui l'utilisateur qui envoie le message est celui connecté

### Tableau de bord :

Un parcours présente ces étapes ( dans show )
Une étape présente ses ressources ( dans l'onglet ressource on a le nom de l'étape a laquelle elle est relié )
