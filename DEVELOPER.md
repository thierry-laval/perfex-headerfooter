# Guide du Développeur - Perfex Header & Footer

## Architecture du Module

```
perfex_headerfooter/
├── perfex_headerfooter.php # Fichier principal du module (hooks, fonctions)
├── Headerfooter_helper.php # Classe helper (validation, export/import)
├── install.php # Fichier d’installation (initialisation des options)
├── controllers/
│ └── Headerfooter.php # Contrôleur (endpoints API)
├── views/admin/settings/
│ └── headerfooter_js_settings.php # Interface de configuration
├── language/english/
│ └── perfex_headerfooter_lang.php # Fichier de langue (chaînes de traduction)
├── README.md # Guide de démarrage rapide
├── FEATURES.md # Documentation complète
├── EXAMPLES.php # Exemples de code
└── DEVELOPER.md # Ce fichier
```

## Composants principaux

### 1. Fichier principal du module (`perfex_headerfooter.php`)

**Hooks :**

- `admin_init` - Initialisation des éléments du menu
- `before_setting_option_update` - Validation des options avant sauvegarde
- `app_admin_head` - Injection du code dans le head admin
- `app_admin_footer` - Injection du code dans le footer admin
- `app_customers_head` - Injection du code dans le head client
- `app_customers_footer` - Injection du code dans le footer client

**Fonctions :**

- `perfex_headerfooter_setup_init_menu_items()` - Ajout de l’onglet de configuration
- `headerfooter_js_admin_head()` - Injection du code head admin
- `headerfooter_js_admin_footer()` - Injection du code footer admin
- `headerfooter_js_customer_head()` - Injection du code head client
- `headerfooter_js_customer_footer()` - Injection du code footer client
- `perfex_headerfooter_validate_options()` - Validation du code avant enregistrement

### 2. Classe Helper (`Headerfooter_helper.php`)

#### Récupération des données (Getters)

- `get_admin_header()` - Récupère le JavaScript du head admin  
- `get_admin_footer()` - Récupère le JavaScript du footer admin  
- `get_admin_css()` - Récupère le CSS admin  
- `get_admin_html_header()` - Récupère le HTML injecté dans le head admin  
- `get_customer_header()` - Récupère le JavaScript du head client  
- `get_customer_footer()` - Récupère le JavaScript du footer client  
- `get_customer_css()` - Récupère le CSS client  
- `get_customer_html_header()` - Récupère le HTML injecté dans le head client  

#### Validation

- `validate_javascript($code)` - Validation de la syntaxe JavaScript  
- `validate_css($code)` - Validation de la syntaxe CSS  
- `validate_html($code)` - Validation et sécurisation du HTML (anti-injection)  

#### Export / Import

- `export_config()` - Export de toute la configuration au format JSON  
- `import_config($json_data)` - Import de configuration depuis un fichier JSON  

#### Historique

- `get_history()` - Récupération de l’historique des modifications  
- `add_to_history($type, $data)` - Ajout d’une entrée dans l’historique  

### 3. Contrôleur (`controllers/Headerfooter.php`)

**Endpoints :**

- `export_config()` - Téléchargement de la configuration au format JSON  
- `import_config()` - Import d’une configuration depuis un fichier JSON  
- `get_history()` - Récupération de l’historique au format JSON  






## Ajout de fonctionnalités

### Ajouter un nouveau type de code (ex : JavaScript mobile spécifique)

**Étape 1 :** 

Ajouter l’option dans `install.php`

```php
add_option('admin_mobile_js', '');
```

**Étape 2 :** 

Ajouter le getter dans `Headerfooter_helper.php`

```php
public static function get_admin_mobile_js()
{
    return get_option('admin_mobile_js', '');
}
```

**Étape 3 :** 

Ajouter à l’export / import dans `get_all_settings()`

```php
'admin_mobile_js' => get_option('admin_mobile_js', ''),
```

**Étape 4 :** 

Ajouter la fonction d’injection dans le fichier principal du module

```php
hooks()->add_action('app_admin_footer', 'headerfooter_output_mobile_js');

function headerfooter_output_mobile_js()
{
    require_once(__DIR__ . '/Headerfooter_helper.php');
    $mobile_js = Headerfooter_helper::get_admin_mobile_js();
    if (!empty($mobile_js)) {
        echo '<script type="text/javascript">' . "\n";
        echo $mobile_js . "\n";
        echo '</script>' . "\n";
    }
}
```

**Étape 5 :** 

Ajouter l’interface utilisateur dans `views/admin/settings/headerfooter_js_settings.php`

```html
<h5><?php echo _l('headerfooter_admin_mobile_js'); ?></h5>
<?php echo render_textarea('settings[admin_mobile_js]', '', get_option('admin_mobile_js'), array('rows'=>12)); ?>
```

**Étape 6 :** 

Ajouter la chaîne de traduction (language string)

```php
$lang['headerfooter_admin_mobile_js'] = 'Admin Mobile JavaScript';
```

## Fonctions disponibles dans Perfex

