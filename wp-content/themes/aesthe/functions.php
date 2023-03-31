<?php

/*
TO DO
Hide WP version strings from scripts and styles
Hide WP version strings from generator meta tag 
*/
flush_rewrite_rules( true );

function my_theme_setup(){
  add_theme_support('post-thumbnails');
  add_post_type_support('post', 'excerpt');
  add_post_type_support('page', 'excerpt');
  }
  add_action('after_setup_theme', 'my_theme_setup');
  
function remove_wpauto() {
  remove_filter('the_excerpt', 'wpautop');
  remove_filter('the_content', 'wpautop');
  remove_filter('the_sub_field', 'wpautop');
  }
  add_action('init', 'remove_wpauto');

function add_categories_to_pages() {
  register_taxonomy_for_object_type( 'category', 'page' );
  }
  add_action('init', 'add_categories_to_pages' );

  // remove editor and excerpt in template pages
  function remove_editor() {
    if (isset($_GET['post'])) {
        $id = $_GET['post'];
        $template = get_post_meta($id, '_wp_page_template', true);
        switch ($template) {
            case 'page-presse.php':
            case 'page-conseils.php':
            case 'page-blog.php':

            remove_post_type_support('page', 'editor');
            remove_post_type_support('page', 'excerpt');

            break;
            default :
            // Don't remove any other template.
            break;
        }
    }
}
add_action('init', 'remove_editor');
  
add_theme_support('post-thumbnails');
add_theme_support('align-wide');
add_theme_support('menus');
remove_action('wp_head', 'wp_print_scripts');
remove_action('wp_head', 'wp_print_head_scripts', 9);
remove_action('wp_head', 'wp_enqueue_scripts', 1);
add_action('wp_footer', 'wp_print_scripts', 5);
add_action('wp_footer', 'wp_enqueue_scripts', 5);
add_action('wp_footer', 'wp_print_head_scripts', 5);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
remove_action('wp_head', 'wp_oembed_add_host_js');
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds — <link rel="alternate"...
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link — <link rel="EditURI"...
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file. — <link rel="wlwmanifest...
remove_action('wp_head', 'index_rel_link'); // index link — ???
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post. — meta name="generator
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version — meta name="generator
remove_action('wp_head', 'print_emoji_detection_script', 7); // remove emojis
remove_action('wp_print_styles', 'print_emoji_styles'); // remove emojis

/**************
 **************
 * CONCERN :
 * POST TYPE
 **************
 **************
 */

// Delete default Post Types WP "commentaires"
add_action('admin_menu', 'remove_links_tab_menu_pages');
function remove_links_tab_menu_pages()
{
  remove_menu_page('edit-comments.php');
}

// Delete default Post Types supports
add_action('init', 'remove_supports_prestations');
function remove_supports_prestations()
{
  remove_post_type_support('prestations', 'editor');
  remove_post_type_support('prestations', 'excerpt');
}

// Create new posttype
add_action('init', 'create_post_type');

