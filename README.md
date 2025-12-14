# Gestion de Stock de Composants Électroniques

Ce projet est une application prototype de gestion de stock de composants électroniques, développée avec **Laravel**, **Vue.js**, **Inertia**, et **Docker**.

## Prérequis

- [Docker Desktop](https://www.docker.com/products/docker-desktop) (ou Docker Engine + Docker Compose)

## Installation étape par étape

Instructions pour installer et lancer le projet.

### 1. Cloner le dépôt

Le code source: [lien du repo](https://github.com/HermesRhoDev/test-technique-effinnov)

Tout se trouve dans la branche: "dev/test-electronic-stock"

### 2. Configurer l'environnement

Copier le fichier d'exemple `.env.example` vers `.env`:

```bash
cp .env.example .env
```

Ouvrir le fichier `.env` et modifier la configuration de la base de données pour qu'elle corresponde aux paramètres Docker:

```ini
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=effinnov
DB_USERNAME=effinnov
DB_PASSWORD=effinnov
```

### 3. Lancer les conteneurs Docker

Pour construire et démarrer les conteneurs:

```bash
docker-compose up -d --build
```

### 4. Installer les dépendances PHP

Pour installer les dépendances Composer via le conteneur:

```bash
docker exec effinnov-app composer install
```

### 5. Générer la clé d'application Laravel

```bash
docker exec effinnov-app php artisan key:generate
```

### 6. Initialiser la base de données

Exécuter les migrations et les seeders:

```bash
docker exec effinnov-app php artisan migrate --seed
```

### 7. Installer et compiler les assets Frontend

Installer les dépendances Node.js et compilez les assets Vue.js/Tailwind:

```bash
docker exec effinnov-app npm install
docker exec effinnov-app npm run build
```

---

## Accès à l'application

- **Application Web** : [http://localhost:8000](http://localhost:8000)
- **PhpMyAdmin** (Gestion BDD) : [http://localhost:8080](http://localhost:8080)
  - Serveur : `mysql`
  - Utilisateur : `effinnov`
  - Mot de passe : `effinnov`

### Première connexion

⚠️ Lors du lancement des seeders, aucun utilisateur sera créé par défaut ⚠️

Il faut **s'inscrire** sur la page d'accueil pour accéder à la gestion de l'inventaire.

---

## Architecture

- **Backend** : Laravel 11 (API REST, Factory, Manager, Services)
- **Frontend** : Vue.js 3 + Inertia.js + Tailwind CSS
- **Base de données** : MySQL 8.0
- **Conteneurisation** : Docker + Docker Compose

## Fonctionnalités implémentées

- CRUD complet des composants (Résistances, Condensateurs, Microcontrôleurs).
- Filtrage dynamique par type de composant.
- Navigation latérale (Sidebar).
- Validation des données via FormRequests.
- Architecture POO (Interfaces, Classes Abstraites/Concrète, Enumération...).
- Mise en place de la consultation des produits via un catalogue produits publique
- Mise en place de la pagination des produits
- Ajout de tests unitaires (PublicCatalog, ResistorTest)
