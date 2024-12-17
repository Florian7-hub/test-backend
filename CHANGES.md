# Modifications

## Téléchargement des dépendances PHPUnit

**Détails des fichiers modifiés :**
### TodosRepositoryTest.php
- `provideConcretions` rendu statique avec l'ajout du mot clé `static`.
- Remplacement de `TodosRepository` par `InMemoryTodoRepository` dans les méthodes de test.

### TodoRepositoryTest.php
- `provideConcretions` rendu statique avec l'ajout du mot clé `static`..
- Remplacement de `TodoRepository` par `InMemoryTodoRepository` dans les méthodes de test.

### Intégration SQL
- Pour ce projet, il a été choisi d'utiliser PostgreSQL comme technologie de stockage pour sa robustesse et sa compatibilité avec les systèmes existants, l'assimiler en sortant de sa zone de confort.

## Modifications Apportées 
1. **Configuration de PostgreSQL :** 
- Création et configuration du fichier `init.sql` pour initialiser la base de données. 
- Mise à jour de `docker-compose.yml` pour inclure le service PostgreSQL et monter le fichier `init.sql`. 

2. **Implémentation des Repositories :** 
- Ajout des classes `PostgresTodoRepository` pour lire et écrire les données. 
- Mise à jour des tests `TodosRepositoryTest.php` et `TodoRepositoryTest.php` pour intégrer Postgre.