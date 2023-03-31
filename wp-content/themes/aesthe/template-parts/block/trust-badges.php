<?php

/**
 * Block Name: Trust badges
 *
 *
 */
?>

<?php
if (is_admin()) : echo "<div style=\"width: 100%; padding: 20px 20px;text-align: center;font-size: 10px;background: #eee\">Badges de confiance (cliquer pour modifier)</div>";
else :
    $images = get_field('logos');
?>

    <ul class="sliderBadgesGallery">
        <?php
        foreach ($images as $i) :
            // vd($i["url"]);
            ?>
            <li class='sliderBadgesGallery__logo'>
                <img src="<?= $i["url"]?>">
            </li>;
            <?php
        endforeach;
        ?>
    </ul> 
 
<?php endif; ?>