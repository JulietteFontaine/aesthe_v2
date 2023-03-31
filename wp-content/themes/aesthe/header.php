<?php $local = strpos($_SERVER['DOCUMENT_ROOT'], "C:/web/") !== false; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <?php
    $titre = wp_title('', false);
    $titre = trim($titre);
    if (get_field('meta_title', get_the_ID())) $titre = get_field('meta_title');
    ?>

    <!-- $iPhone = stripos($_SERVER['HTTP_USER_AGENT'], "iPhone");
    $our_website = get_the_permalink();
    if ($iPhone > -1 && !isset($_COOKIE['trust_pabau'])) {
        setcookie("trust_pabau", "1");
        header('Location: https://connect.pabau.com/safari_approve.php?ref=' . urlencode($our_website));
    } -->

    <title><?= $titre; ?></title>

    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0" />
    <meta name="facebook-domain-verification" content="yl47nsx11nhdeyzjau5tei2tjqsird" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css">
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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,500;0,600;0,700;0,800;1,500;1,600;1,700;1,800&family=Noto+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="<?= get_template_directory_uri(); ?>/style.css" rel="stylesheet">
    <script>
        // ie css vars — https://github.com/nuxodin/ie11CustomProperties
        window.MSInputMethodContext && document.documentMode && document.write('<script src="https://cdn.jsdelivr.net/gh/nuxodin/ie11CustomProperties@4.1.0/ie11CustomProperties.min.js"><\/script>');
    </script>

    <script src="<?= get_template_directory_uri(); ?>/assets/js/code-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <?php wp_head(); ?>

</head>

<body <?php body_class('slug-' . basename(get_permalink())); ?>>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5V3M2D8" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <header class="siteHeader wrapper">
        <?php

        global $wp;
        $current_url = home_url( add_query_arg( array(), $wp->request ) );

        $cat = get_the_category(get_queried_object_id());
        $color = "noir";
        foreach ($cat as $c) :
            if ($c->slug == "menu-blanc") :
                $color = "blanc";
            endif;
        endforeach;

        $left_menu_items = get_field('left_menu', 'option');
        $right_menu_items = get_field('right_menu', 'option');

        ?>

<div class="menu-full-header-container close">
            <!-- MENU GAUCHE -->
            <div id="menu-left-header" class="menu <?= $color ?>">
            <div class="tel <?= $color ?>"><?php echo get_field('telephone', 'option'); ?></div>
                <ul>
                    <?php
                                            
                    foreach ($left_menu_items as $page) :
                        $ID_page = $page['menu_item']->ID;
                        $page_url = get_permalink($ID_page);
                    ?>

                        <li class="page_item <?= $color ?> page_item_<?= $ID_page ?>
                        <?php if ($page['sub_items']) : echo "page_item_has_children";endif;?> 
                        <?php if(substr($page_url, 0, -1) == $current_url): echo "current_page";endif; ?>">
                            <a href="<?php echo esc_url($page_url) ?>"><?= $page['menu_item']->post_title ?></a>
                            <?php
                            if ($page['sub_items']) :
                            ?>
                                <ul class="children">
                                    <?php foreach ($page['sub_items'] as $sub_items) :
                                        $ID_item = $sub_items['menu_sub_item']->ID;
                                        $sub_page_url = get_permalink($ID_item);
                                    ?>
                                        <li class="sub_page_item <?= $color ?> sub_page_item_<?= $ID_item ?> <?php if(substr($sub_page_url, 0, -1) == $current_url): echo "current_page";endif;?>">
                                            <a href="<?php echo esc_url($sub_page_url) ?>"><?= $sub_items['menu_sub_item']->post_title ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php
                            endif;
                            ?>
                        </li>
                        <span class="billes">●</span>
                    <?php
                    endforeach;
                    ?>
                </ul>
            </div>
            <!-- FIN MENU COTE GAUCHE -->
            <div  class="menu-logo-header">
            <a class="aesthe_logo" href="<?php bloginfo('url'); ?>/" aria-label="aesthé, médecine esthétique">
                <?php if ($color == "blanc") :
                    include('assets/img/logoB.svg');
                elseif ($color == "noir") :
                    include('assets/img/logoN.svg');
                endif ?>
            </a>
            <button class="burger <?= $color ?> close"><span></span><span></span><span></span></button>
            </div>
            <!-- MENU DROITE -->
            <div id="menu-right-header" class="menu <?= $color ?>">

                <ul>
                    <?php
                    foreach ($right_menu_items as $page) :
                        $ID_page = $page['menu_item']->ID;
                    ?>
                        <li class="page_item <?= $color ?> page_item_<?= $ID_page ?> <?php if ($page['sub_items']) : echo "page_item_has_children"; endif; ?>">
                            <a href="<?php echo esc_url(get_permalink($ID_page)) ?>"><?= $page['menu_item']->post_title ?></a>
                            <?php
                            if ($page['sub_items']) :
                            ?>
                                <ul class="children">
                                    <?php foreach ($page['sub_items'] as $sub_items) :
                                        $ID_item = $sub_items['menu_sub_item']->ID;
                                    ?>
                                        <li class="sub_page_item <?= $color ?> sub_page_item_<?= $ID_item ?>">
                                            <a href="<?php echo esc_url(get_permalink($ID_item)) ?>"><?= $sub_items['menu_sub_item']->post_title ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php
                            endif;
                            ?>
                        </li>
                        <span class="billes">●</span>
                    <?php
                    endforeach;
                    ?>
                    <li class="page_item page_item_telephone"><?php echo get_field('telephone', 'option'); ?></li>
                    <span class="billes">●</span>
                    <li class="page_item page_item_langue">FR EN</li>
                </ul>
            </div>
            <!-- FIN MENU DROITE -->
        </div>

    </header>
