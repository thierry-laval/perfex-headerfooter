<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Headerfooter extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        // S'assure que le helper est chargé pour toutes les actions du contrôleur.
        // Cela permet d'accéder aux fonctions de validation, d'export/import et d'historique.
        require_once(__DIR__ . '/../Headerfooter_helper.php');
    }

    /**
     * Vérifie si l'utilisateur connecté est un administrateur.
     * Si ce n'est pas le cas, il est redirigé vers l'URL d'administration par défaut.
     * Cette mesure de sécurité garantit que seules les personnes autorisées peuvent accéder aux fonctionnalités du module.
     */
    private function check_admin_access()
    {
        if (!is_admin()) {
            redirect(admin_url());
        }
    }

    /**
     * Exporte la configuration actuelle du module sous forme de fichier JSON.
     * Cette fonction est accessible via une route spécifique et déclenche le téléchargement du fichier.
     * Elle utilise le helper pour récupérer toutes les options du module.
     */
    public function export_config()
    {
        $this->check_admin_access();

        require_once(__DIR__ . '/../Headerfooter_helper.php');
        
        // Récupère la configuration formatée en JSON depuis le helper.
        $config = Headerfooter_helper::export_config();
        
        // Définit les en-têtes HTTP pour forcer le téléchargement du fichier JSON.
        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename="headerfooter_config_' . date('Y-m-d_H-i-s') . '.json"');
        header('Content-Length: ' . strlen($config));
        
        // Affiche le contenu JSON et termine l'exécution.
        echo $config;
        exit;
    }

    /**
     * Importe une configuration à partir d'un fichier JSON téléchargé.
     * Cette fonction est utilisée pour restaurer les paramètres du module à partir d'une sauvegarde.
     * Elle vérifie la présence du fichier et utilise le helper pour traiter l'importation.
     */
    public function import_config()
    {
        $this->check_admin_access();

        // Vérifie si un fichier a été correctement téléchargé.
        if (!isset($_FILES['config_file'])) {
            echo json_encode(['success' => false, 'message' => 'No file uploaded']);
            exit;
        }

        // Lit le contenu du fichier temporaire téléchargé.
        $file_content = file_get_contents($_FILES['config_file']['tmp_name']);
        
        require_once(__DIR__ . '/../Headerfooter_helper.php');
        // Appelle la méthode d'importation du helper et récupère le résultat.
        $result = Headerfooter_helper::import_config($file_content);
        
        // Renvoie le résultat de l'importation (succès/échec) au format JSON.
        echo json_encode($result);
        exit;
    }

    /**
     * Récupère l'historique des modifications du module au format JSON.
     * Cette fonction est utilisée pour afficher l'historique dans l'interface d'administration.
     */
    public function get_history()
    {
        $this->check_admin_access();

        require_once(__DIR__ . '/../Headerfooter_helper.php');
        // Récupère l'historique depuis le helper.
        $history = Headerfooter_helper::get_history();
        
        // Renvoie l'historique au format JSON.
        echo json_encode($history);
        exit;
    }
}
