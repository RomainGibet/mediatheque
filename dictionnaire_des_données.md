## Utilisateur ('User')

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant de notre produit|
|email|VARCHAR(180)|NOT NULL|Email de l'utilisateur|
|roles|TEXT|NOT NULL|Role de l'utilisateur|
|password|VARCHAR(255)|NOT NULL|Mot de passe de l'utilisateur|
|pseudo|VARCHAR(255)|NOT NULL|Pseudo de l'utilisateur|
|profile_picture|VARCHAR(255)|NULL|Photo de profil de l'utilisateur|
|book_count|INT|NULL|Le nombre de livre de l'utilisateur|
|bd_count|INT|NULL|Le nombre de BD de l'utilisateur|
|comics_count|INT|NULL|Le nombre de comics de l'utilisateur|
|manga_count|INT|NULL|Le nombre de manga de l'utilisateur|
|cd_count|INT|NULL|Le nombre de cd de l'utilisateur|
|lp_count|INT|NULL|Le nombre de LP de l'utilisateur|
|created_at|DATETIME|NOT NULL, (ON UPDATE)|La date de création de l'utilisateur|

## Livre ('Book')

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant du livre|
|author|VARCHAR(255)|NOT NULL|Auteur du livre|
|title|VARCHAR(255)|NOT NULL|Le titre du livre|
|isbn|VARCHAR(255)|NOT NULL|L'isbn du livre)|
|editor|VARCHAR(255)|NOT NULL|L'éditeur du livre|
|year|VARCHAR(255)|NOT NULL CURRENT_TIMESTAMP|La date de création de la catégorie|
|updated_at|TIMESTAMP|NULL|La date de la dernière mise à jour de la catégorie|
