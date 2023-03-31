<?php

/**
 * Block Name: Siblings
 *
 *
 */
?>

<?php
if (is_admin()) : echo "<div style=\"width: 100%; padding: 20px 20px;text-align: center;font-size: 10px;background: #eee\">Siblings (cliquer pour modifier)</div>";
else :
?>

    <section class="siblings siblings--<?= $block['id']?>">
        <h3>Découvrir aussi</h3>
        <?php
        $siblings = get_field('siblings');
        if( $siblings ): 
            ?>
            <ul>
                <?php foreach ($siblings as $i => $sibling) : 
            $permalink = get_permalink($sibling->ID );?>
                <li>
                    <a href="<?= $permalink ?>">
                    <h4><?= $sibling->post_title ?></h4>
                    </a>
                </li>
                <?php endforeach; ?>
    </ul>
        <?php endif; ?>
    </section>

<?php endif; ?>