function create_post_type()
{
  register_post_type(
    'centres',
    array(
      'labels' => array(
        'name' => __('Centres'),
        'singular_name' => __('Centre') 
      ),
      'public' => true,
      'supports' => array('title'),
      'show_in_rest' => false,
      'has_archive' => false,
      'rewrite' => array('slug' => 'centres', 'with_front' => true),
      'menu_icon' => 'dashicons-admin-multisite',
    )
  );

  register_post_type(
    'presse',
    array(
      'labels' => array(
        'name' => __('Presse'),
      ),
      'public' => true,
      'supports' => array('title', 'thumbnail'),
      'show_in_rest' => false,
      'has_archive' => false,
      'rewrite' => array('slug' => 'presse', 'with_front' => true),
      'menu_icon' => 'dashicons-testimonial',
    )
  );

  register_post_type(
    'tarifs',
    array(
      'labels' => array(
        'name' => __('Tarifs'),
        'singular_name' => __('Tarif')
      ),
      'public' => true,
      // 'supports' => array('title', 'thumbnail', 'excerpt', 'editor'),
      'show_in_rest' => false,
      'has_archive' => false,
      'rewrite' => array('slug' => 'tarifs', 'with_front' => true),
      'menu_icon' => 'dashicons-money-alt',
    )
  );

  register_post_type(
    'conseils',
    array(
      'labels' => array(
        'name' => __('Conseils'),
        'singular_name' => __('Conseil')
      ),
      'public' => true,
      'supports' => array('title', 'thumbnail', 'excerpt', 'editor'),
      'show_in_rest' => true,
      'has_archive' => false,
      'rewrite' => array('slug' => 'medecine-esthetique-visage/conseils-visage', 'with_front' => true),
      'menu_icon' => 'dashicons-admin-comments',
      'taxonomies' => array( 'category' )
    )
  );

  register_post_type(
    'prestas',
    array(
      'labels' => array(
        'name' => __('Prestations'),
        'singular_name' => __('Prestation')
      ),
      'public' => true,
      // 'supports' => array('title', 'thumbnail', 'excerpt', 'editor'),
      'show_in_rest' => true,
      'has_archive' => false,
      'rewrite' => array('slug' => 'prestation', 'with_front' => true),
      'menu_icon' => 'dashicons-format-aside',
      'taxonomies'  => array('category'),
    ),
  );

  register_post_type(
    'soins',
    array(
      'labels' => array(
        'name' => __('Soins'),
        'singular_name' => __('Soin')
      ),
      'public' => true,
      'supports' => array('title', 'thumbnail', 'excerpt', 'editor'),
      'show_in_rest' => true,
      'has_archive' => false,
      // 'rewrite' => array('slug' => 'soins', 'with_front' => true),
      'menu_icon' => 'dashicons-image-filter',
      'taxonomies'  => array('category'),
    )
  );

  register_post_type(
    'tech-meds',
    array(
      'labels' => array(
        'name' => __('Techniques médicales'),
        'singular_name' => __('Technique médicale')
      ),
      'public' => true,
      'supports' => array('title', 'thumbnail', 'excerpt', 'editor'),
      'show_in_rest' => true,
      'has_archive' => false,
      'rewrite' => array('slug' => 'techniques-medicales', 'with_front' => true),
      'menu_icon' => 'dashicons-image-filter',
      'taxonomies'  => array('category', 'post_tag'),
    )
  );


  register_post_type(
    'tarifs',
    array(
      'labels' => array(
        'name' => __('Tarifs'),
        'singular_name' => __('Tarifs')
      ),
      'public' => true,
      // 'supports' => array('title', 'thumbnail', 'excerpt', 'editor'),
      'show_in_rest' => false,
      'has_archive' => false,
      'rewrite' => array('slug' => 'tarifs', 'with_front' => true),
      'menu_icon' => 'dashicons-money-alt',
    )
  );
}
// * END CONCERN : POST TYPE

/**************
 **************
 * PLUGIN :
 * ACF
 **************
 **************
 */

// 1. customize ACF path
add_filter('acf/settings/path', 'my_acf_settings_path');
function my_acf_settings_path($path)
{
  $path = get_stylesheet_directory() . '/_includes/acf-pro/';
  return $path;
}

// 2. customize ACF dir
add_filter('acf/settings/dir', 'my_acf_settings_dir');
function my_acf_settings_dir($dir)
{
  $dir = get_stylesheet_directory_uri() . '/_includes/acf-pro/';
  return $dir;
}

// 4. Include ACF
include_once(get_stylesheet_directory() . '/_includes/acf-pro/acf.php');

// modifie path json acf
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point($path)
{
  $path = get_stylesheet_directory() . '/_includes/acf-json';
  return $path;
}

add_filter('acf/settings/load_json', 'my_acf_json_load_point');
function my_acf_json_load_point($paths)
{
  unset($paths[0]);
  $paths[] = get_stylesheet_directory() . '/_includes/acf-json';
  return $paths;
}

