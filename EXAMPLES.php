<?php
/**
 * PERFEX HEADER & FOOTER - EXEMPLES DE CODE
 * 
 * Ce fichier contient des exemples pratiques que vous pouvez copier et coller
 * dans les paramètres du module Perfex Header & Footer (thierrylaval.dev).
 * Version : 1.5
 */

// EXEMPLES D'ANALYTIQUE ET DE SUIVI

/**
 * EXEMPLE 1 : Suivi Google Analytics (Panneau d'administration)
 * À placer dans : Configuration → Réglages → Code personnalisé → JavaScript de l'en-tête Admin
 */
?>
<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'GA_MEASUREMENT_ID');

  // Suivi des sessions d'administration
  gtag('event', 'admin_session', {
    'session_timestamp': new Date().toISOString()
  });
</script>

<?php
/**
 * EXEMPLE 2 : Analytique Segment.com (Espace Client)
 * À placer dans : Configuration → Réglages → Code personnalisé → JavaScript de l'en-tête Client
 */
?>
<script>
  !function(){var analytics=window.analytics=window.analytics||[];if(!analytics.initialize)if(analytics.invoked)window.console&&console.error&&console.error("Segment snippet included twice.");else{analytics.invoked=!0;analytics.methods=["trackSubmit","trackClick","trackLink","trackForm","pageview","identify","reset","group","track","ready","alias","debug","page","once","off","on","addSourceMiddleware","addIntegrationMiddleware","setAnonymousId","addDestinationMiddleware"];analytics.factory=function(e){return function(){var t=Array.prototype.slice.call(arguments);t.unshift(e);analytics.push(t);return analytics}};for(var e=0;e<analytics.methods.length;e++){var t=analytics.methods[e];analytics[t]=analytics.factory(t)}analytics.load=function(e,t){var n=document.createElement("script");n.type="text/javascript";n.async=!0;n.src="https://cdn.segment.com/analytics.js/v1/"+e+"/analytics.min.js";var a=document.getElementsByTagName("script")[0];a.parentNode.insertBefore(n,a);analytics._loadOptions=t};analytics.SNIPPET_VERSION="4.13.1";analytics.load("SEGMENT_WRITE_KEY");analytics.page();}};
</script>

<?php
/**
 * EXEMPLE 3 : Cartes de chaleur Hotjar (Espace Client)
 * À placer dans : Configuration → Réglages → Code personnalisé → JavaScript de l'en-tête Client
 */
?>
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:123456,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>

<?php
/**
 * EXEMPLE 4 : Suivi d'événements personnalisés
 * Suivre des actions spécifiques dans l'administration
 * À placer dans : Configuration → Réglages → Code personnalisé → JavaScript du pied de page Admin
 */
?>
<script>
  jQuery(document).ready(function() {
    // Suivi lorsque l'utilisateur navigue vers des sections spécifiques
    jQuery('a[href*="/admin/"]').on('click', function() {
      var section = jQuery(this).attr('href');
      console.log('Navigation vers : ' + section);
      
      // Envoi vers vos outils analytiques
      if (window.gtag) {
        gtag('event', 'admin_section_click', {
          'section': section,
          'timestamp': new Date().toISOString()
        });
      }
    });

    // Suivi des soumissions de formulaires
    jQuery('form').on('submit', function() {
      var formId = jQuery(this).attr('id') || 'unknown';
      if (window.gtag) {
        gtag('event', 'form_submission', {
          'form_id': formId
        });
      }
    });
  });
</script>

<?php
// EXEMPLES DE STYLE ET D'IDENTITÉ VISUELLE (BRANDING)

/**
 * EXEMPLE 5 : Thème Admin personnalisé
 * À placer dans : Configuration → Réglages → Code personnalisé → CSS Admin
 */
?>
/* Personnalisation de la barre de navigation supérieure */
.navbar-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.navbar-brand a {
    font-weight: bold;
    font-size: 18px;
    color: #fff !important;
}

/* Personnalisation de la barre latérale (sidebar) */
.sidebar {
    background-color: #2c3e50;
}

.sidebar a {
    color: #ecf0f1;
    transition: all 0.3s ease;
}

