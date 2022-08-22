git clone

ls

cd dwwm16_symfony

composer install

Verifier les infos de la BDD dans le .env

symfony console d:d:c

symfony console d:m:m

symfony serve

Changer le role du user dans la BDD par => ["ROLE_ADMIN"]

Ajouter en premier des categories puis des articles


# Contenu HT ACCESS PROD
Il faut créer un fichier : .htaccess et y mettre le code ci-dessous dedans
Ou bien créer le fichier (sur LWS- hebergeur) : .htaccess - Dans public_html
Comment faire si je ne vois pas mon .htaccess? Aller en haut à droite de la page, cliquer sur la roue de config et activer l'affichage des fichiers cachés

----------------

RewriteEngine On



RewriteCond %{HTTPS} off
RewriteRule (.*) https://%{HTTP_HOST}%{REQUEST_URI} [L]
RewriteCond %{HTTP_HOST} ^votredomaine$ [NC,OR]
RewriteCond %{HTTP_HOST} ^www.votredomaine$
RewriteCond %{REQUEST_URI} !^votredomaine/public/
RewriteRule (.*)$ votredossier/public/$1 [L]

<IfModule mime_module>
    addHandler application/x-httpd-ea-php80 .php .php8 .phtml
</IfModule>
# php -- END cPanel-generated handler, do not edit
----------------

#
PREPA PROJET

# Mettre en place le service : ImageService
# Puis make:crud Product
-> 4. Creation du systeme d'inscription
-> 5. Creation du systeme connexion
-> 6. Creation du panier
-> 7. Creation du systeme de paiement
-> 8. Gestion de l'historique de commande en admin et cté client
-> 9. Pouvoir ajouter des moderateurs sur le site

0
# BONUS
Création d'un blog
—> Entity :  Post 
—> Propriété : imagePath, title, content, createdAt, status

-> Entité : Commentaire
-> Propriété : post, status, content, user, created_at # Projet
