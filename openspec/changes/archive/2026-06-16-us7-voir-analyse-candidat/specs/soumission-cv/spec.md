## MODIFIED Requirements

### Requirement: Soumission d'un CV
#### Scenario: Affichage complet de l'analyse (statut = termine)
- **WHEN** un utilisateur connecté accède à `/analyses/{analyse}` et que `analyse.statut === 'termine'`
- **THEN** le système affiche le score en grand avec couleur conditionnelle (vert >70, orange 40-70, rouge <40)
- **THEN** les points_forts sont affichés en badges verts
- **THEN** les lacunes sont affichés en badges rouges/oranges
- **THEN** les competences_manquantes sont affichés en badges gris
- **THEN** les competences et langues sont affichés en badges bleus
- **THEN** la recommandation est affichée en badge coloré (vert=convoquer, orange=attente, rouge=rejeter)
- **THEN** la justification est affichée en texte intégral
- **THEN** un bouton "Discuter avec l'assistant" est présent

#### Scenario: Analyse en attente inchangée
- **WHEN** un utilisateur connecté accède à `/analyses/{analyse}` et que `analyse.statut === 'en_attente'`
- **THEN** le système affiche toujours le message "Analyse en cours..."