.sidebar a:hover,
.sidebar a.active {
    background-color: #667eea;
    color: #fff;
    border-left: 4px solid #fff;
}

/* Styles personnalisés pour les boutons */
.btn-primary {
    background-color: #667eea;
    border-color: #667eea;
}

.btn-primary:hover {
    background-color: #764ba2;
    border-color: #764ba2;
}

/* Personnalisation des tableaux */
.table thead th {
    background-color: #667eea;
    color: white;
    border: none;
}

.table tbody tr:hover {
    background-color: #f5f5f5;
}

<?php
/**
 * EXEMPLE 6 : Styles Responsive (Mobile-First)
 * À placer dans : Configuration → Réglages → Code personnalisé → CSS Client
 */
?>
/* Design responsive mobile-first */
.custom-container {
    padding: 10px;
}

/* Tablettes et plus */
@media (min-width: 768px) {
    .custom-container {
        padding: 20px;
    }
}

/* Ordinateurs de bureau */
@media (min-width: 1024px) {
    .custom-container {
        padding: 40px;
    }
}

/* Support du mode sombre du système */
@media (prefers-color-scheme: dark) {
    .custom-widget {
        background-color: #2c3e50;
        color: #ecf0f1;
    }
}

<?php
// EXEMPLES D'AMÉLIORATION DES FONCTIONNALITÉS

/**
 * EXEMPLE 7 : Ajouter un widget Admin personnalisé
 * À placer dans : Configuration → Réglages → Code personnalisé → JavaScript du pied de page Admin
 */
?>
<script>
  jQuery(document).ready(function() {
    // Création d'un widget flottant personnalisé
    var widget = jQuery(`
      <div id="custom-admin-widget" style="
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 9999;
        min-width: 250px;
        font-family: Arial, sans-serif;
      ">
        <h4 style="margin: 0 0 10px 0; font-size: 14px; font-weight: bold;">Stats Rapides</h4>
        <div style="font-size: 12px; line-height: 1.8;">
          <p>Widget du Tableau de Bord</p>
          <p id="current-time"></p>
        </div>
        <button id="close-widget" style="
          background: #f5f5f5;
          border: none;
          padding: 5px 10px;
          border-radius: 4px;
          cursor: pointer;
          font-size: 12px;
        ">Fermer</button>
      </div>
    `);

    jQuery('body').append(widget);

    // Mise à jour de l'heure en temps réel
    setInterval(function() {
      jQuery('#current-time').text('Heure : ' + new Date().toLocaleTimeString());
    }, 1000);

    // Gestion du bouton de fermeture
    jQuery('#close-widget').on('click', function() {
      widget.fadeOut(300, function() { jQuery(this).remove(); });
    });
  });
</script>

<?php
/**
 * EXEMPLE 8 : Message de bienvenue sur le portail client
 * À placer dans : Configuration → Réglages → Code personnalisé → En-tête HTML Client
 */
?>
<style>
  .custom-welcome-banner {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 20px;
    border-radius: 4px;
    margin-bottom: 20px;
    text-align: center;
  }
  .custom-welcome-banner h2 {
    margin: 0 0 10px 0;
  }
  .custom-welcome-banner p {
    margin: 0;
    font-size: 14px;
    opacity: 0.9;
  }
</style>

<div class="custom-welcome-banner">
  <h2>Bienvenue sur votre compte</h2>
  <p>Gérez vos projets, factures et bien plus encore depuis cet espace.</p>
</div>

<?php
/**
 * EXEMPLE 9 : Validation de formulaire améliorée
 * À placer dans : Configuration → Réglages → Code personnalisé → JavaScript du pied de page Admin
 */
?>
<script>
  jQuery(document).ready(function() {
    // Ajout d'une validation simple aux formulaires
    jQuery('form').on('submit', function(e) {
      var form = jQuery(this);
      var isValid = true;

      // Vérification des champs requis
      form.find('[required]').each(function() {
        var field = jQuery(this);
        if (!field.val() || field.val().trim() === '') {
          field.addClass('is-invalid');
          isValid = false;
        } else {
          field.removeClass('is-invalid');
        }
      });

      if (!isValid) {
        e.preventDefault();
        alert('Veuillez remplir tous les champs obligatoires.');
        return false;
      }
    });

    // Retour visuel immédiat lors de la perte de focus
    jQuery('[required]').on('blur', function() {
      if (jQuery(this).val().trim() === '') {
        jQuery(this).addClass('is-invalid');
      } else {
        jQuery(this).removeClass('is-invalid');
      }
    });
  });
