<?php

/**
 * Block Name: Top Home
 *
 *
 */

if (is_admin()) : echo "<div style=\"width: 100%; padding: 20px 20px;text-align: center;font-size: 10px;background: #eee\">Haut de page</div>";
else :
    global $post;
    $bg = get_field("background_home");
    $cp = get_field("catchphrase_home");
    $text = get_field("text_home");
?>
    <section class="homeTop homeTop--<?= $block['id'] ?>">
        <div class="homeTop--bg" style="background-image: url(<?php echo esc_url($bg['url']); ?>)">
            <div class="homeTop__content">
                <div class="homeTop__content__left">
                    
                    <h1><?= $text ?></h1>
                    <div class="homeTop__content__form">
                    <?php get_search_form(); ?>
                    </div>
                </div>
                <div class="homeTop__content__right">
                        <img class="homeTop__content__catchphrase" src="<?php echo esc_url($cp['url']); ?>" alt="phrase d'accorche annimée">
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>