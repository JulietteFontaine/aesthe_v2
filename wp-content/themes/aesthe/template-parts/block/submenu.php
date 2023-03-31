<?php

/**
 * Block Name: Sous menu
 *
 *
 */
?>

<?php
if (is_admin()) : echo "<div style=\"width: 100%; padding: 20px 20px;text-align: center;font-size: 10px;background: #eee\">Sous-menu (cliquer pour modifier)</div>";
else :

    global $post;

?>

    <section class="submenu titre-cta submenu--<?= $block['id'] . $post->ID ?> larger  <?= (get_field('lien')) ? '' : 'nocta' ?>">

        <!-- ----------------------------------------------------- titre et lien RDV ------------ -->
        <?php if (get_field('titre')) : ?>
            <h1><?= get_field('titre'); ?></h1>
        <?php endif; ?>

        <?php
        $link = get_field('lien');
        if ($link) :
            $link_url = $link['url'];
            $link_title = $link['title'];
            $link_target = $link['target'] ? $link['target'] : '_self';
        ?>

            <a class="cta" href="<?= $link_url?>">
            <div class="picto-cta"><?php include('wp-content/themes/aesthe/assets/img/fleche-cta.svg'); ?></div>
                <button class="cta">
                <span>Je Réserve</span>
                <span><?= $link_title ?></span>
                </button>
            </a>
        <?php endif; ?>

    </section>

<?php endif; ?>