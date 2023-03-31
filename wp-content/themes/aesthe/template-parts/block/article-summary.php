<?php

/**
 * Block Name: articles lies 
 *
 *
 */
?>

<?php
if (is_admin()) : echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Sommaire (cliquer pour modifier)</div>";
else :
    global $post;
    // var_dump($post);
?>
<section class="summary summary--<?= $block['id'] ?>">
    <?php if (have_rows('summary')) : ?>
        <ul class="summary">
            <span class="summary__title">Sommaire</span>
            <nav>
            <?php
            $i = 1;
                while (have_rows('summary')) : the_row();
                    $link = get_sub_field('link');
            ?>
                        <a  class="summary__chapter" href="<?= $link["url"] ?>">
                        <span class="summary__number"><?php if ($i < 10) : echo "0" ; endif ;?><?= $i++ . "." ?></span><span class="summary__link"><?= $link["title"] ?></span>
                        </a>
                <?php
                endwhile;
                ?>
                </nav>
                <?php
                endif
                ?>
        </ul>
        <?php endif ?>
</section>