</script>

<style>
  .is-invalid {
    border-color: #dc3545 !important;
    background-color: #fff5f5 !important;
  }
</style>

<?php
/**
 * EXEMPLE 10 : Basculeur de mode sombre (Dark Mode Toggle)
 * À placer dans : Configuration → Réglages → Code personnalisé → JavaScript du pied de page Admin
 */
?>
<script>
  jQuery(document).ready(function() {
    // Vérification de la préférence sauvegardée ou défaut sur 'light'
    const currentTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-theme', currentTheme);

    // Création du bouton de bascule
    var toggleBtn = jQuery(`
      <button id="theme-toggle" style="
        position: fixed;
        top: 20px;
        right: 20px;
        background: #667eea;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 50%;
        cursor: pointer;
        z-index: 9999;
        width: 40px;
        height: 40px;
        font-size: 16px;
      ">🌙</button>
    `);

    jQuery('body').append(toggleBtn);

    jQuery('#theme-toggle').on('click', function() {
      const theme = document.documentElement.getAttribute('data-theme');
      const newTheme = theme === 'light' ? 'dark' : 'light';
      
      document.documentElement.setAttribute('data-theme', newTheme);
      localStorage.setItem('theme', newTheme);
      
      jQuery(this).text(newTheme === 'light' ? '🌙' : '☀️');
    });
  });
</script>

<?php
// EXEMPLES DE SÉCURITÉ ET DE SURVEILLANCE

/**
 * EXEMPLE 11 : Journalisation de l'activité (Côté Navigateur)
 * À placer dans : Configuration → Réglages → Code personnalisé → JavaScript du pied de page Admin
 */
?>
<script>
  // Création d'un objet de journalisation
  window.activityLog = {
    events: [],
    maxEvents: 50,

    log: function(action, details) {
      this.events.push({
        timestamp: new Date().toISOString(),
        action: action,
        details: details,
        url: window.location.href
      });

      // Conserver uniquement les événements récents
      if (this.events.length > this.maxEvents) {
        this.events.shift();
      }

      // Enregistrer dans localStorage
      localStorage.setItem('adminActivityLog', JSON.stringify(this.events));
    },

    getLog: function() {
      return this.events;
    }
  };

  // Journaliser la navigation interne
  jQuery(document).on('click', 'a[href*="/admin/"]', function() {
    window.activityLog.log('navigation', {
      'target': jQuery(this).attr('href'),
      'text': jQuery(this).text()
    });
  });

  // Journaliser les soumissions de formulaires
  jQuery(document).on('submit', 'form', function() {
    window.activityLog.log('form_submit', {
      'formId': jQuery(this).attr('id'),
      'action': jQuery(this).attr('action')
    });
  });
</script>

<?php
/**
 * EXEMPLE 12 : Avertissement d'expiration de session
 * À placer dans : Configuration → Réglages → Code personnalisé → JavaScript du pied de page Admin
 */
?>
<script>
  var inactivityTimer;
  var warningTimer;
  var inactivityTimeout = 15 * 60 * 1000; // 15 minutes
  var warningTimeout = 13 * 60 * 1000;    // 13 minutes

  function resetTimer() {
    clearTimeout(inactivityTimer);
    clearTimeout(warningTimer);

    warningTimer = setTimeout(function() {
      jQuery.notify({
        message: 'Votre session va expirer dans 2 minutes pour cause d\'inactivité.',
        icon: 'glyphicon glyphicon-warning-sign',
        type: 'warning',
        url: '#',
        target: '_blank'
      }, {
        type: 'warning',
        placement: {
          from: 'top',
          align: 'center'
        },
        timer: 10000
      });
    }, warningTimeout);

    inactivityTimer = setTimeout(function() {
      // Session expirée - redirection vers la déconnexion
      window.location.href = admin_url + 'authentication/logout';
    }, inactivityTimeout);
  }

  // Réinitialiser le minuteur lors de l'activité de l'utilisateur
  jQuery(document).on('mousemove keypress click scroll', function() {
    resetTimer();
  });

  // Initialisation au chargement
  resetTimer();
