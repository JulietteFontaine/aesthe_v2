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

    <div class="beforeAfter__container">
        <figure class="slider">

        <?php $image_before = get_field('image_before'); ?>
        <div class="slider__before" style="background-image: url('<?php echo esc_url($image_before['url']); ?>"></div>
        
        
        <?php $image_after = get_field('image_after'); ?>
        <div class="slider__after" style="background-image: url('<?php echo esc_url($image_after['url']);?>"></div>

        <!-- <div class="slider__separateur"></div> -->
        
        <input class="slider__range" type="range" min="0" max="100" value="50" />
        </figure>


    </div>
    <!-- <p><?= the_field('legende') ?></p> -->
</section>

<?php endif; ?>