// AJOUTER UN NOUVEAU ACF
function register_acf_blocks()
{
  // block Top Offre
  acf_register_block(array(
    'name'              => 'Top Offre',
    'title'             => __('Top Offre'),
    'render_template'   => '/template-parts/block/top-offre.php',
    'icon' => 'dashicons-ellipsis',
    'keywords'          => array('Top Offre'),
    'mode'              => 'auto',
    'category'          => 'formatting',
  ));

  // block Avant apres
  acf_register_block(array(
    'name'              => 'Avant apres',
    'title'             => __('Avant apres'),
    'render_template'   => '/template-parts/block/before-after.php',
    'icon' => 'dashicons-ellipsis',
    'mode'              => 'auto',
    'category'          => 'formatting',
  ));
  
    // block Presentation
    acf_register_block(array(
      'name'              => 'Presentation',
      'title'             => __('Presentation'),
      'render_template'   => '/template-parts/block/presentation.php',
      'icon' => 'dashicons-ellipsis',
      'mode'              => 'auto',
      'category'          => 'formatting',
    ));

    // block FAQ
    acf_register_block(array(
      'name'              => 'FAQ',
      'title'             => __('FAQ'),
      'render_template'   => '/template-parts/block/faq.php',
      'icon' => 'dashicons-ellipsis',
      'mode'              => 'auto',
      'category'          => 'formatting',
    ));

    // block Onglets Questions
    acf_register_block(array(
      'name'              => 'Onglets Questions',
      'title'             => __('Onglets Questions'),
      'render_template'   => '/template-parts/block/questions-tabs.php',
      'icon' => 'dashicons-ellipsis',
      'mode'              => 'auto',
      'category'          => 'formatting',
    ));

    // block Mosaique
    acf_register_block(array(
      'name'              => 'Mosaique',
      'title'             => __('Mosaique'),
      'render_template'   => '/template-parts/block/mosaic.php',
      'icon' => 'dashicons-ellipsis',
      'mode'              => 'auto',
      'category'          => 'formatting',
    ));

    // block Slides de cartes
    acf_register_block(array(
    'name'              => 'slider-cards',
    'title'             => __('Slider de cartes'),
    'description'       => __('Slider de cartes'),
    'render_template'   => '/template-parts/block/slider-cards.php',
    'category'          => 'formatting',
    'icon'              => 'image-filter',
    'mode'              => 'auto',
    'keywords'          => array('tech', 'médical', 'cartes', 'card', 'slide'),
    ));

    // block centre
    acf_register_block(array(
      'name'              => 'centre',
      'title'             => __('Centre'),
      'description'       => __('centre'),
      'render_template'   => '/template-parts/block/center.php',
      'category'          => 'formatting',
      'icon'              => 'admin-home',
      'mode'              => 'auto',
      'keywords'          => array('centre', 'shop', 'retail'),
    ));

    // block des sources
    acf_register_block(array(
      'name'              => 'Sources',
      'title'             => __('Sources'),
      'render_template'   => '/template-parts/block/sources.php',
      'icon'              => 'dashicons-media-default',
      'keywords'          => array('sources'),
      'mode'              => 'auto',
      'category'          => 'formatting',
    ));

    // block siblings
    acf_register_block(array(
      'name'              => 'Siblings',
      'title'             => __('Siblings'),
      'render_template'   => '/template-parts/block/siblings.php',
      'icon'              => 'dashicons-media-default',
      'keywords'          => array('Siblings'),
      'mode'              => 'auto',
      'category'          => 'formatting',
    ));

     // block gutenberg : Image, title & text
    acf_register_block(array(
      'name'              => 'Bloc gutenberg',
      'title'             => __('Bloc gutenberg'),
      'render_template'   => '/template-parts/block/guntenberg.php',
      'icon'              => 'dashicons-media-default',
      'keywords'          => array('Bloc gutenberg'),
      'mode'              => 'auto',
      'category'          => 'formatting',
    ));

     // block cards tarifs
    acf_register_block(array(
      'name'              => 'Cartes tarifs',
      'title'             => __('Cartes tarifs'),
      'render_template'   => '/template-parts/block/tarifs-cards.php',
      'icon'              => 'dashicons-money-alt',
      'keywords'          => array('Cartes tarifs', 'tarfisCards'),
      'mode'              => 'auto',
      'category'          => 'formatting',
    ));

     // block top SEO
     acf_register_block(array(
      'name'              => 'Top SEO',
      'title'             => __('Top SEO'),
      'render_template'   => '/template-parts/block/top-seo.php',
      'icon'              => 'dashicons-money-alt',
      'keywords'          => array('Top SEO', 'TopSEO'),
      'mode'              => 'auto',
      'category'          => 'formatting',
    ));

    // block sub menu
    acf_register_block(array(
      'name'              => 'submenu',
      'title'             => __('Sous menu'),
      'description'       => __('Sous menu'),
      'render_template'   => '/template-parts/block/submenu.php',
      'category'          => 'formatting',
      'icon'              => 'list-view',
      'mode'              => 'auto',
      'keywords'          => array('submenu', 'menu'),
    ));

    // block top Home
    acf_register_block(array(
      'name'              => 'Top Accueil',
      'title'             => __('Top Accueil'),
      'description'       => __('Top Accueil'),
      'render_template'   => '/template-parts/block/top-home.php',
      'category'          => 'formatting',
      'icon'              => 'list-view',
      'mode'              => 'auto',
      'keywords'          => array('tophome'),
    ));

    // bloc button
    acf_register_block(array(
      'name'              => 'Bouton',
      'title'             => __('Bouton Aesthe'),
      'description'       => __('Bouton'),
      'render_template'   => '/template-parts/block/bouton.php',
      'category'          => 'formatting',
      'icon'              => 'list-view',
      'mode'              => 'auto',
      'keywords'          => array('bouton'),
    ));

    // block univers scrolling
    acf_register_block(array(
      'name'              => 'Univers scrolling',
      'title'             => __('Univers scrolling'),
      'description'       => __('Univers scrolling'),
      'render_template'   => '/template-parts/block/univers-scrolling.php',
      'category'          => 'formatting',
      'icon'              => 'list-view',
      'mode'              => 'auto',
      'keywords'          => array('univers-scrolling'),
    ));

    
    // block univers horizontal scroll
    acf_register_block(array(
      'name'              => 'Univers horizontal scroll',
      'title'             => __('Univers horizontal scroll'),
      'description'       => __('Univers horizontal scroll'),
      'render_template'   => '/template-parts/block/univers-horizontal-scroll.php',
      'category'          => 'formatting',
      'icon'              => 'list-view',
      'mode'              => 'auto',
      'keywords'          => array('univers-horizontal-scroll'),
    ));

    // block univers image parallax
    acf_register_block(array(
      'name'              => 'Univers image parallax',
      'title'             => __('Univers image parallax'),
      'description'       => __('Univers image parallax'),
      'render_template'   => '/template-parts/block/univers-image-parallax.php',
      'category'          => 'formatting',
      'icon'              => 'list-view',
      'mode'              => 'auto',
      'keywords'          => array('univers-image-parallax'),
    ));

    // block Cartes presentation accueil
    acf_register_block(array(
      'name'              => 'Cartes presentation accueil',
      'title'             => __('Cartes presentation'),
      'description'       => __('Cartes presentation'),
      'render_template'   => '/template-parts/block/presentation-cards.php',
      'category'          => 'formatting',
      'icon'              => 'list-view',
      'mode'              => 'auto',
    ));

    // block Badges de confiance
    acf_register_block(array(
      'name'              => 'Badges de confiance',
      'title'             => __('Badges de confiance'),
      'description'       => __('Badges de confiance'),
      'render_template'   => '/template-parts/block/trust-badges.php',
      'category'          => 'formatting',
      'icon'              => 'list-view',
      'mode'              => 'auto',
    ));

    // block Articles Summary
    acf_register_block(array(
      'name'              => 'Sommaire',
      'title'             => __('Sommaire'),
      'description'       => __('Sommaire'),
      'render_template'   => '/template-parts/block/article-summary.php',
      'category'          => 'formatting',
      'icon'              => 'list-view',
      'mode'              => 'auto',
    ));
    
}

