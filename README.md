#  Plateforme Éducative IA - Symfony

Bienvenue sur la plateforme éducative intelligente développée avec **Symfony** et intégrant une **IA locale** via **Ollama (TinyLlama)**.  
Elle permet aux utilisateurs de suivre des cours, interagir avec l’IA pour poser des questions ou générer un plan d’étude.

---

##  Fonctionnalités principales

###  Authentification
- Inscription et connexion utilisateur
- Gestion des rôles : `Utilisateur`, `Admin`

###  Utilisateur
- Consulter les cours commencés
- Voir les détails d’un cours
- Poser des questions à une IA pédagogique
- Générer un plan d’étude personnalisé avec l’IA
- Accéder à des suggestions de cours

###  Admin
- Gérer les cours : ajout, modification, suppression
- Voir la liste des utilisateurs
- Consulter les statistiques de la plateforme

---

##  IA intégrée (Ollama + TinyLlama)

L'IA est intégrée en local via [Ollama](https://ollama.com/).  
Elle répond aux questions des utilisateurs sur les cours et propose des plans d'étude personnalisés.

-  Modèle utilisé : `tinyllama`
-  Endpoint utilisé : `http://localhost:11434/api/chat`

---

## Technologies utilisées

| Outil        | Rôle                            |
|--------------|----------------------------------|
| Symfony 6    | Framework principal backend      |
| Twig         | Moteur de templates              |
| Doctrine     | ORM pour base de données         |
| Ollama       | Serveur local d’IA               |
| TinyLlama    | Modèle de langage                |
| MySQL        | Base de données relationnelle   |

---

##  Installation et exécution

### 1. Cloner le projet

```bash
git clone https://github.com/votre-utilisateur/plateforme-educative-symfony.git
cd plateforme-educative-symfony
