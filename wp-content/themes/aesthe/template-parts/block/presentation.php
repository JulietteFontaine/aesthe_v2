<?php

/**
 * Block Name: Presentation

 *
 *
 */

if (is_admin()) : echo "<div style=\"width: 100%; padding: 20px 20px;text-align: center;font-size: 10px;background: #eee\">Presentation (cliquer pour modifier)</div>";
else : ?>

    <section class="presentation presentation--<?= $block['id'] ?>">

        <div class="presentation__info">
            <h2> <?php echo get_field("title") ?></h2>
            <p> <?php echo get_field("texte") ?></p>
        </div>

        <div class="presentation__pastille"></div>

        <?php if (have_rows('indications')) : ?>
            <div class="presentation__indications">
                <?php while (have_rows('indications')) : the_row(); ?>
                    <div class="presentation__single">
                        <span class="titre"><?php echo the_sub_field('indication_title'); ?></span>
                        <span class="texte"><?php echo get_sub_field('indication'); ?></span>
                    </div>
                <?php
                endwhile; ?>
            </div>
        <?php
        endif; ?>

    </section>
    <?php
endif
    ?>