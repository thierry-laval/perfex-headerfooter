<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: Perfex Header & Footer
Description: Permet d'insérer du code JavaScript, CSS et HTML personnalisé dans l'en-tête et le pied de page de l'administration et de l'espace client de Perfex CRM.
Version: 1.5
Author: thierrylaval.dev
Author URI: https://thierrylaval.dev
*/

define('PERFEX_HEADERFOOTER', 'perfex_headerfooter');

// Configuration des hooks (points d'accroche) du système
hooks()->add_action('admin_init', 'perfex_headerfooter_setup_init_menu_items');
hooks()->add_filter('before_setting_option_update', 'perfex_headerfooter_validate_options', 10, 2);

hooks()->add_action('app_admin_head', 'headerfooter_js_admin_head');
hooks()->add_action('app_admin_authentication_head', 'headerfooter_js_admin_head');
hooks()->add_action('app_admin_footer', 'headerfooter_js_admin_footer');
hooks()->add_action('app_admin_authentication_footer', 'headerfooter_js_admin_footer');

hooks()->add_action('app_customers_head', 'headerfooter_js_customer_head');
hooks()->add_action('app_customer_authentication_head', 'headerfooter_js_customer_head');
hooks()->add_action('app_customers_footer', 'headerfooter_js_customer_footer');
hooks()->add_action('app_customer_authentication_footer', 'headerfooter_js_customer_footer');

/**
* Enregistrement du hook d'activation du module.
* Cette fonction est appelée une seule fois lorsque le module est activé dans l'interface admin.
*/
register_activation_hook(PERFEX_HEADERFOOTER, 'perfex_headerfooter_module_activation_hook');

function perfex_headerfooter_module_activation_hook()
{
    $CI = &get_instance();
    // Inclusion du fichier d'installation pour configurer les options par défaut en base de données.
    require_once(__DIR__ . '/install.php');
}

/**
* Enregistrement des fichiers de langue.
* Indispensable pour que Perfex puisse charger les traductions correspondantes.
*/
register_language_files(PERFEX_HEADERFOOTER, [PERFEX_HEADERFOOTER]);

/**
 * Initialisation des menus du module dans la section "Configuration".
 * S'exécute sur le hook 'admin_init'.
/**
 * Initialisation des menus du module dans la section "Configuration".
 * S'exécute sur le hook 'admin_init'.
 * @return null
 */
function perfex_headerfooter_setup_init_menu_items()
{
    /**
    * Si l'utilisateur connecté est un administrateur, on ajoute un onglet personnalisé dans les réglages.
    */
    if (is_admin()) {
        $CI = &get_instance();
        // Ajout de l'onglet pour le code personnalisé
        $CI->app_tabs->add_settings_tab('headerfooter_js', [
            'name'     => _l('headerfooter_javascript'),
            'view'     => PERFEX_HEADERFOOTER.'/admin/settings/headerfooter_js_settings',
            'position' => 95,
        ]);
    }
}

/**
 * Injecte le code personnalisé dans l'en-tête (<head>) de l'administration.
 */
function headerfooter_js_admin_head()
{
    require_once(__DIR__ . '/Headerfooter_helper.php');
    
    // Injection du CSS : doit être placé dans le <head> pour éviter le saut de style (FOUC)
    // lors du chargement de la page.
    $admin_css = Headerfooter_helper::get_admin_css();
    if (!empty($admin_css)) {
        echo '<style type="text/css">' . "\n";
        echo $admin_css . "\n";
        echo '</style>' . "\n";
    }

    // Injection du HTML personnalisé pour l'en-tête admin
    $admin_html = Headerfooter_helper::get_admin_html_header();
    if (!empty($admin_html)) {
        echo $admin_html . "\n";
    }

    // Injection du JavaScript pour l'en-tête admin
    $admin_header = Headerfooter_helper::get_admin_header();
    if (!empty($admin_header)) {
        echo '<script type="text/javascript">' . "\n";
        echo $admin_header . "\n";
        echo '</script>' . "\n";
    }
}