// AJOUTER UNE PAGE D'OPTION
if( function_exists('acf_add_options_page') ) {
    
  acf_add_options_page(array(
    'page_title'  => 'Options du thème',
    'menu_title'  => 'Options du thème',
    'menu_slug'   => 'theme-general-settings',
    'capability'  => 'edit_posts',
    'redirect'    => false
  ));

  acf_add_options_sub_page(array(
    'page_title'  => 'Footer',
    'menu_title'  => 'Footer',
    'parent_slug' => 'theme-general-settings',
  ));

  acf_add_options_sub_page(array(
    'page_title'  => 'Header',
    'menu_title'  => 'Header',
    'parent_slug' => 'theme-general-settings',
  ));
  
}

// Check if function exists and hook into setup.
if (function_exists('acf_register_block')) {
  add_action('acf/init', 'register_acf_blocks');
}
// * END PLUGIN : ACF

/**************
 **************
 * PLUGIN :
 * SITE REVIEWS
 **************
 **************
 */

/**
 * This removes the nonce check for logged-in users when submitting a review.
 * Nonces can be problematic when your pages are cached, and for this reason it's commonly suggested to * not cache pages for logged in users.
 * However, if caching is required on your site for logged in users, then this snippet will remove the * Nonce check when a user submits a review.
 * @see http://developer.wordpress.org/plugins/security/nonces/
 */
