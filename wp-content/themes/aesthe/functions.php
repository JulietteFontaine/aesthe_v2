<?php

/*
TO DO
Hide WP version strings from scripts and styles
Hide WP version strings from generator meta tag 
*/

remove_filter('the_excerpt', 'wpautop');
remove_filter('the_content', 'wpautop');
remove_filter('the_sub_field', 'wpautop');
add_theme_support('align-wide');
add_theme_support('menus');
add_theme_support('post-thumbnails');
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

function my_admin_add_js()
{
  if (is_admin()) :
    // hans yeah!
    // aussi déterminable avec $screen = get_current_screen() puis screen->parent_file
    global $pagenow;
    if ($pagenow == "users.php") :
?>
      <script>
        var dom_target = document.getElementsByClassName("wp-header-end");
        var newElement = document.createElement('div');
        newElement.innerHTML = "Il est important de garder un mot de passe complexe, ce qui renforce la sécurité et baisse le risque de piratage.<br />Le changement de mot de passe par un plus simple dégage la responsabilité du studio en cas de piratage du site.<br />Tout frais de correction sera donc à la charge du client.";
        dom_target[0].parentNode.insertBefore(newElement, dom_target[0]);
      </script>
<?php
    endif;
  endif;
}

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
  add_action('admin_footer', 'my_admin_add_js');
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

// Ajout tailles médias pour éviter background img ou object-fit
// add_image_size( 'home-carousel', 1830, 645, true); // true = crop
// add_image_size( 'home-bloc-trois', 570, 375, true); // true = crop
// add_image_size( 'custom-size', 220, 220, array( 'left', 'top' ) );

// wp_insert_post(array('post_title' => $title_tmp, 'post_content' => $content_tmp, 'post_type' => 'formulaire', 'post_status' => 'publish'));

// $role->remove_cap('delete_published_pages');

// ACTIVER SESSIONS
/*
add_action('init', 'monprefixe_session_start', 1);
function monprefixe_session_start() {
  if(!session_id())  @session_start();
}
*/

// Delete default Post Types WP "articles"
add_action('init', 'hwk_deregister_builtin_post_type');
function hwk_deregister_builtin_post_type(){
    global $wp_post_types;
    
    $unregister = array(
        'post',
          );
    
    foreach($unregister as $post_type){
        if(!post_type_exists($post_type))
            continue;
        $post_type_object = get_post_type_object($post_type);
        $post_type_object->remove_supports();
        $post_type_object->remove_rewrite_rules();
        $post_type_object->unregister_meta_boxes();
        $post_type_object->remove_hooks();
        $post_type_object->unregister_taxonomies();
        unset($wp_post_types[$post_type]);
        do_action('unregistered_post_type', $post_type);
        
        $wp_post_types[$post_type] = new stdClass();
        $wp_post_types[$post_type]->show_in_menu = false;
        $wp_post_types[$post_type]->publicly_queryable = false;
        $wp_post_types[$post_type]->_builtin = false;
        $wp_post_types[$post_type]->name = false;
    
    }
}

