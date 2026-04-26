<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Initialisation des options pour l'administration
add_option('admin_header_js', '');
add_option('admin_footer_js', '');
add_option('admin_css', '');
add_option('admin_html_header', '');

// Initialisation des options pour l'espace client
add_option('customer_header_js', '');
add_option('customer_footer_js', '');
add_option('customer_css', '');
add_option('customer_html_header', '');

// Initialisation du stockage de l'historique sous forme de JSON vide
add_option('headerfooter_history', '[]');