add_filter('site-reviews/router/admin/unguarded-actions', function ($actions) {
  $actions[] = 'submit-review';
  return $actions;
});

/**
 * Hides the review form after a review has been submitted
 * Paste this in your active theme's functions.php file
 *
 * @param string $script
 * @return string
 */
add_filter('site-reviews/enqueue/public/inline-script/after', function ($javascript) {
  return $javascript . "
    GLSR.Event.on('site-reviews/form/handle', function (response, formEl) {
        if (false !== response.errors) return;
        formEl.classList.add('glsr-hide-form');
        formEl.insertAdjacentHTML('afterend', '<p>' + response.message + '</p>');
    });";
});

/**
 * Enables the Custom Fields metabox to display the values of the submitted custom fields
 * Paste this in your active theme's functions.php file.
 * @return void
 */
add_action('admin_init', function () {
  add_post_type_support('site-review', 'custom-fields');
});

/**
 * For google indexing /!\
 * Modifies the properties of the schema created by Site Reviews.
 * Change "LocalBusiness" to the schema type you wish to change (i.e. Product)
 * Paste this in your active theme's functions.php file.
 * @param array $schema
 * @return array
 */
add_filter('site-reviews/schema/Product', function ($schema) {
  // modify the $schema array here.
  if (
    $schema['@id'] == "https://aesthe.com/techniques-medicales/acide-hyaluronique/#product" ||
    $schema['@id'] == "https://aesthe.com/techniques-medicales/skinbooster/#product" ||
    $schema['@id'] == "https://aesthe.com/techniques-medicales/profhilo/#product" ||
    $schema['@id'] == "https://aesthe.com/techniques-medicales/radiesse/#product"
  ) {
    $schema['offers'] = [
      '@type' => "AggregateOffer",
      'lowPrice' => "350",
      'highPrice' => "450",
      'priceCurrency' => "EUR",
    ];
  } else if ($schema['@id'] == "https://aesthe.com/techniques-medicales/fils-tenseurs/#product") {
    $schema['offers'] = [
      '@type' => "AggregateOffer",
      'lowPrice' => "1000",
      'highPrice' => "1800",
      'priceCurrency' => "EUR",
    ];
  } else if ($schema['@id'] == "https://aesthe.com/techniques-medicales/mesotherapie/#product") {
    $schema['offers'] = [
      '@type' => "AggregateOffer",
      'lowPrice' => "150",
      'highPrice' => "180",
      'priceCurrency' => "EUR",
    ];
  } else if (
    $schema['@id'] == "https://aesthe.com/techniques-medicales/laser-fractionne/#product" ||
    $schema['@id'] == "https://aesthe.com/techniques-medicales/laser-pigmentaire/#product" ||
    $schema['@id'] == "https://aesthe.com/techniques-medicales/laser-pigmentaire/#product" ||
    $schema['@id'] == "https://aesthe.com/techniques-medicales/laser-vasculaire/#product" ||
    $schema['@id'] == "https://aesthe.com/techniques-medicales/rejuvenation-laser/#product" ||
    $schema['@id'] == "https://aesthe.com/techniques-medicales/le-laser-clearsilk/#product" ||
    $schema['@id'] == "https://aesthe.com/techniques-medicales/ipl/#product"
  ) {
    $schema['offers'] = [
      '@type' => "AggregateOffer",
      'lowPrice' => "240",
      'highPrice' => "600",
      'priceCurrency' => "EUR",
    ];
  } else if ($schema['@id'] == "https://aesthe.com/techniques-medicales/laser-forever-young-bbl/#product") {
    $schema['offers'] = [
      '@type' => "AggregateOffer",
      'lowPrice' => "200",
      'highPrice' => "560",
      'priceCurrency' => "EUR",
    ];
  } else if ($schema['@id'] == "https://aesthe.com/techniques-medicales/laser-halo/#product") {
    $schema['offers'] = [
      '@type' => "AggregateOffer",
      'lowPrice' => "500",
      'highPrice' => "900",
      'priceCurrency' => "EUR",
    ];
  } else if (
    $schema['@id'] == "https://aesthe.com/techniques-medicales/peeling/#product" ||
    $schema['@id'] == "https://aesthe.com/techniques-medicales/microneedling/#product" ||
    $schema['@id'] == "https://aesthe.com/techniques-medicales/pdt-phototherapie-dynamique/#product" ||
    $schema['@id'] == "https://aesthe.com/techniques-medicales/hydrafacial/#product" ||
    $schema['@id'] == "https://aesthe.com/offres/hydra-plus/#product" ||
    $schema['@id'] == "https://aesthe.com/offres/soin-reparateur/#product" ||
    $schema['@id'] == "https://aesthe.com/offres/glow-express/#product" ||
    $schema['@id'] == "https://aesthe.com/offres/glow-plus/#product" ||
    $schema['@id'] == "https://aesthe.com/offres/soin-keratoregulateur/#product" ||
    $schema['@id'] == "https://aesthe.com/offres/clear-plus/#product"
    ) {
    $schema['offers'] = [
      '@type' => "AggregateOffer",
      'lowPrice' => "120",
      'highPrice' => "250",
      'priceCurrency' => "EUR",
    ];
  } else {
    $schema['offers'] = [
      '@type' => "AggregateOffer",
      'lowPrice' => "0",
      'highPrice' => "1000",
      'priceCurrency' => "EUR",
    ];
  }
  return $schema;
});