add_action('init', 'create_post_type');
function create_post_type()
{
  register_post_type(
    'centre',
    array(
      'labels' => array(
        'name' => __('Centres'),
      ),
      'public' => true,
      'supports' => array('title'),
      'show_in_rest' => false,
      'has_archive' => false,
      'rewrite' => array('slug' => 'centre', 'with_front' => true),
      'menu_icon' => 'dashicons-admin-multisite',
    )
  );

  register_post_type(
    'presse',
    array(
      'labels' => array(
        'name' => __('Presse'),
        'singular_name' => __('Presse')
      ),
      'public' => true,
      'supports' => array('title', 'thumbnail', 'excerpt', 'editor'),
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

  register_post_type(
    'conseils',
    array(
      'labels' => array(
        'name' => __('Conseils'),
        'singular_name' => __('Conseils')
      ),
      'public' => true,
      'supports' => array('title', 'thumbnail', 'excerpt', 'editor'),
      'show_in_rest' => true,
      'has_archive' => false,
      'rewrite' => array('slug' => 'medecine-esthetique-visage/conseils-visage', 'with_front' => true),
      'menu_icon' => 'dashicons-admin-post',
    )
  );

  register_post_type(
    'offre',
    array(
      'labels' => array(
        'name' => __('Offres'),
        'singular_name' => __('Offre')
      ),
      'public' => true,
      'supports' => array('title', 'thumbnail', 'excerpt', 'editor'),
      'show_in_rest' => true,
      'has_archive' => false,
      'rewrite' => array('slug' => 'offres', 'with_front' => true),
      'menu_icon' => 'dashicons-store',
      'taxonomies'  => array('post_tag', 'category'),
    ),
  );

  register_post_type(
    'soin',
    array(
      'labels' => array(
        'name' => __('Soins'),
        'singular_name' => __('Soin')
      ),
      'public' => true,
      'supports' => array('title', 'editor'),
      'show_in_rest' => true,
      'has_archive' => false,
      'rewrite' => array('slug' => 'soins', 'with_front' => true),
      'menu_icon' => 'dashicons-list-view',
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
}

// with_front  à false n'utilise pas le “Structure personnalisée” des Permaliens
// cf https://www.quemalabs.com/blog/how-to-add-blog-in-front-of-your-url/
// cf http://www.ecap-partner.com/


// Ajout de tailles d'images
add_image_size('blogThumb', 820, 570, true);
add_image_size('card', 600, 360, true);
add_image_size('cardMini', 410, 220, true);

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

}

// Check if function exists and hook into setup.
if (function_exists('acf_register_block')) {
  add_action('acf/init', 'register_acf_blocks');
}

// * END PLUGIN : ACF

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
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length($length)
{
  return 20;
}
add_filter('excerpt_length', 'wpdocs_custom_excerpt_length', 999);

// add_theme_support('editor-color-palette', array(
//   array(
//     'name'  => __('Nude', 'aesthe'),
//     'slug'  => 'aesthe-nude',
//     'color' => '#FFF5ED',
//   ),

//   array(
//     'name'  => __('Orange', 'aesthe'),
//     'slug'  => 'aesthe-orange',
//     'color' => '#FF8347',
//   ),
//   array(
//     'name'  => __('Bleu', 'aesthe'),
//     'slug'  => 'aesthe-blue',
//     'color' => '#061CA6',
//   ),
//   array(
//     'name'  => __('Bleu clair', 'aesthe'),
//     'slug'  => 'aesthe-blueLight',
//     'color' => '#B7E2FF',
//   ),
//   array(
//     'name'  => __('Rouge', 'aesthe'),
//     'slug'  => 'aesthe-coral',
//     'color' => '#FF4750',
//   ),
//   array(
//     'name'  => __('Jaune', 'aesthe'),
//     'slug'  => 'aesthe-yellow',
//     'color' => '#FFE140',
//   ),
//   array(
//     'name'  => __('Violet', 'aesthe'),
//     'slug'  => 'aesthe-purple',
//     'color' => '#5D23D0',
//   )
// ));

// add hook to retrieve submenu siblings
// add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects_sub_menu', 10, 2);

// filter_hook function to react on sub_menu flag
// function my_wp_nav_menu_objects_sub_menu($sorted_menu_items, $args)
// {
//   if (isset($args->sub_menu)) {
//     $root_id = 0;

//     // find the current menu item
//     foreach ($sorted_menu_items as $menu_item) {
//       if ($menu_item->current) {
//         // set the root id based on whether the current menu item has a parent or not
//         $root_id = ($menu_item->menu_item_parent) ? $menu_item->menu_item_parent : $menu_item->ID;
//         break;
//       }
//     }

//     // find the top level parent
//     if (!isset($args->direct_parent)) {
//       $prev_root_id = $root_id;
//       while ($prev_root_id != 0) {
//         foreach ($sorted_menu_items as $menu_item) {
//           if ($menu_item->ID == $prev_root_id) {
//             $prev_root_id = $menu_item->menu_item_parent;
//             // don't set the root_id to 0 if we've reached the top of the menu
//             if ($prev_root_id != 0) $root_id = $menu_item->menu_item_parent;
//             break;
//           }
//         }
//       }
//     }

//     $menu_item_parents = array();
//     foreach ($sorted_menu_items as $key => $item) {
//       // init menu_item_parents
//       if ($item->ID == $root_id) $menu_item_parents[] = $item->ID;

//       if (in_array($item->menu_item_parent, $menu_item_parents)) {
//         // part of sub-tree: keep!
//         $menu_item_parents[] = $item->ID;
//       } else if (!(isset($args->show_parent) && in_array($item->ID, $menu_item_parents))) {
//         // not part of sub-tree: away with it!
//         unset($sorted_menu_items[$key]);
//       }
//     }

//     return $sorted_menu_items;
//   } else {
//     return $sorted_menu_items;
//   }
// }

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

//Register Navigations
add_action('init', 'my_custom_menus');
function my_custom_menus()
{
  register_nav_menus(
    array(
      'mobile-h'=> __('Mobile header'),
      'left-h' => __('Left header'),
      'right-h' => __('Right header')
    )
  );
}

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
