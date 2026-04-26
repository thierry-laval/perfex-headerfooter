# Module Perfex Header & Footer v1.5

## Présentation

Le module Perfex Header & Footer vous permet d'injecter du code JavaScript, CSS et HTML personnalisé dans l'en-tête et le pied de page du panneau d'administration et de l'espace client. C'est l'outil idéal pour ajouter de l'analytique, des pixels de suivi, une identité visuelle sur mesure, ou étendre les fonctionnalités sans modifier les fichiers coeurs de Perfex.

## Fonctionnalités

### Fonctions principales

- JavaScript personnalisé : Injection de scripts dans les sections d'en-tête (Head) et de pied de page (Footer).
- CSS personnalisé : Modification de l'apparence visuelle sans altérer les fichiers de thèmes originaux.
- HTML personnalisé : Insertion de balises meta, de liens de vérification ou de widgets dans l'en-tête.
- Double interface : Gestion isolée et indépendante pour le panneau d'administration et le portail client.
- Validation syntaxique : Analyse automatique pour prévenir les erreurs de structure (accolades, guillemets).
- Gestion de configuration : Exportation et importation via fichiers JSON pour faciliter les sauvegardes.
- Suivi d'activité : Historique des 20 dernières modifications avec nom de l'auteur et horodatage.
- Interface optimisée : Éditeur de code intégré avec coloration syntaxique pour une meilleure lisibilité.

### Sécurité

- La validation HTML empêche l'usage de balises script dans les sections HTML
- Filtrage des gestionnaires d'événements pour une protection accrue
- Journalisation de l'activité pour chaque modification
- Configuration sécurisée basée sur le format JSON

## Installation

1. Téléchargez le dossier du module dans `/modules/perfex_headerfooter/`
2. Allez dans Configuration → Modules dans Perfex
3. Activez le module "Perfex Header & Footer"
4. Accédez à l'onglet Configuration → Réglages → Code personnalisé

## Utilisation

### Code du panneau d'administration

#### JavaScript de l'en-tête (Admin Head)

- Ce code est injecté dans la section `<head>` de toutes les pages d'administration.
- Idéal pour l'initialisation de bibliothèques tierces ou de variables globales nécessaires dès le chargement.
- Exemple d'initialisation :

```javascript
console.log('Panneau admin chargé');
if (window.CustomAdmin) {
    CustomAdmin.init();
}
```

### JavaScript du pied de page Admin

- Exécuté avant la balise de fermeture `</body>` dans les pages d'administration
- Idéal pour les scripts différés ou le suivi en bas de page
- Exemple :

```javascript
// Suivi de la consultation de page (en bas de page)
if (window.gtag) {
    gtag('pageview');
}
```

### CSS Admin

- Ajoutez des styles personnalisés au panneau d'administration
- Exemple :

```css
.custom-header {
    background: #007bff;
    color: white;
    padding: 10px;
}
```

### En-têtre HTML Admin

- HTML personnalisé dans la section en-tête de l'administration
- Parfait pour les balises meta ou les éléments personnalisés
- Remarque : Les balises script et les gestionnaires d'événements ne sont pas autorisés pour des raisons de sécurité

### Code de l'espace client

Les mêmes options sont disponibles pour l'espace client. Les paramètres s'appliquent séparément pour fournir des personnalisations différentes selon le contexte.

## Variables globales disponibles

Lorsque votre code est exécuté dans Perfex, plusieurs objets globaux et fonctions sont disponibles :

### Variables globales JavaScript

#### jQuery

```javascript
// jQuery est disponible globalement
jQuery('#my-element').hide();
jQuery('#my-element').fadeIn();
```

#### Variables Perfex

```javascript
// Accès à l'environnement Perfex
const current_user_id = '<?php echo get_staff_user_id(); ?>';
const admin_base_url = admin_url; // Disponible dans l'admin
const app_base_url = app_url;     // Disponible dans l'espace client

// Vérifier si on est dans l'admin ou l'espace client
if (typeof admin_url !== 'undefined') {
    // Vous êtes sur le panneau d'administration
}
```

#### Bootstrap

```javascript
// Bootstrap est généralement chargé
if (window.jQuery && window.jQuery.fn.modal) {
    // Les modales Bootstrap sont disponibles
}
```

## Exemples

### Exemple 1 : Google Analytics dans Admin

```javascript
// JavaScript de l'en-tête Admin
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', 'GA_MEASUREMENT_ID');

// Ajouter un suivi d'événement personnalisé sur les liens admin
jQuery(document).on('click', 'a[href*="admin"]', function() {
    gtag('event', 'admin_navigation', {
        'link_text': jQuery(this).text()
    });
});
```

### Exemple 2 : CSS de marque personnalisée

```css
/* CSS Admin */
.navbar-header {
    background-color: #2c3e50 !important;
}

.sidebar {
    background-color: #34495e !important;
}

.navbar-header a,
.navbar-header a:hover {
    color: #ecf0f1 !important;
}

/* Style de logo personnalisé */
.navbar-brand img {
    max-width: 150px;
    height: auto;
}
```

### Exemple 3 : Amélioration de l'espace client