// * END PLUGIN : REVIEWS SITE
function remove_h1_from_editor($settings)
{
  $settings['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;Preformatted=pre;';
  return $settings;
}

function my_login_logo_one()
{
  echo "<style type=\"text/css\">";
  echo "body.login div#login h1 a { background-image: url(" . get_template_directory_uri() . "/assets/img/pammngrmm.png);padding-bottom: 30px; }";
  echo "</style>";
}

add_action('login_enqueue_scripts', 'my_login_logo_one');


function add_mime_types($mimes)
{
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}

function hide_wp_update_nag()
{
  remove_action('admin_notices', 'update_nag', 3);
}

show_admin_bar(false); // masque admin bar

if (is_admin()) {

  // add_filter('the_content', 'filter_ptags_on_images'); // enleve <p> autour des images inserées avec wysiwyg

  add_action('admin_menu', 'hide_wp_update_nag'); // hide message update mise à jour wp
  add_filter('sanitize_file_name', 'remove_accents'); // SUPPRIME LES ACCENTS DES MEDIAS
  add_filter('upload_mimes', 'add_mime_types'); // AUTORISE SVG EN BACKOFFICE

  // Code utile uniquement dans l'administration
  add_filter('tiny_mce_before_init', 'remove_h1_from_editor');

  // Réglages permaliens
  if (get_option('medium_size_w') == 300) update_option('medium_size_w', '1000');
  if (get_option('medium_size_h') == 300) update_option('medium_size_h', '2500');
  if (get_option('large_size_w') == 1024) update_option('large_size_w', '2000');
  if (get_option('large_size_h') == 1024) update_option('large_size_h', '3500');
  if (get_option('uploads_use_yearmonth_folders') != '') update_option('uploads_use_yearmonth_folders', '');
} else {
  // Code utile uniquement dans le front-end
}

function getPageIDbySlug($the_slug)
{
  if (get_page_by_path($the_slug)) return get_page_by_path($the_slug)->ID;
}

// // remove les {id} automatique des blocs
// if(isMobile()){
remove_filter('render_block', 'wp_render_layout_support_flag', 10, 2);
remove_filter('render_block', 'gutenberg_render_layout_support_flag', 10, 2);
// }



/**
 * Adjust API endpoint availability to hide user info
 * masque author auteurs sur url headless
 */
function my_api_endpoint_setup($endpoints)
{
  if (isset($endpoints['/wp/v2/users'])) {
    unset($endpoints['/wp/v2/users']);
  }
  if (isset($endpoints['/wp/v2/users/(?P<id>[\d]+)'])) {
    unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);
  }
  return $endpoints;
}
add_filter('rest_endpoints', 'my_api_endpoint_setup');

