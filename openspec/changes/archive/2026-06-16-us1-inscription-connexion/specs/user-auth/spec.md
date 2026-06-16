## ADDED Requirements

### Requirement: Inscription d'un agent RH
Le système SHALL permettre à un nouvel utilisateur de s'inscrire avec nom, email et mot de passe. Le mot de passe SHALL être confirmé. L'email SHALL être unique.

#### Scenario: Inscription réussie
- **WHEN** un utilisateur soumet le formulaire d'inscription avec nom, email, mot de passe et confirmation valides
- **THEN** le compte est créé, l'utilisateur est connecté et redirigé vers `/offres`

#### Scenario: Email déjà utilisé
- **WHEN** un utilisateur soumet le formulaire avec un email déjà existant
- **THEN** le système affiche une erreur de validation "Cet email est déjà utilisé"

#### Scenario: Mot de passe trop court
- **WHEN** un utilisateur soumet un mot de passe de moins de 8 caractères
- **THEN** le système affiche une erreur de validation

### Requirement: Connexion d'un agent RH
Le système SHALL permettre à un utilisateur inscrit de se connecter avec email et mot de passe.

#### Scenario: Connexion réussie
- **WHEN** un utilisateur soumet le formulaire de connexion avec email et mot de passe valides
- **THEN** l'utilisateur est connecté et redirigé vers `/offres`

#### Scenario: Identifiants invalides
- **WHEN** un utilisateur soumet un email ou mot de passe incorrect
- **THEN** le système affiche une erreur "Identifiants invalides"

### Requirement: Déconnexion
Le système SHALL permettre à un utilisateur connecté de se déconnecter.

#### Scenario: Déconnexion réussie
- **WHEN** un utilisateur connecté clique sur "Déconnexion"
- **THEN** l'utilisateur est déconnecté et redirigé vers `/login`

### Requirement: Protection des routes
Les routes métier (offres, candidatures, analyses) SHALL être protégées par le middleware `auth`. Les routes invitées (login, register) SHALL être accessibles uniquement aux utilisateurs non connectés.

#### Scenario: Accès sans connexion
- **WHEN** un utilisateur non connecté tente d'accéder à `/offres`
- **THEN** le système redirige vers `/login`

#### Scenario: Accès invité après connexion
- **WHEN** un utilisateur connecté tente d'accéder à `/login`
- **THEN** le système redirige vers `/offres`

### Requirement: Rattachement des offres à l'utilisateur
Les offres créées SHALL être automatiquement rattachées à l'utilisateur connecté via `user_id`.

#### Scenario: Création d'offre avec utilisateur
- **WHEN** un utilisateur connecté crée une offre
- **THEN** l'offre est rattachée à cet utilisateur via `user_id`
