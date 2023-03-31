<?php

/**
 * Block Name: Slider cards
 *
 * 
 */
?>

<?php
if (is_admin()) :
    echo "<div style=\"width: 100%; padding: 20px 20px;text-align: center;font-size: 10px;background: #eee\">Slider de cartes (cliquer pour modifier)</div>";
else :

?>

<section class="sliderCards sliderCards--<?= $block['id']?> <?php the_field('number'); ?>">
    <div class="sliderCards__controls <?php the_field('number'); ?>">
        <li class="sliderCards__controls <?php the_field('number'); ?> --prev" aria-disabled>
        <?php include('wp-content/themes/aesthe/assets/img/fleche-coffee.svg');?>
        </li>
        <li class="sliderCards__controls <?php the_field('number'); ?> --next" aria-disabled>
        <?php include('wp-content/themes/aesthe/assets/img/fleche-coffee.svg');?>
        </li>
    </div>
        <div class="sliderCards__info <?php the_field('number'); ?>">
            <?php if (!empty(get_field('text'))) : ?>
            <?php the_field('text'); ?>
            <?php endif ?>
        </div>
            <div class="sliderCards__<?php the_field('number'); ?>">
            <div class="sliderCards__container <?php the_field('number'); ?>">
               <?php get_template_part('template-parts/card'); ?>
            </div>
            </div>

    </section>
<?php endif; ?>