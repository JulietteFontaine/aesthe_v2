<?php

/**
 * Block Name: Avant apres

 *
 *
 */


if (is_admin()) : echo "<div style=\"width: 100%; padding: 20px 20px;text-align: center;font-size: 10px;background: #eee\">Avant apres (cliquer pour modifier)</div>";
else : ?>

    <section class="beforeAfter">
        <div class="beforeAfter">
            <h2>
                <?php the_field('title') ?>

            </h2>
        </div>
        <div class="beforeAfter__image">

            <div class="beforeAfter__image__container">
                <figure class="beforeAfter__image__before">
                    <?php
                    $image_before = get_field('image_before');
                    if (!empty($image_before)) : ?>
                        <?php echo wp_get_attachment_image($image_before['ID'], 'medium'); ?>

                    <?php endif;

                    $image_after = get_field('image_after'); ?>
                    <div class="beforeAfter__image__after" style="background-image: url(<?php echo esc_url($image_after['url']); ?>)">
                    </div>
                </figure>
                <input type="range" min="0" max="100" value="50" id="avantApres__range">
            </div>

            <p><?= the_field('legende') ?></p>
        </div>
    </section>

<?php endif; ?>