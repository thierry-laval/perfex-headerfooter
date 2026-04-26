<div class="row">
  <div class="col-md-12">
    <h4>Paramètres : <?php echo _l('headerfooter_javascript'); ?></h4>
    
    <!-- Navigation par onglets pour séparer les sections Admin, Client, Historique et Import/Export -->
    <ul class="nav nav-tabs" role="tablist" style="margin-bottom: 20px;">
      <li role="presentation" class="active">
        <a href="#admin_section" aria-controls="admin_section" role="tab" data-toggle="tab">
          <i class="fa fa-cog"></i> <?php echo _l('headerfooter_admin_section'); ?>
        </a>
      </li>
      <li role="presentation">
        <a href="#customer_section" aria-controls="customer_section" role="tab" data-toggle="tab">
          <i class="fa fa-users"></i> <?php echo _l('headerfooter_customer_section'); ?>
        </a>
      </li>
      <li role="presentation">
        <a href="#history_section" aria-controls="history_section" role="tab" data-toggle="tab">
          <i class="fa fa-history"></i> <?php echo _l('headerfooter_history'); ?>
        </a>
      </li>
      <li role="presentation">
        <a href="#import_export" aria-controls="import_export" role="tab" data-toggle="tab">
          <i class="fa fa-download"></i> <?php echo _l('headerfooter_import_export'); ?>
        </a>
      </li>
    </ul>

    <div class="tab-content">
      <!-- Section Administration : Configuration du code pour le panneau d'admin -->
      <div role="tabpanel" class="tab-pane active" id="admin_section">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><?php echo _l('headerfooter_admin_javascript'); ?></h3>
          </div>
          <div class="panel-body">
            <h5><?php echo _l('headerfooter_adminheadjs'); ?></h5>
            <p class="text-muted"><?php echo _l('headerfooter_adminheadjs_help'); ?></p>
            <?php echo render_textarea('settings[admin_header_js]', '', get_option('admin_header_js'), array('rows'=>12, 'data-entities-encode'=>'true', 'class'=>'form-control code-editor')); ?>
            
            <hr />
            
            <h5><?php echo _l('headerfooter_adminfootjs'); ?></h5>
            <p class="text-muted"><?php echo _l('headerfooter_adminfootjs_help'); ?></p>
            <?php echo render_textarea('settings[admin_footer_js]', '', get_option('admin_footer_js'), array('rows'=>12, 'data-entities-encode'=>'true', 'class'=>'form-control code-editor')); ?>
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><?php echo _l('headerfooter_admin_css'); ?></h3>
          </div>
          <div class="panel-body">
            <p class="text-muted"><?php echo _l('headerfooter_admin_css_help'); ?></p>
            <?php echo render_textarea('settings[admin_css]', '', get_option('admin_css'), array('rows'=>12, 'data-entities-encode'=>'true', 'class'=>'form-control code-editor')); ?>
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><?php echo _l('headerfooter_admin_html_header'); ?></h3>
          </div>
          <div class="panel-body">
            <p class="text-muted"><?php echo _l('headerfooter_admin_html_help'); ?></p>
            <?php echo render_textarea('settings[admin_html_header]', '', get_option('admin_html_header'), array('rows'=>10, 'data-entities-encode'=>'true', 'class'=>'form-control')); ?>
          </div>
        </div>
      </div>

      <!-- Section Client : Configuration du code pour l'espace client (frontend) -->
      <div role="tabpanel" class="tab-pane" id="customer_section">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><?php echo _l('headerfooter_customer_javascript'); ?></h3>
          </div>
          <div class="panel-body">
            <h5><?php echo _l('headerfooter_customerheadjs'); ?></h5>
            <p class="text-muted"><?php echo _l('headerfooter_customerheadjs_help'); ?></p>
            <?php echo render_textarea('settings[customer_header_js]', '', get_option('customer_header_js'), array('rows'=>12, 'data-entities-encode'=>'true', 'class'=>'form-control code-editor')); ?>
            
            <hr />
            
            <h5><?php echo _l('headerfooter_customerfootjs'); ?></h5>
            <p class="text-muted"><?php echo _l('headerfooter_customerfootjs_help'); ?></p>
            <?php echo render_textarea('settings[customer_footer_js]', '', get_option('customer_footer_js'), array('rows'=>12, 'data-entities-encode'=>'true', 'class'=>'form-control code-editor')); ?>
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><?php echo _l('headerfooter_customer_css'); ?></h3>
          </div>
          <div class="panel-body">
            <p class="text-muted"><?php echo _l('headerfooter_customer_css_help'); ?></p>
            <?php echo render_textarea('settings[customer_css]', '', get_option('customer_css'), array('rows'=>12, 'data-entities-encode'=>'true', 'class'=>'form-control code-editor')); ?>
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><?php echo _l('headerfooter_customer_html_header'); ?></h3>
          </div>
          <div class="panel-body">
            <p class="text-muted"><?php echo _l('headerfooter_customer_html_help'); ?></p>
            <?php echo render_textarea('settings[customer_html_header]', '', get_option('customer_html_header'), array('rows'=>10, 'data-entities-encode'=>'true', 'class'=>'form-control')); ?>
          </div>
        </div>
      </div>

      <!-- Section Historique : Visualisation des 20 dernières actions effectuées -->
      <div role="tabpanel" class="tab-pane" id="history_section">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><?php echo _l('headerfooter_change_history'); ?></h3>
          </div>
          <div class="panel-body">
            <p class="text-muted"><?php echo _l('headerfooter_history_help'); ?></p>
            <div id="history_container">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th><?php echo _l('date'); ?></th>
                    <th><?php echo _l('headerfooter_action_type'); ?></th>
                    <th><?php echo _l('headerfooter_user'); ?></th>
                  </tr>
                </thead>
                <tbody id="history_tbody">
                  <!-- Contenu chargé dynamiquement via AJAX (fonction load_history) -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- Section Import/Export : Sauvegarde et restauration de la configuration via JSON -->
      <div role="tabpanel" class="tab-pane" id="import_export">
        <div class="row">
          <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-download"></i> <?php echo _l('headerfooter_export'); ?></h3>
              </div>
              <div class="panel-body">
                <p><?php echo _l('headerfooter_export_help'); ?></p>
                <button type="button" class="btn btn-primary" id="export_config">
                  <i class="fa fa-download"></i> <?php echo _l('headerfooter_export_button'); ?>
                </button>
              </div>
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-upload"></i> <?php echo _l('headerfooter_import'); ?></h3>
              </div>
              <div class="panel-body">
                <p><?php echo _l('headerfooter_import_help'); ?></p>
                <form id="import_form" enctype="multipart/form-data">
                  <div class="form-group">
                    <input type="file" id="import_file" name="import_file" accept=".json" class="form-control" required>
                  </div>
                  <button type="button" class="btn btn-success" id="import_config">
                    <i class="fa fa-upload"></i> <?php echo _l('headerfooter_import_button'); ?>
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  jQuery(document).ready(function() {
    // Chargement initial de l'historique au chargement de la page
    load_history();

    // Gestion du clic sur le bouton d'exportation : redirige vers le contrôleur PHP
    jQuery('#export_config').on('click', function() {
      window.location.href = admin_url + 'headerfooter/export_config';
    });

    // Gestion de l'importation : envoi du fichier JSON au serveur via AJAX
    jQuery('#import_config').on('click', function() {
      var file = jQuery('#import_file')[0].files[0];
      if (!file) {
        alert('<?php echo _l("headerfooter_select_file"); ?>');
        return;
      }

      // Préparation des données du formulaire pour l'envoi de fichier
      var formData = new FormData();
      formData.append('config_file', file);

      jQuery.ajax({
        url: admin_url + 'headerfooter/import_config',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
          try {
            var result = JSON.parse(response);
            if (result.success) {
              // Si succès, on affiche le message et on recharge la page pour voir les nouveaux réglages
              alert(result.message);
              location.reload();
            } else {
              alert('Error: ' + result.message);
            }
          } catch (e) {
            alert('Erreur lors du traitement de l\'importation');
          }
        },
        error: function() {
          alert('<?php echo _l("headerfooter_import_error"); ?>');
        }
      });
    });
  });

  /**
   * Récupère l'historique des modifications via une requête GET AJAX et met à jour le tableau HTML.
   */
  function load_history() {
    jQuery.get(admin_url + 'headerfooter/get_history', function(data) {
      try {
        var history = JSON.parse(data);
        var tbody = jQuery('#history_tbody');
        tbody.empty();

        if (history.length === 0) {
          // Message si l'historique est vide
          tbody.html('<tr><td colspan="3" class="text-center"><?php echo _l("headerfooter_no_history"); ?></td></tr>');
        } else {
          // On boucle sur l'historique (inversé pour voir le plus récent en premier)
          jQuery.each(history.reverse(), function(i, entry) {
            var row = '<tr>';
            row += '<td>' + entry.timestamp + '</td>';
            row += '<td><span class="label label-info">' + entry.type.toUpperCase() + '</span></td>';
            row += '<td>' + (entry.user_id ? entry.user_id : '-') + '</td>';
            row += '</tr>';
            tbody.append(row);
          });
        }
      } catch (e) {
        console.error('Erreur lors du chargement de l\'historique :', e);
      }
    });
  }
</script>

<style type="text/css">
  /* Styles spécifiques pour l'affichage de l'éditeur de code et des panneaux */
  .code-editor {
    font-family: 'Monaco', 'Menlo', 'Consolas', monospace;
    font-size: 12px;
    line-height: 1.5;
  }
  
  .panel-heading {
    background-color: #f5f5f5;
  }
  
  .text-muted {
    font-size: 12px;
  }
</style>