function is_post_type($type)
{
  global $wp_query;
  if ($type == get_post_type($wp_query->post->ID))
    return true;
  return false;
}

// Remove Gutenberg Block Library CSS from loading on the frontend
function smartwp_remove_wp_block_library_css()
{
  wp_dequeue_style('wp-block-library');
  wp_dequeue_style('wp-block-library-theme');
  wp_dequeue_style('wc-block-style'); // Remove WooCommerce block CSS

  wp_enqueue_script('salvattore', get_template_directory_uri() . '/assets/js/yeah/salvattore.min.js', array(), '', true);
}
add_action('wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100);


//  Exemple Monnoyeur : disabling the Gutenberg editor according to POST id
add_filter('use_block_editor_for_post_type', 'prefix_disable_gutenberg', 10, 2);
function prefix_disable_gutenberg($current_status, $post_type)
{
  if ($post_type === 'soin') return false;
  return $current_status;
}

/**
 * Reusable Blocks accessible in backend
 * @link https://www.billerickson.net/reusable-blocks-accessible-in-wordpress-admin-area
 *
 */
function be_reusable_blocks_admin_menu()
{
  add_menu_page('Blocs réutilisables', 'Blocs Gutenberg', 'edit_posts', 'edit.php?post_type=wp_block', '', 'dashicons-editor-table', 22);
}
add_action('admin_menu', 'be_reusable_blocks_admin_menu');

// remove private before titles
add_filter('private_title_format', function ($format) {
  return '%s';
});

//add params to canonical (page avis)
// add_filter('wpseo_canonical', 'add_params_to_canonical');

// function add_params_to_canonical($canonical)
// {
//   if (is_page(1925) && 'avis' != basename($_SERVER['REQUEST_URI'])) {

//     return $canonical . basename($_SERVER['REQUEST_URI']);
//   }

//   return $canonical;
// }

/**************
 **************
 * PLUGIN :
 * POLYLANG
 **************
 **************
 */
add_action('init', function () {
  // pll_register_string('RestonsConnectes', 'RestonsConnectes', 'aesthe');
  // pll_register_string('ChapeauNewsletterInput', 'ChapeauNewsletterInput', 'aesthe');
  // pll_register_string('VoirAvis', 'VoirAvis', 'aesthe');

  // pll_register_string('ReviewsResumeNote', 'ReviewsResumeNote', 'site-reviews');
  // pll_register_string('ReviewsDonnezAvis', 'ReviewsDonnezAvis', 'site-reviews');
  // pll_register_string('ReviewsAvisVerifie', 'ReviewsAvisVerifie', 'site-reviews');
  // pll_register_string('ReviewsAvisVerifieTexte', 'ReviewsAvisVerifieTexte', 'site-reviews');
  // pll_register_string('ReviewsExplication', 'ReviewsExplication', 'site-reviews');
  // pll_register_string('ReviewsBirthdate', 'ReviewsBirthdate', 'site-reviews');
  // pll_register_string('ReviewsTechMeds', 'ReviewsTechMeds', 'site-reviews');
  // pll_register_string('ReviewsTest', 'ReviewsTest', 'site-reviews');
});

add_filter('pll_the_languages_args', function ($args) {
  $args['display_names_as'] = 'slug';
  return $args;
});

// Register Navigations
// add_action('init', 'my_custom_menus');
// function my_custom_menus()
// {
//   register_nav_menus(
//     array(
//       'mobile-h'=> __('Mobile header'),
//       'left-h' => __('Left header'),
//       'right-h' => __('Right header')
//     )
//   );
// }

// Microdonnée avec RANK MATH
add_filter('rank_math/json_ld', function ($data, $jsonld) {
  if (!have_rows('faq_champs')) {
    return $data;
  }
  $data['faqs'] = [
    '@type' => 'FAQPage',
  ];
  while (have_rows('faq_champs')) {
    the_row();
    $data['faqs']['mainEntity'][] = [
      '@type' => 'Question',
      'name' => esc_attr(get_sub_field('faq_question')),
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text' => esc_attr(get_sub_field('faq_reponse')),
      ],
    ];
  }
  return $data;
}, 10, 2);

