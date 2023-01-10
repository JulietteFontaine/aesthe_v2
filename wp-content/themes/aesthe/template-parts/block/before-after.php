<?php

/**
 * Block Name: Avant apres

 *
 *
 */


if (is_admin()) : echo "<div style=\"width: 100%; padding: 20px 20px;text-align: center;font-size: 10px;background: #eee\">Avant apres (cliquer pour modifier)</div>";
else : ?>

<section class="beforeAfter beforeAfter--<?= $block['id'] ?>">
        <div class="beforeAfter__title">
            <h2>
                <?php the_field('title') ?>
            </h2>
        </div>

        <div class='container'>
        <?php $image_before = get_field('image_before') ?>
            <div class='img background-img' style="background-image: url('<?php echo esc_url($image_before['url']); ?>"></div>

        <?php $image_after = get_field('image_after'); ?>
            <div class='img foreground-img' style="background-image: url('<?php echo esc_url($image_after['url']); ?>"></div>
            <input type="range" min="1" max="100" value="50" class="slider" name='slider' id="slider">
            <div class='slider-button'></div>
  </div>

</section>

<?php endif; ?>