</script>

<?php
// EXEMPLES D'INTÉGRATION

/**
 * EXEMPLE 13 : Notification Slack (Espace Client)
 * Envoyer des notifications vers un Webhook Slack
 * À placer dans : Configuration → Réglages → Code personnalisé → JavaScript du pied de page Client
 */
?>
<script>
  window.SlackNotifier = {
    webhookUrl: 'VOTRE_URL_WEBHOOK_SLACK',

    send: function(message, details) {
      var payload = {
        text: message,
        attachments: [{
          text: JSON.stringify(details),
          color: 'good'
        }]
      };

      // Remarque : Le CORS peut bloquer cela - l'idéal est de passer par un proxy backend
      jQuery.ajax({
        url: this.webhookUrl,
        type: 'POST',
        data: JSON.stringify(payload),
        contentType: 'application/json'
      });
    }
  };

  // Exemple : Notifier lors d'un événement client
  jQuery(document).on('invoiceCreated', function() {
    window.SlackNotifier.send(
      'Nouvelle facture créée par le client',
      { timestamp: new Date().toISOString() }
    );
  });
</script>

<?php
/**
 * EXEMPLE 14 : Intégration d'API externe (Admin)
 * Appeler des APIs externes depuis le panneau d'administration
 * À placer dans : Configuration → Réglages → Code personnalisé → JavaScript du pied de page Admin
 */
?>
<script>
  window.ExternalAPI = {
    apiUrl: 'https://api.example.com',
    apiKey: 'VOTRE_CLE_API',

    call: function(endpoint, method, data) {
      return jQuery.ajax({
        url: this.apiUrl + endpoint,
        type: method || 'GET',
        data: JSON.stringify(data),
        contentType: 'application/json',
        headers: {
          'Authorization': 'Bearer ' + this.apiKey
        }
      });
    },

    syncData: function() {
      this.call('/sync', 'POST', {
        source: 'perfex_admin',
        timestamp: new Date().toISOString()
      }).done(function(response) {
        console.log('Synchronisation réussie :', response);
        jQuery.notify({ message: 'Données synchronisées avec succès' }, { type: 'success' });
      }).fail(function(error) {
        console.error('Échec de la synchronisation :', error);
        jQuery.notify({ message: 'Échec de la synchronisation' }, { type: 'danger' });
      });
    }
  };
</script>

<?php
// NOTES

/*
 * CONSEILS IMPORTANTS :
 * 
 * 1. jQuery est toujours disponible - Utilisez jQuery() ou $()
 * 2. Les fonctions Perfex sont disponibles - Utilisez get_option(), etc. (en PHP seulement)
 * 3. Le JS Admin a accès à la variable 'admin_url'
 * 4. Le JS Client a accès à la variable 'app_url'
 * 5. Enveloppez toujours votre code jQuery dans jQuery(document).ready()
 * 6. Utilisez les classes CSS avec précaution pour éviter les conflits avec Perfex
 * 7. Testez d'abord dans la console du navigateur avant d'ajouter au module
 * 8. Utilisez les DevTools du navigateur pour déboguer (F12)
 * 9. Gardez le code minimal et optimisé pour la performance
 * 10. Gérez les erreurs proprement avec des blocs try/catch
 * 
 * VARIABLES PERFEX COMMUNES :
 * - admin_url : URL de base du panneau d'administration
 * - app_url : URL de base de l'espace client
 * - site_url : URL de base du site
 * - get_staff_user_id() : (PHP) Récupère l'ID de l'employé actuel
 * 
 * BIBLIOTHÈQUES DISPONIBLES :
 * - jQuery (3.x)
 * - Bootstrap (3.x ou 4.x selon votre version de Perfex)
 * - Moment.js (manipulation des dates)
 * - Select2 (listes déroulantes améliorées)
 */
?>