// racourcit print_r
function pr($data)
{
  echo "<pre>";
  print_r($data);
  echo "</pre>";
}

function vd($data)
{
  var_dump($data);
}

add_theme_support('editor-color-palette', array(
  array(
    'name'  => __('Nude', 'aesthe'),
    'slug'  => 'aesthe-nude',
    'color' => '#FFF5ED',
  ),

  array(
    'name'  => __('Orange', 'aesthe'),
    'slug'  => 'aesthe-orange',
    'color' => '#FF8347',
  ),
  array(
    'name'  => __('Café', 'aesthe'),
    'slug'  => 'aesthe-coffee',
    'color' => '#9E8174',
  ),
  array(
    'name'  => __('Gris', 'aesthe'),
    'slug'  => 'aesthe-grey',
    'color' => '#707070',
  ),
  array(
    'name'  => __('Rouge', 'aesthe'),
    'slug'  => 'aesthe-red',
    'color' => '#C53E23',
  ),
  array(
    'name'  => __('Violet', 'aesthe'),
    'slug'  => 'aesthe-purple',
    'color' => '#5D23D0',
  )
));

/* CALCUL TEMPS ESTIME LECTURE ARTICLES */
function temps_lecture() {
  global $post;
  $content = get_post_field( 'post_content', $post->ID );
  $word_count = str_word_count( strip_tags( $content ) );
  $readingtime = ceil($word_count / 200);
  if ($readingtime == 1) {
    $timer = " minute de lecture";
  } else {
    $timer = " minutes de lecture";
  }
  $totalreadingtime = $readingtime . $timer;
  return $totalreadingtime;
}

add_theme_support('editor-color-palette', array(
  array(
    'name'  => __('Nude', 'aesthe'),
    'slug'  => 'aesthe-nude',
    'color' => '#E9CCB7',
  ),

  array(
    'name'  => __('Coffee', 'aesthe'),
    'slug'  => 'aesthe-coffee',
    'color' => '#9E8174',
  ),

  array(
    'name'  => __('Orange', 'aesthe'),
    'slug'  => 'aesthe-orange',
    'color' => '#FF8040',
  ),
  array(
    'name'  => __('Grey', 'aesthe'),
    'slug'  => 'aesthe-grey',
    'color' => '#707070',
  ),
  array(
    'name'  => __('Rouge', 'aesthe'),
    'slug'  => 'aesthe-coral',
    'color' => '#C53E23',
  ),
  array(
    'name'  => __('Violet', 'aesthe'),
    'slug'  => 'aesthe-purple',
    'color' => '#5D23D0',
  )
));

function add_blockquote_quicktag() {
  ?>
      <script type="text/javascript">
      QTags.addButton( 'my_blockquote', 'B', '[my_blockquote]', '[/my_blockquote]', 'B', 'My blockquote', 1 );
      </script>
  <?php
  }
  add_action( 'admin_print_footer_scripts', 'add_blockquote_quicktag' );