<?php

/**
 * Block Name: Bouton
 *
 *
 */


if (is_admin()) : echo "<div style=\"width: 100%; padding: 20px 20px;text-align: center;font-size: 10px;background: #eee\">Bouton Aesthe (cliquer pour modifier)</div>";
else : 
?>
        <div class="bouton-aesthe">
        <a class="cta" href="<?php echo get_field("lien")['url'] ?>">
        <div class="picto-cta"><?php include('wp-content/themes/aesthe/assets/img/fleche-cta.svg'); ?></div>
            <button class="cta">
            <span><?php echo get_field("premiere_ligne")?></span>
            <span><?php echo get_field("lien")['title']?></span>
            </button>
        </a>
        </div>
<?php endif ?>