/**
 * Injecte le code JavaScript dans le pied de page (avant </body>) de l'administration.
 */
function headerfooter_js_admin_footer()
{
    require_once(__DIR__ . '/Headerfooter_helper.php');
    
    // Injection du JavaScript pour le pied de page admin
    $admin_footer = Headerfooter_helper::get_admin_footer();
    if (!empty($admin_footer)) {
        echo '<script type="text/javascript">' . "\n";
        echo $admin_footer . "\n";
        echo '</script>' . "\n";
    }
}

/**
 * Injecte le code personnalisé dans l'en-tête (<head>) de l'espace client.
 */
function headerfooter_js_customer_head()
{
    require_once(__DIR__ . '/Headerfooter_helper.php');
    
    // Injection du CSS personnalisé pour l'espace client
    $customer_css = Headerfooter_helper::get_customer_css();
    if (!empty($customer_css)) {
        echo '<style type="text/css">' . "\n";
        echo $customer_css . "\n";
        echo '</style>' . "\n";
    }

    // Injection du HTML personnalisé pour l'en-tête client
    $customer_html = Headerfooter_helper::get_customer_html_header();
    if (!empty($customer_html)) {
        echo $customer_html . "\n";
    }

    // Injection du JavaScript pour l'en-tête client
    $customer_header = Headerfooter_helper::get_customer_header();
    if (!empty($customer_header)) {
        echo '<script type="text/javascript">' . "\n";
        echo $customer_header . "\n";
        echo '</script>' . "\n";
    }
}

/**
 * Injecte le code JavaScript dans le pied de page de l'espace client.
 */
function headerfooter_js_customer_footer()
{
    require_once(__DIR__ . '/Headerfooter_helper.php');
    
    // Injection du JavaScript pour le pied de page client
    $customer_footer = Headerfooter_helper::get_customer_footer();
    if (!empty($customer_footer)) {
        echo '<script type="text/javascript">' . "\n";
        echo $customer_footer . "\n";
        echo '</script>' . "\n";
    }
}

/**
 * Valide et traite les options avant qu'elles ne soient enregistrées en base de données.
 * Permet de vérifier la syntaxe et de prévenir les erreurs bloquantes.
 * @param array $options
 * @param string $key
 * @return array
 */
function perfex_headerfooter_validate_options($options, $key)
{
    require_once(__DIR__ . '/Headerfooter_helper.php');
    
    // Liste des options gérées par ce module
    $headerfooter_options = [
        'admin_header_js', 'admin_footer_js', 'admin_css', 'admin_html_header',
        'customer_header_js', 'customer_footer_js', 'customer_css', 'customer_html_header'
    ];

    if (!in_array($key, $headerfooter_options)) {
        return $options;
    }

    // Validation spécifique pour le JavaScript (vérification des parenthèses/accolades)
    if (strpos($key, '_js') !== false) {
        $errors = Headerfooter_helper::validate_javascript($options[$key]);
        if (!empty($errors)) {
            // Enregistre les erreurs dans le journal d'activité sans bloquer la sauvegarde
            log_activity('Header Footer: JavaScript validation warning - ' . implode(', ', $errors));
        }
    }

    // Validation spécifique pour le CSS
    if ($key === 'admin_css' || $key === 'customer_css') {
        $errors = Headerfooter_helper::validate_css($options[$key]);
        if (!empty($errors)) {
            log_activity('Header Footer: CSS validation warning - ' . implode(', ', $errors));
        }
    }

    // Validation spécifique pour le HTML (filtre de sécurité)
    if (strpos($key, '_html_') !== false) {
        $errors = Headerfooter_helper::validate_html($options[$key]);
        if (!empty($errors)) {
            log_activity('Header Footer: HTML validation warning - ' . implode(', ', $errors));
        }
    }

    // Ajout de l'entrée dans l'historique après la validation
    Headerfooter_helper::add_to_history('update', [
        'option_key' => $key,
        'length' => strlen($options[$key])
    ]);

    return $options;
}
