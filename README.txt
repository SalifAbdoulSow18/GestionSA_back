##################################################################
Je suppose que vous avez déjà cloné le projet avec la commande:

"git clone https://github.com/SalifAbdoulSow18/filRougeSAS.git"

#######################################################################

Après clonage du projet vous remarquerez que si vous essayez de lancer le serve vous ne voyez qu'une page blanche. C'est très
normale, il vous faut mettre en place les dépendances avec la commande:

 "composer install" ou "composer update" au cas où la première ne fonctionnera pas.

 #######################################################################

 Allez dans un fichier .env et copiez la ligne du "DATABASE_URL"


 #######################################################################

 Créer un fichier .env.local et mettez:

- coller le DATABASE_URL copier au niveau du .env tout en remplacant les demandes
par leurs correspondants

-et coller ce qui suit:

###> lexik/jwt-authentication-bundle ###
JWT_PASSPHRASE=passer
###< lexik/jwt-authentication-bundle ###

########################################################################

Maintenant vous pouvez creer votre base de donné avec la commande:

"php bin/console doctrine:database:create"

puis vous allez dans la base de donnée et importé le fichier sql 

#####################################################################

Maintenant si vous essayez generer un token au niveau du postMan vous aurez une erreur
qui vous parle de la configuration du JWT.

Pour çà, vous devrez lancer les commandes suivantes:

- "mkdir config/jwt" : qui va vous permettre de creer un dossier jwt dans le config.

- "openssl genrsa -out config/jwt/private.pem -aes256 4096" : il vous demandera

un mot de passe, soit vous mettez "passer" et conserver la valeur de JWT_PASSPHRASE
dans le fichier .env.local!

ou vous mettez un mot de passe et vous changez la valeur du JWT_PASSPHRASE dans le fichier .env.local!

- "openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem": il vous demandera
un mot de passe utiliser les même mot de passe que la commande precedante.

#############################################################################


    Et tout est joué vous allez pouvoir générer des tokens

    *********************************************************************

    DONNEES :

-ADMIN = {email: 'michelle37@coste.com', password: passer1234'}
-FORMATEUR = {email: 'maillet.alex@gmail.com', password: passer1234'}
-APPRENANT = {email: 'nathalie44@masson.com', password: passer1234'}
-CM = {email: 'hortense68@david.com', password: passer1234'}
