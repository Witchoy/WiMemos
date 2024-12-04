TP8 - Eloquent ORM
==================

Objectif
--------

Il s'agit d'utiliser les fonctionnalités de l'ORM Eloquent pour gérer les modèles sans se soucier de leur enregistrement en base de données.

Nous allons nous focaliser sur :

- la migration des tables de la BDD (i.e. la génération et la création des tables avec des scripts et `artisan`)
- la création de modèles, leur manipulation dans les contrôleur et leur affichage dans les vues

Les pages de documentation qui vous seront utiles pour tous les exercices :

- [la migration](https://laravel.com/docs/11.x/migrations)
- [les types de données pour la migration](https://laravel.com/docs/11.x/migrations#available-column-types)
- [l'ORM Eloquent pour la gestion des modèles](https://laravel.com/docs/11.x/eloquent)


Exercice 1 : La migration de MyUser
-----------------------------------

Nous allons commencer par scripter la création de la table associée à `MyUser`.

1. Créez un script de migration pour `MyUser` avec la commande suivante :
	```bash
	php artisan make:migration create_myusers_table
	```

2. Dans le script créé, définissez que la table `mysusers` contient :
	- un login comme **champs texte** qui est **clé primaire**
	- un mot de passe comme **champ texte**

3. Effectuez la migration avec la commande suivante :
	```bash
	php artisan migrate:fresh
	```
**Attention** : cela va supprimer toutes les tables existantes de votre BDD avant de les recréer.

4. Modifiez la classe `MyUser` pour qu'il fasse des requêtes vers cette nouvelle table `mysusers`.


Exercice 2 : Des mémos pour MyUser
----------------------------------

Nous allons ajouter la possibilité à notre `MyUser` de créer et visualiser des mémos composé d'un titre et d'un contenu.

1. Créez un modèle géré par Éloquent avec cette commande :
	```bash
	php artisan make:model Memo -mc
	```
où le `-m` indique de créer le fichier de migration de ce modèle et `-c` permet de créer son contrôleur.

2. Dans le fichier de migration de des mémos,  définissez qu'un mémo :
	- a un `id` comme **clé primaire**
	- a un titre qui tient en une ligne
	- a un contenu qui peut être écrit sur plusieurs lignes
	- n'a pas de timestamps.

3. Exécuter la migration de cette table et vérifier que cela a fonctionné avec `sqlitebrowser`.

4. Dans le modèle `Memo`, indiquez de désactiver les "timestamps".

Exercice 3 : Ajouter un mémo
----------------------------

Nous allons créer un formulaire accessible depuis son compte pour créer des mémos.

1. Créez une vue `formmemo` avec artisan (et profitez de la citation proposée par Laravel)

2. Faites en sorte que la vue créée étende le layout principal et qu'elle propose un formulaire permettant d'ajouter une note avec un titre et un contenu. Ajouter également en dessous-du formulaire un lien vers la route `view_account`.

3. Créez la route qui permet d'afficher le formulaire. Nommez-la `view_formmemo` et ajouter un lien vers cette route sur la page `account`.

4. Dans `MemoController`, créez une fonction `add` qui crée un nouveau memo à partir des données reçues du formulaire `formmemo`. Quand l'ajout s'est bien passé, elle redirige l'utilisateur vers la route `view_account` avec le message "New memo added".

5. Créez la route `memo_add` qui cible la méthode `add` de `Memo`.

6. Faites en sorte que cette route soit ciblée lorsque le formulaire d'ajout d'un mémo est validé.

Vérifiez que ça fonctionne e ajoutant un mémo et en vérifiant dans la BDD à l'aide de `sqlitebrowser` qu'un mémo a bien été ajouté.


Exercice 4 : Visualiser les mémos
---------------------------------

Nous allons créer une vue qui affiche les mémos.

1. Créez une vue `memolist` avec artisan.

2. Créez une page qui affiche la liste des mémos en supposant qu'ils sont accessibles dans une variable `$memos`. Utilisez uniquement la syntaxe Blade.

3. Ajoutez une méthode `show` dans `MemoController`. Elle affiche la vue `memolist.blade.php` en lui transmettant la liste de tous les mémos de la BDD.

4. Créez la route `memo_show` qui cible la méthode `show` de `Memo`.

5. Faites en sorte que cette route soit ciblée lorsqu'on clique sur lien "Show all memos" sur la vue `account`.


Bonus en prévision du mini projet
---------------------------------

1. Transformez `MyUser` en un modèle Eloquent.
2. Faites en sorte que les mémos soient propre à chaque utilisateur.
