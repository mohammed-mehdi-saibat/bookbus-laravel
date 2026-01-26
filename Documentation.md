# Bookbus - Plateforme de Réservation de Billets de Bus

## A. Analyse du Domaine (Étude de marKoub.ma)

### Processus de Réservation
1. **Recherche** : L'utilisateur saisit la ville de départ, la destination et la date.
2. **Sélection de l'Offre** : Affichage d'une liste de voyages (horaire, prix, transporteur, durée).
3. **Saisie des Passagers** : Information du passager (Nom, Prénom, Téléphone). 
   *Note: Contrairement à d'autres plateformes, le placement est souvent libre ou géré à bord.*
4. **Paiement & Confirmation** : Paiement par carte (CMI) ou en espèces (CashPlus/Tasshilat) suivi de la génération d'un code de ticket unique.

### Entités Principales
- **Utilisateur (User)** : Client ou Administrateur.
- **Compagnie (Company)** : L'opérateur de transport (ex: CTM, Ghazala).
- **Bus** : Le véhicule avec sa capacité totale.
- **Trajet (Route)** : Liaison entre deux villes (ex: Casablanca -> Agadir).
- **Voyage (Trip)** : Une instance d'un Trajet à une heure précise avec un Bus spécifique.
- **Réservation (Booking)** : Lien entre un Utilisateur et un Voyage.

---

## B. Proposition d'Architecture

### Liste des Fonctionnalités MVP
- Authentification (Login/Register) via Laravel Breeze.
- Recherche de voyages par ville et date.
- Consultation des détails d'un voyage.
- Réservation d'un billet (diminution des places disponibles).
- Dashboard Admin : Gestion des villes, trajets et voyages.

### Schéma de Base de Données (MCD)
1. **users** : id, name, email, password, role (admin/customer).
2. **buses** : id, company_name, total_capacity.
3. **routes** : id, departure_city, arrival_city, distance.
4. **trips** : id, route_id, bus_id, price, departure_time.
5. **bookings** : id, user_id, trip_id, status, reservation_date.

### Diagramme de Cas d'Utilisation
* **Passager** : Rechercher un voyage, Réserver un billet, Consulter ses tickets.
* **Administrateur** : Gérer les trajets, Planifier les voyages (Trips), Annuler un voyage.

### Diagramme de Classes
- **Trip Class** : `float price`, `datetime departure`, `getAvailableSeats()`.
- **Booking Class** : `string status`, `confirm()`, `cancel()`.
- **Route Class** : `string departure_city`, `string arrival_city`.

---

## C. Choix Techniques

### Pourquoi Laravel ?
- **Eloquent ORM** : Facilite la gestion des relations complexes entre Voyages et Réservations sans SQL complexe.
- **Blade Engine** : Permet de créer rapidement une interface dynamique et propre.
- **Sécurité** : Protection native contre les failles CSRF et injections SQL, crucial pour un système de réservation.
- **Écosystème** : Utilisation de Laravel Breeze pour une authentification robuste en 5 minutes.

### Dépendances Nécessaires
- `laravel/breeze` : Pour le système d'authentification.
- `pestphp/pest` : Pour les tests unitaires et fonctionnels.
- `fakerphp/faker` : Pour générer des données de test (Bus et Trajets).