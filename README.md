# Développement d'une application Web de consultation et modification de films

## Nicolas Carré (carr0101) et Valentin Cladel (clad0006)

## Serveur Web local
### Pour lancer un serveur Web local il y a 3 méthodes :
### I. Directement dans le terminal
1. ouvrir un terminal
2. se placer dans le répertoire du projet
3. entrer la commande : *php -d display_errors -S localhost:8000*

### II. Avec un script shell
1. ouvrir un terminal
2. se placer dans le répertoire du projet
3. lancer la commande bin/run-server.sh

### III. Avec un script composer

1. ouvrir un terminal
2. se placer dans le répertoire du projet
3. lancer la commande composer start:linux ou start:windows selon l'environnement utilisé (start tout court lance la version linux)

## Style de codage
### Pour que le style de codage suive la recommandation PSR-12 on utilise PHP Coding Standards Fixer (PHP CS Fixer)
#### Utilisation :

1. ouvrir un terminal
2. se placer dans le répertoire du projet
3. pour vérifier les corrections potentielles, faire : *php vendor/bin/php-cs-fixer fix --dry-run*
4. pour corriger les fichiers, faire : *php vendor/bin/php-cs-fixer fix*

#### Via script composer :

1. ouvrir un terminal
2. se placer dans le répertoire du projet
3. pour tester les corrections : *composer test:cs*
4. pour corriger : *composer fix:cs*

## Programmes

1. index.php : Page d'accueil du site. Elle représente la liste des films, et on peut a partir d'ici accéder au menu de 
modification/création/suppression de films ou cliquer sur les films pour accéder a leur fiche.
2. movie.php : Page de fiche d'un film. Elle présente le film avec ses informations et les acteurs qui y jouent.
On y accède via la page d'accueil ou par l'url "/movie.php?movieId={identifiant du film}".
A partir d'ici, on peut cliquer sur un acteur pour accéder a sa fiche.
3. people.php : Page de fiche d'un acteur. Elle présente un acteur avec ses informations. On y accède via la fiche
d'un film ou par l'url "/people.php?peopleId={identifiant de l'acteur}".

#### A noter qu'un bouton de retour a la page d'accueil est également présent.

4. image.php : Ce programme affiche une image en fonction de l'id fourni. On y accède uniquement via 
l'url "/image.php?imageId={id de l'image}". Ce programme est uniquement utilisé pour afficher les images des affiches
et des photos dans les fiches de films et d'acteurs.
