<?php

/**
 * Block Name: Onglets questions
 *
 *
 */


if (is_admin()) : echo "<div style=\"width: 100%; padding: 20px 20px;text-align: center;font-size: 10px;background: #eee\">Onglets Questions (cliquer pour modifier)</div>";
else :

    $count = (count(get_field_object('tabs')['value']));
?>
    <div class="questionsTabs questionsTabs--<?= $block['id'] ?>">
        <?php if (have_rows('tabs')) : ?>
            <ul class="questionsTabs__content">
                <?php if (have_rows('tabs')) : $i = 0; ?>
                    <?php while (have_rows('tabs')) : the_row();
                    $i ++;
                    ?>
                        <li class="questionsTabs__list <?php if ($i == 1) : echo 'first'?><?php endif; ?>  <?php if ($i == $count) : ?> last <?php endif; ?>">
                            <h2><?= the_sub_field('tab_title') ?></h2>
                            <div class="questionsTabs__answer">
                                <p><?= the_sub_field('text') ?></p>
                                <?php
                                $link = get_sub_field('button_link');
                                if ($link) :
                                ?>
                                <a class="cta" href="<?php echo esc_url($link['url']); ?>">
                                    <div class="picto-cta"><?php include('wp-content/themes/aesthe/assets/img/fleche-cta.svg'); ?></div>
                                        <button class="cta">
                                        <span><?= $link['title'] ?></span>
                                        </button>
                                </a>
                                <?php endif; ?>
                            </div>
                        </li>
                <?php endwhile;
                endif ?>
            </ul>
        <?php endif; ?>
    </div>
<?php
endif;
?>