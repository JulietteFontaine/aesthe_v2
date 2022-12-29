<?php $local = strpos($_SERVER['DOCUMENT_ROOT'], "C:/web/") !== false;
// $preprod = strpos($_SERVER['DOCUMENT_ROOT'], "make.thisispam") !== false;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <?php
    $titre = wp_title('', false);
    $titre = trim($titre);
    if (get_field('meta_title', get_the_ID())) $titre = get_field('meta_title');
    ?>

    <?php
    $iPhone = stripos($_SERVER['HTTP_USER_AGENT'], "iPhone");
    $our_website = get_the_permalink();
    if ($iPhone > -1 && !isset($_COOKIE['trust_pabau'])) {
        setcookie("trust_pabau", "1");
        header('Location: https://connect.pabau.com/safari_approve.php?ref=' . urlencode($our_website));
    }
    ?>

    <title><?= $titre; ?></title>

    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0" />
    <meta name="facebook-domain-verification" content="yl47nsx11nhdeyzjau5tei2tjqsird" />

    <!-- Google Tag Manager -->
    <script>
        window.dataLayer = window.dataLayer || [];
    </script>
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-5V3M2D8');
    </script>
    <!-- End Google Tag Manager -->

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-207934763-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-207934763-1', {
            'anonymize_ip': true
        });
    </script>
    <!-- end Global site tag (gtag.js) - Google Analytics -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    </link>
    
    <link href="<?= get_template_directory_uri(); ?>/style.css" rel="stylesheet">
    <script src="<?= get_template_directory_uri(); ?>/assets/js/code-min.js"></script>

    <script>
        // ie css vars — https://github.com/nuxodin/ie11CustomProperties
        window.MSInputMethodContext && document.documentMode && document.write('<script src="https://cdn.jsdelivr.net/gh/nuxodin/ie11CustomProperties@4.1.0/ie11CustomProperties.min.js"><\/script>');
    </script>


    <?php wp_head(); ?>

</head>

<body <?php body_class('slug-' . basename(get_permalink())); ?> <?= ($local || $preprod) ? 'local' : '' ?>>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5V3M2D8" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <header class="siteHeader  wrapper">
        <div class="menu-full-header-container ">
            <?php wp_nav_menu(array('theme_location' => 'left-menu')) ?>
            <a class="logoWeb" href="<?php bloginfo('url'); ?>/" aria-label="aesthé, médecine esthétique"><?php include('assets/img/logoN.svg'); ?></a>
            <button class="burger"><span></span><span></span><span></span></button>
            <?php wp_nav_menu(array('theme_location' => 'right-menu')) ?>
        </div>
    </div>
    <?php wp_nav_menu(array('theme_location' => 'mobile-menu')) ?>
    </header>