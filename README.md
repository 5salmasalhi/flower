# FleurShop - Application de Vente de Fleurs en Ligne

<p align="center">
  <img src="public/images/logo.jpg" alt="FleurShop Logo" width="200">
</p>

## 📝 Description

FleurShop est une application web e-commerce moderne développée avec Laravel, conçue pour la vente de fleurs en ligne. Elle offre une expérience utilisateur fluide et intuitive pour acheter des fleurs et des arrangements floraux.

## ✨ Fonctionnalités

### 🏬 Pour les Clients
- Parcourir le catalogue de produits avec recherche en temps réel
- Filtrer les produits par catégorie
- Ajouter des produits au panier
- Gérer le panier d'achat (modifier quantités, supprimer articles)
- Processus de paiement sécurisé
- Création de compte et authentification
- Historique des commandes

### 👨‍💼 Pour les Administrateurs
- Tableau de bord d'administration
- Gestion des produits (CRUD)
- Gestion des catégories
- Suivi des commandes
- Gestion des utilisateurs

## 🛠️ Technologies Utilisées

- **Backend:** Laravel 10.x
- **Frontend:** 
  - Blade Templates
  - Alpine.js pour l'interactivité
  - Tailwind CSS pour le style
- **Base de données:** MySQL
- **Authentification:** Laravel Breeze

## 📋 Prérequis

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL

## 🚀 Installation

1. Cloner le dépôt :
```bash
git clone [url-du-repo]
cd flower
```

2. Installer les dépendances PHP :
```bash
composer install
```

3. Installer les dépendances JavaScript :
```bash
npm install
npm run build
```

4. Configurer l'environnement :
```bash
cp .env.example .env
php artisan key:generate
```

5. Configurer la base de données dans `.env` :
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=flower
DB_USERNAME=root
DB_PASSWORD=
```

6. Migrer la base de données :
```bash
php artisan migrate --seed
```

7. Lancer le serveur :
```bash
php artisan serve
```

## 🎨 Structure de l'Application

### Routes Principales
- `/` - Page d'accueil
- `/products` - Catalogue de produits
- `/cart` - Panier d'achat
- `/checkout` - Processus de paiement
- `/admin/*` - Interface d'administration

### Composants Principaux
- `ProductController` - Gestion des produits et recherche
- `CartController` - Gestion du panier
- `CheckoutController` - Processus de paiement
- `AdminController` - Fonctionnalités d'administration

## 👥 Rôles Utilisateurs

### Client
- Parcourir les produits
- Gérer son panier
- Passer des commandes
- Voir son historique

### Administrateur
- Gérer les produits
- Gérer les catégories
- Gérer les commandes
- Voir les statistiques

## 🔒 Sécurité

- Authentification sécurisée avec Laravel Breeze
- Protection CSRF sur tous les formulaires
- Validation des données côté serveur
- Middleware d'administration

## 🎯 Fonctionnalités à Venir

- [ ] Système de notation des produits
- [ ] Wishlist pour les clients
- [ ] Notifications par email
- [ ] Interface multilingue

## 📄 Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.