```html
<!-- En-tête HTML Client -->
<meta name="theme-color" content="#007bff">
<link rel="canonical" href="https://votresite.com">

<!-- JavaScript de l'en-tête Client -->
<script>
// Mettre en place un suivi personnalisé
window.customerTracking = {
    page: document.location.pathname,
    timestamp: new Date().toISOString()
};
</script>
```

### Exemple 4 : Widget Admin personnalisé

```javascript
// JavaScript du pied de page Admin
jQuery(document).ready(function() {
    // Ajouter un widget admin personnalisé
    var widget = jQuery('<div class="custom-widget"></div>');
    widget.html('Contenu du widget personnalisé');
    widget.css({
        'position': 'fixed',
        'bottom': '20px',
        'right': '20px',
        'background': '#fff',
        'padding': '15px',
        'border': '1px solid #ddd',
        'border-radius': '5px',
        'box-shadow': '0 2px 10px rgba(0,0,0,0.1)',
        'z-index': 9999
    });
    jQuery('body').append(widget);
});
```

## Validation

Le module effectue les validations suivantes :

### Validation JavaScript

- ✓ Vérification des accolades appariées `{}`
- ✓ Vérification des parenthèses appariées `()`
- ✓ Vérification des guillemets non fermés `"` et `'`

### Validation CSS

- ✓ Vérification des accolades appariées `{}`

### Validation HTML

- ✓ Prévient l'utilisation de balises `<script>`
- ✓ Prévient les gestionnaires d'événements en ligne (`onclick`, `onerror`, etc.)
- ✓ Autorise les balises HTML sûres comme `div`, `span`, `p`, `h1-h6`, `a`, `img`, `strong`, `em`, `ul`, `ol`, `li`, `br`, `hr`

## Exportation & Importation

### Exporter la configuration

1. Allez à Configuration → Réglages → Code personnalisé
2. Cliquez sur l'onglet "Import/Export"
3. Cliquez sur le bouton "Télécharger la config"
4. Un fichier JSON sera téléchargé avec vos paramètres actuels

### Importer la configuration

1. Préparez un fichier de configuration JSON précédemment exporté
2. Allez à Configuration → Réglages → Code personnalisé
3. Cliquez sur l'onglet "Import/Export"
4. Cliquez sur "Choisir un fichier" et sélectionnez votre fichier JSON
5. Cliquez sur le bouton "Uploader la config"
6. La configuration sera restaurée

### Cas d'usage

- **Sauvegarde** : Conservez des sauvegardes de vos personnalisations
- **Transfert** : Copiez les paramètres entre les installations Perfex
- **Contrôle de version** : Suivez vos personnalisations dans Git
- **Environnement de test** : Testez les configurations avant la mise en production

## Historique des modifications

Toutes les modifications apportées à votre code sont automatiquement suivies. Le module conserve un historique des 20 dernières modifications, notamment :

- **Horodatage** : Quand la modification a été effectuée
- **Type d'action** : Quel type de modification (mise à jour, importation, etc.)
- **Utilisateur** : Quel membre du personnel a effectué la modification

Consultez l'historique dans Configuration → Réglages → Code personnalisé → Onglet Historique.

## Dépannage

### Code non exécuté

#### Vérification 1 : Vérifiez que le code est réellement enregistré

- Vérifiez si la page des paramètres Perfex affiche votre code

#### Vérification 2 : Consultez la console du navigateur pour les erreurs JavaScript

- Ouvrez les outils de développement (F12) et consultez l'onglet Console pour les erreurs

#### Vérification 3 : Vérifiez le placement

- Le code du panneau d'administration n'apparaîtra pas dans l'espace client et vice versa

#### Vérification 4 : Videz le cache

- De nombreux systèmes de gestion de contenu mettent en cache les paramètres
- Essayez de vider le cache de Perfex

### Avertissements de validation

Le module enregistre les avertissements de validation mais ne bloque pas le code. Si vous voyez des avertissements :

1. Vérifiez le format de votre code
2. Corrigez les erreurs de syntaxe affichées dans l'avertissement
3. Réenregistrez le code

### Problèmes de performances

Si les pages se chargent lentement après l'ajout de code :

1. Minimisez la taille de votre code
2. Déplacez le JavaScript lourd vers le pied de page au lieu de l'en-tête
3. Envisagez de charger les ressources externes de manière asynchrone
4. Surveillez l'onglet Réseau du navigateur pour détecter les goulots d'étranglement

## Informations du module

- **Version** : 1.5
- **Auteur** : Thierry LAVAL
- **URI de l'auteur** : https://thierrylaval.dev
- **Licence** : Consultez le fichier LICENSE
- **Requiert** : Perfex 2.3 ou supérieur

## Support & Mises à jour

Pour les problèmes, les demandes de fonctionnalités ou les mises à jour, veuillez contacter thierrylaval.dev ou consulter le dépôt du module.

## Historique des versions

### v1.5

- Correction du bogue du hook d'activation
- Mise en œuvre correcte de la sortie des scripts dans l'en-tête et le pied de page
- Ajout du support CSS
- Ajout du support HTML
- Ajout de la validation du code
- Ajout de la fonctionnalité d'importation/exportation
- Ajout du suivi de l'historique des modifications
- Interface améliorée avec onglets et texte d'aide
- Ajout des hooks du panneau d'administration et de l'espace client

### v1.0.1

- Première version avec support JavaScript basique

---

Dernière mise à jour : 26 avril 2026
