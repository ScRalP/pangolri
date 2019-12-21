#----------------------------------------#
#          WELCOME TO PANGOLRI           #
#----------------------------------------#
# CREDIT TO :                            #
# Quentin ROBARD                         #
# Niels BEAUMONT                         #
#----------------------------------------#

Merci à vous! Vous venez de récupérer notre projet de E-commerce Pangolri!
Pour pouvoir lancer le projet il vous faudra suivre les étapes ci dessous :

    ## IMPORTANT ##
Toutes les commandes à venir devront être éxécutes à la racine du projet soit : "/pangolri/."


1) Installer composer :
Si vous n'avez pas composer cette étape est primordiale, comme le projet marche entierement 
avec Symfony il vous faudra composer. Utilisez la commande "php composer.phar install" pour l'installer
puis "php composer.phar update" pour le mettre à jour.
une fois composer installé lancez "composer update" afin de télécharger les bundle utilisés dans le projet


2) Installer yarn :
Nous utilison encore-bundle qui se charge de gérer tout les scripts JS, les images, le css tout ca quoi (les assets)
pour l'installer rendez vous ici : https://yarnpkg.com/lang/fr/docs/install/#windows-stable
une fois la procédure d'installation terminé vous pourrez entrez les commandes suivantes : 
 - yarn install ( pour installer toutes les dépendances du projet )
 - yarn dev     ( pour compiler les assets )


3) Créer la base de donnée et configurer la connexion :
Sous phpMyAdmin (ou votre application d'administration de base de donnée favoris) éxécutez le fichier ".sql"
Ouvrez ensuite le fichier ".env" et modifiez la ligne :
DATABASE_URL="mysql://db_user:db_pass@127.0.0.1:3306/db_name"
db_name = pangolri
db_user = le nom de votre utilisateur
db_pass = votre mot de passe

4) Lancer le serveur et se rendre sur la page :
Entrez la commande : "php bin/console server:run" pour lancer le serveur local puis sur votre navigateur favoris
rendez vous à l'adresse : "localhost:8000" et.... Voila!! vous êtes maintenant sur notre site de E-commerce Pangolri!
Have fun!

    ## AUTRES INSTRUCTIONS ##
Vous avez déjà des utilisateurs de créer dont voici la liste avec les identifiants et leurs permissions : 

             +-------------------------+--------------------------+----------+
             |   email                 |    password              | role     |
+------------+-------------------------+--------------------------+----------+
| user       | user@gmail.com          | userpwd                  | user     |
| admin      | admin@gmail.com         | adminpwd                 | admin    |
| HaterDu76  | hater@gmail.com         | abc123                   | user     |  -> déja un panier de créer
| CoolGuy78  | coolguy@gmail.com       | abc123                   | user     |  -> déjà un panier de créer
+------------+-------------------------+--------------------------+----------+

    ## IMPORTANT ##
      _.-'''''-._
    .' ___   ___ '.
   /=='___'-'___:==\
  |         .       |
  |         _|      |
   \     .____.    /
    '.           .'
      '-._____.-'    \
                      \
                      Stay cool !