<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Classe Helper Header Footer
 * Gère l'ensemble des fonctionnalités de récupération, validation et historique du code personnalisé.
 * Développé par thierrylaval.dev - Version 1.5
 */
class Headerfooter_helper
{
    /**
     * Récupère le code JavaScript configuré pour l'en-tête de l'administration.
     * @return string
     */
    public static function get_admin_header()
    {
        return get_option('admin_header_js');
    }

    /**
     * Récupère le code JavaScript configuré pour le pied de page de l'administration.
     * @return string
     */
    public static function get_admin_footer()
    {
        return get_option('admin_footer_js');
    }

    /**
     * Récupère le code JavaScript configuré pour l'en-tête de l'espace client.
     * @return string
     */
    public static function get_customer_header()
    {
        return get_option('customer_header_js');
    }

    /**
     * Récupère le code JavaScript configuré pour le pied de page de l'espace client.
     * @return string
     */
    public static function get_customer_footer()
    {
        return get_option('customer_footer_js');
    }

    /**
     * Récupère les styles CSS personnalisés pour le panneau d'administration.
     * @return string
     */
    public static function get_admin_css()
    {
        return get_option('admin_css', '');
    }

    /**
     * Récupère les styles CSS personnalisés pour l'espace client.
     * @return string
     */
    public static function get_customer_css()
    {
        return get_option('customer_css', '');
    }

    /**
     * Récupère le code HTML personnalisé pour l'en-tête de l'administration.
     * @return string
     */
    public static function get_admin_html_header()
    {
        return get_option('admin_html_header', '');
    }

    /**
     * Récupère le code HTML personnalisé pour l'en-tête de l'espace client.
     * @return string
     */
    public static function get_customer_html_header()
    {
        return get_option('customer_html_header', '');
    }

    /**
     * Valide la syntaxe de base du code JavaScript.
     * Vérifie si les parenthèses, accolades et guillemets sont correctement fermés.
     * @param string $code
     * @return array
     */
    public static function validate_javascript($code)
    {
        $errors = [];
        
        // Analyse de la structure syntaxique : vérification de la parité des accolades.
        // Un déséquilibre ici peut briser l'exécution de tout le JS du panneau admin ou client.
        $open_braces = substr_count($code, '{');
        $close_braces = substr_count($code, '}');
        
        if ($open_braces !== $close_braces) {
            $errors[] = 'Déséquilibre détecté : ' . $open_braces . ' accolades ouvertes pour ' . $close_braces . ' fermées.';
        }

        // Vérification des parenthèses : critique pour les appels de fonctions et les conditions.
        $open_parens = substr_count($code, '(');
        $close_parens = substr_count($code, ')');
        
        if ($open_parens !== $close_parens) {
            $errors[] = 'Déséquilibre détecté : ' . $open_parens . ' parenthèses ouvertes pour ' . $close_parens . ' fermées.';
        }

        // Vérification élémentaire des chaînes de caractères.
        // On soustrait les guillemets échappés (\' ou \") pour éviter les faux positifs.
        $single_quotes = substr_count($code, "'") - substr_count($code, "\\'");
        $double_quotes = substr_count($code, '"') - substr_count($code, '\\"');
        
        if ($single_quotes % 2 !== 0) {
            $errors[] = 'Guillemets simples non fermés dans le code JavaScript';
        }

        if ($double_quotes % 2 !== 0) {
            $errors[] = 'Guillemets doubles non fermés dans le code JavaScript';
        }

        return $errors;
    }

    /**
     * Valide la syntaxe de base du code CSS.
     * Vérifie principalement que les blocs de déclaration sont bien fermés.
     * @param string $code
     * @return array
     */
    public static function validate_css($code)
    {
        $errors = [];
        
        // Vérification des accolades pour le CSS
        $open_braces = substr_count($code, '{');
        $close_braces = substr_count($code, '}');
        
        if ($open_braces !== $close_braces) {
            $errors[] = 'Accolades non fermées dans le code CSS';
        }

        return $errors;
    }

