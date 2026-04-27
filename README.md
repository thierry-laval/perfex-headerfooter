# ![left 100%](https://raw.githubusercontent.com/thierry-laval/archives/master/images/logo-portfolio.png)

## Auteur

👤 &nbsp; **Thierry LAVAL** [🇫🇷 Contactez moi 🇬🇧](<contact@thierrylaval.dev>)

* Github: [@Thierry Laval](https://github.com/thierry-laval)
* LinkedIn: [@Thierry Laval](https://www.linkedin.com/in/thierry-laval)
* Visitez ==> 🏠 [Site Web](https://thierrylaval.dev)

***

### 📎 Projet - Module Perfex Header & Footer (v1.5)

![left 100%](https://raw.githubusercontent.com/thierry-laval/archives/master/images/perfex-module-preview.png?raw=true)

_`Début du projet le 12/04/2026`_

***

Ce module pour Perfex CRM est un outil puissant permettant d'injecter du code JavaScript, CSS et HTML personnalisé dans les sections critiques de votre CRM (Admin et Espace Client). Il facilite l'intégration d'outils tiers (Analytics, Pixels, Chat) et la personnalisation visuelle sans modifier les fichiers cœurs du système.

### Fonctionnalités principales

* Injection de code dans le **Header** et le **Footer**, avec gestion distincte pour l’interface Admin et l’Espace Client  
* Prise en charge de scripts **JavaScript**, styles **CSS** et contenus **HTML** personnalisés  
* Contrôle de validité en temps réel pour JS, CSS et HTML  
* Système d’**import/export** des configurations au format JSON  
* Journal des modifications avec conservation des 20 dernières versions  
* Paramétrage indépendant selon le contexte (Admin vs Client)  
* Interface optimisée avec navigation par onglets et aides intégrées  
* Mécanismes de sécurité appliqués au HTML pour limiter les injections à risque  

***

#### 🔧 Installation

1. Téléchargez le dossier dans le répertoire `/modules/perfex_headerfooter/` de votre installation.
2. Allez dans **Paramètres de la colonne de gauche → Modules** dans votre interface Perfex.
3. Activez le module **"Perfex Header & Footer"**.
4. Rendez-vous dans **Paramètres en haut à droite → Other → Code personnalisé**.

***

### 🚀 Mise en route

#### Interface Admin

* Intégration de scripts JS, styles CSS ou balises HTML pour des besoins internes  
* Application immédiate après enregistrement  

#### Espace Client

* Paramétrage équivalent mais isolé de l’Admin  
* Adapté à la personnalisation visuelle et à l’intégration d’outils de suivi  

### 💡 Cas d’usage

**Ajout de Google Analytics (Admin Head JS) :**

``` javascript
window.dataLayer = window.dataLayer || [];
gtag('config', 'GA_MEASUREMENT_ID');
```

**Personnalisation du Branding (Admin CSS) :**

``` css
.navbar-header {
    background: #667eea !important;
    color: white !important;
}
```

***

#### 🛡️ Note sur la sécurité

* Tout le code est validé avant d'être enregistré en base de données.
* La validation HTML empêche l'injection de balises `<script>` dans les champs HTML pour plus de sécurité.
* Les avertissements de syntaxe sont consignés dans le journal d'activité.

***

#### 📦  &nbsp; Utilisé dans ce projet

| Langages        | et Applications    |
| :-------------: |:--------------:    |
| PHP (CodeIgniter) | Visual Studio Code |
| HTML5 / CSS3    | Git / GitHub       |
| Javascript (jQuery) | Perfex CRM |

### 📝 Documentation & Aide

* Consultez **FEATURES.md** pour le guide complet.
* Consultez **EXAMPLES.php** pour des exemples de code.
* Consultez l'historique dans les réglages du module pour le suivi des changements.

<!-- Licence -->

***

## 📝  License

* Consultez **FEATURES.md** pour le guide complet.
* Consultez **EXAMPLES.php** pour des exemples de code.

Ce projet est sous licence [MIT](LICENCE).

[Voir mon travail](https://github.com/thierry-laval)

[Créer un bon template](https://github.com/thierry-laval/P22-template-pour-un-readme)

***

### &hearts;&nbsp;&nbsp;&nbsp;&nbsp;Love Markdown

Donnez une ⭐️ &nbsp; si ce projet vous a plu !

<span style="font-family:Papyrus; font-size:4em;">FAN DE GITHUB !</span>

<!--[This is an image](https://myoctocat.com/)-->

<img src="EMPLACEMENT DE L IMAGE.png" height="300" />

**[⬆ Retour en haut](#auteur)**