Ces fonctions sont accessibles dans l’ensemble du système Perfex CRM :

```php

// Options
get_option($option_name, $default = '')
update_option($option_name, $value)
add_option($option_name, $value)

// User
get_staff_user_id()
is_admin()

// URLs
admin_url($path = '')
app_url($path = '')
site_url($path = '')

// Hooks
hooks()->add_action($hook, $function_name)
hooks()->add_filter($hook, $function_name, $priority, $accepted_args)

// Utilities
_l($lang_key)  // Get language string
log_activity($description)  // Log activity

// Database (advanced)
$CI = &get_instance();
$CI->db->where('id', $id)->get('table_name')->row();

```

## API Reference

### Export Configuration

```

GET /admin/headerfooter/export_config
Response: JSON file download

```

### Import Configuration

```

POST /admin/headerfooter/import_config
Content-Type: multipart/form-data
Body: config_file (JSON file)
Response: JSON {"success": true/false, "message": "..."}

```

### Get History

```

GET /admin/headerfooter/get_history
Response: JSON array of history entries

```

## Validation Rules

### JavaScript Validation

- Balanced braces `{}`
- Balanced parentheses `()`
- Closed quotes `"` and `'`

### CSS Validation

- Balanced braces `{}`

### HTML Validation

- No `<script>` tags
- No inline event handlers (`onclick`, `onerror`, etc.)
- Allowed tags: `div`, `span`, `p`, `h1-h6`, `a`, `img`, `strong`, `em`, `ul`, `ol`, `li`, `br`, `hr`

## Data Storage

All settings are stored in Perfex options table:

```

admin_header_js      - JavaScript for admin head
admin_footer_js      - JavaScript for admin footer
admin_css            - CSS for admin
admin_html_header    - HTML for admin head
customer_header_js   - JavaScript for customer head
customer_footer_js   - JavaScript for customer footer
customer_css         - CSS for customer
customer_html_header - HTML for customer head
headerfooter_history - JSON array of changes

```

## Considérations de sécurité

1. **Validation HTML :** empêche les attaques XSS en bloquant les balises script  
2. **Filtrage des événements :** suppression des gestionnaires d’événements inline  
3. **Permissions utilisateur :** accès limité uniquement aux administrateurs  
4. **Journalisation des actions :** toutes les modifications sont enregistrées pour audit  
5. **Alertes de validation :** les erreurs sont loggées sans bloquer le système  

## Optimisation des performances

1. **Chargement différé :** le helper est chargé uniquement si nécessaire  
2. **Sortie anticipée :** les blocs vides ne sont pas traités  
3. **DOM minimal :** aucune surcharge inutile du DOM  
4. **Validation optimisée :** utilisation de regex performantes  
5. **Limitation de l’historique :** conservation des 20 dernières entrées (configurable)  

## Checklist de tests

- [ ] Le JavaScript s’exécute au bon emplacement (head/footer)  
- [ ] Le CSS s’applique correctement (admin / client)  
- [ ] Le HTML est rendu sans suppression de contenu valide  
- [ ] Les erreurs de syntaxe sont détectées par la validation  
- [ ] L’export génère un fichier JSON valide  
- [ ] L’import restaure correctement la configuration  
- [ ] L’historique enregistre toutes les modifications  
- [ ] Les options admin n’apparaissent pas côté client  
- [ ] Les options client n’apparaissent pas côté admin  
- [ ] Le module fonctionne en environnement multi-utilisateurs  

## Dépannage

### Le code ne s’exécute pas

1. Vérifier que l’option est bien enregistrée (interface admin)  
2. Contrôler la console navigateur pour les erreurs  
3. Vérifier le bon contexte (admin vs client)  
4. Vider le cache Perfex  

### Échec de validation

1. Vérifier la syntaxe dans la console navigateur  
2. Utiliser des validateurs externes (JS/CSS)  
3. Contrôler les caractères spéciaux non échappés  

### Problèmes d’export / import

1. Vérifier que le fichier JSON est valide  
2. Contrôler les permissions du fichier  
3. S’assurer que toutes les clés requises sont présentes  

## Évolutions futures

Ajouts possibles pour les prochaines versions :

- [ ] Support SCSS / LESS  
- [ ] Support TypeScript  
- [ ] Versioning du code (historique plus détaillé)  
- [ ] Exécution conditionnelle du code (par rôle utilisateur, date, etc.)  
- [ ] Bibliothèque de snippets de code  
- [ ] Prévisualisation en temps réel  
- [ ] Visualisation des différences entre versions (diff viewer)  
- [ ] Planification d’exécution du code  

## Contribution

Lors de l’extension du module :

1. Maintenir la compatibilité ascendante  
2. Ajouter les chaînes de traduction pour chaque nouvelle fonctionnalité  
3. Documenter toutes les modifications de l’API  
4. Mettre à jour le fichier FEATURES.md  
5. Ajouter des exemples dans EXAMPLES.php  
6. Tester l’ensemble de manière complète  

## Dernière mise à jour

23 avril 2026