<?php

/**
 * Block Name: Avant apres
 *
 *
 */


if (is_admin()) : echo "<div style=\"width: 100%; padding: 20px 20px;text-align: center;font-size: 10px;background: #eee\">Before after (cliquer pour modifier)</div>";
else : 

$image_seule = get_field("image_seule") ?>

    <section class="avantApres">
        <div class="avantApres__title">
            <h2 class="title-uppercase">
                <?php the_field('title') ?>
            </h2>
        </div>
        <div class="avantApres__image">
            <div class="avantApres__image__container">
                <figure class="avantApres__image__before">
                    <?php
                    $image_before = get_field('image_before');
                    if (!empty($image_before)) : ?>
                        <?php echo wp_get_attachment_image($image_before['ID'], 'medium'); ?>

                    <?php endif;

                    $image_after = get_field('image_after');
                    if ($image_seule == false) : ?>
                    <div class="avantApres__image__after" style="background-image: url(<?php echo esc_url($image_after['url'])?>)">
                        <div class="avantApres__image__button">
                        </div>
                    </div>
                    <?php endif ?>
                </figure>
                <input type="range" min="0" max="100" value="50" id="avantApres__range">
            </div>
            <p><?= the_field('legend') ?></p>
        </div>
    </section>

<?php endif; ?>