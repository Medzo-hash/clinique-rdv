---

## 🗄️ Base de données

### Tables principales

**users**
| Colonne | Type | Description |
|---|---|---|
| id | INT | Clé primaire |
| name | VARCHAR(255) | Nom complet |
| email | VARCHAR(255) | Adresse email (unique) |
| role | ENUM | patient / medecin / admin |
| telephone | VARCHAR(20) | Numéro de téléphone |
| specialite | VARCHAR(255) | Spécialité (médecins uniquement) |
| password | VARCHAR(255) | Mot de passe hashé |

**rendez_vous**
| Colonne | Type | Description |
|---|---|---|
| id | INT | Clé primaire |
| date | DATE | Date du rendez-vous |
| heure | TIME | Heure du rendez-vous |
| statut | ENUM | en_attente / confirme / annule |
| motif | TEXT | Motif de consultation |
| patient_id | INT | Clé étrangère → users |
| medecin_id | INT | Clé étrangère → users |

---

## 🚀 Installation et démarrage

### Prérequis
- PHP 8.5+
- Composer
- MySQL (via XAMPP)
- Node.js

### Étapes

```bash
# 1. Cloner le dépôt
git clone https://github.com/Medzo-hash/clinique-rdv.git
cd clinique-rdv

# 2. Installer les dépendances PHP
composer install

# 3. Installer les dépendances Node
npm install

# 4. Configurer l'environnement
cp .env.example .env
php artisan key:generate

# 5. Configurer la base de données dans .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=clinique_rdv
DB_USERNAME=root
DB_PASSWORD=

# 6. Créer la base de données et lancer les migrations
php artisan migrate

# 7. Créer le compte admin
php artisan db:seed --class=AdminSeeder

# 8. Lancer le serveur
php artisan serve
```

L'application est accessible sur **http://localhost:8000**

---

## 👥 Comptes de démonstration

| Rôle | Email | Mot de passe |
|---|---|---|
| 👑 Admin | admin@clinique.sn | Admin@2026 |
| 👨‍⚕️ Médecin | test.medecin@gmail.com | password |
| 🧑 Patient | (créer via inscription) | — |

---

## 👨‍💻 Équipe de développement

| Membre | Rôle | Contribution |
|---|---|---|
| **Mohamed Diop** | Développeur Full Stack | Backend Laravel, Frontend Blade, BDD |
| **Personne 2** | Conception UML | Diagrammes de cas d'utilisation, classes |
| **Personne 3** | Conception UML | Diagrammes de séquence, MCD/MLD |
| **Personne 4** | Base de données | Schéma SQL, migrations, seeders |
| **Personne 5** | Backend | Authentification et gestion des rôles |
| **Personne 6** | Backend | CRUD rendez-vous, routes API |
| **Personne 7** | Frontend | Pages publiques (accueil, médecins) |
| **Personne 8** | Frontend | Dashboard, intégration backend |
| **Personne 9** | Documentation | Rapport final, slides de présentation |

---

## 📁 Liens importants

- 🔗 **GitHub** : https://github.com/Medzo-hash/clinique-rdv
- 📋 **Trello** : *(lien à ajouter)*
- 🎨 **Maquette Figma** : *(lien à ajouter)*
- 🎥 **Vidéo de démonstration** : *(lien à ajouter)*

---

## 📄 Licence

Ce projet est développé dans le cadre académique de la Licence 3 Informatique à l'UNCHK.  
© 2026 CliniqPlus — Dakar, Sénégal