    /**
     * Valide le code HTML pour assurer la sécurité et l'intégrité de la page.
     * Empêche l'utilisation de balises <script> ou de gestionnaires d'événements dans les zones HTML.
     * @param string $code
     * @return array
     */
    public static function validate_html($code)
    {
        $errors = [];
        $allowed_tags = ['div', 'span', 'p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'a', 'img', 'strong', 'em', 'ul', 'ol', 'li', 'br', 'hr'];
        
        // Interdiction des balises script dans la section HTML pure
        if (preg_match('/<script/i', $code)) {
            $errors[] = 'Les balises <script> ne sont pas autorisées dans le code HTML (utilisez les sections JS)';
        }

        // Recherche d'attributs d'événements dangereux (onclick, onerror, etc.)
        if (preg_match('/on\w+\s*=/i', $code)) {
            $errors[] = 'Les gestionnaires d\'événements (ex: onclick) ne sont pas autorisés dans le code HTML';
        }

        return $errors;
    }

    /**
     * Récupère l'ensemble des paramètres du module sous forme de tableau associatif.
     * @return array
     */
    public static function get_all_settings()
    {
        return [
            'admin_header_js' => get_option('admin_header_js'),
            'admin_footer_js' => get_option('admin_footer_js'),
            'admin_css' => get_option('admin_css', ''),
            'admin_html_header' => get_option('admin_html_header', ''),
            'customer_header_js' => get_option('customer_header_js'),
            'customer_footer_js' => get_option('customer_footer_js'),
            'customer_css' => get_option('customer_css', ''),
            'customer_html_header' => get_option('customer_html_header', ''),
        ];
    }

    /**
     * Récupère l'historique des modifications stocké en base de données.
     * Désérialise le JSON pour retourner un tableau.
     * @return array
     */
    public static function get_history()
    {
        $history = get_option('headerfooter_history', []);
        if (is_string($history)) {
            $history = json_decode($history, true) ?: [];
        }
        return is_array($history) ? $history : [];
    }

    /**
     * Ajoute une nouvelle action à l'historique des modifications.
     * Conserve uniquement les 20 entrées les plus récentes pour optimiser la base de données.
     * @param string $type
     * @param array $data
     */
    public static function add_to_history($type = 'update', $data = [])
    {
        $history = self::get_history();
        
        // Limitation aux 20 dernières entrées
        if (count($history) >= 20) {
            array_shift($history);
        }

        $entry = [
            'timestamp' => date('Y-m-d H:i:s'),
            'type' => $type,
            'user_id' => get_staff_user_id(),
            'data' => $data
        ];

        $history[] = $entry;
        update_option('headerfooter_history', json_encode($history));
    }

    /**
     * Génère une chaîne JSON contenant la configuration actuelle pour l'export.
     * @return string
     */
    public static function export_config()
    {
        $config = self::get_all_settings();
        $config['export_date'] = date('Y-m-d H:i:s');
        $config['version'] = '1.5';
        
        return json_encode($config, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    /**
     * Importe une configuration depuis un fichier JSON.
     * Vérifie la validité du format et met à jour les options de Perfex.
     * @param string $json_data
     * @return array
     */
    public static function import_config($json_data)
    {
        try {
            $config = json_decode($json_data, true);
            
            if (!is_array($config)) {
                return ['success' => false, 'message' => 'Format JSON invalide'];
            }

            $allowed_keys = [
                'admin_header_js', 'admin_footer_js', 'admin_css', 'admin_html_header',
                'customer_header_js', 'customer_footer_js', 'customer_css', 'customer_html_header'
            ];

            $imported = 0;
            foreach ($allowed_keys as $key) {
                if (isset($config[$key])) {
                    update_option($key, $config[$key]);
                    $imported++;
                }
            }

            self::add_to_history('import', ['imported_count' => $imported]);

            return ['success' => true, 'message' => $imported . ' paramètres importés avec succès'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Erreur lors de l\'importation : ' . $e->getMessage()];
        }
    }
}
