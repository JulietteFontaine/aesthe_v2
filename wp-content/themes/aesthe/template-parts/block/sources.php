<?php

/**
 * Block Name: Sources
 *
 *
 */
?>

<?php
if (is_admin()) : echo "<div style=\"width: 100%; padding: 20px 20px;text-align: center;font-size: 10px;background: #eee\">Sources (cliquer pour modifier)</div>";
else : ?>

    <?php
    global $post;
    $featured_posts = get_field('sources');

    if ($featured_posts) : ?>
       <section class="sources sources--<?= $block['id']?>">
       <?php
        echo "<h3>En savoir plus</h3>";
        echo "<ul>";
        foreach ($featured_posts as $post) :
            setup_postdata($post);
            echo "<li>";
            echo "<a target=\"_blank\" href=" . $post['lien'] . "> \"" . $post['ancre'] . "\" </a>";
            echo "<span class='site'>" . $post['site'] . "</span>";
            if (!empty($post['date'])) :
                echo " <span class='date'>" . $post['date'];
            endif;
            echo "</span>";
            echo "</li>";
        endforeach;
        wp_reset_postdata();
        echo "</ul>";
        echo "</section>";
    endif;
    ?>

        <?php endif ?>