<?php

/**
 * Block Name: Top SEO
 *
 *
 */

if (is_admin()) : echo "<div style=\"width: 100%; padding: 20px 20px;text-align: center;font-size: 10px;background: #eee\">Top SEO (cliquer pour modifier)</div>";
else :
    $background = get_field("background");
    $title = get_field("title");
    $intro = get_field("intro");
    $color_block = get_field_object("color_right_block");
    $color_title = get_field_object("color_title");

    $label = $color_title['choices'][$color_title['value']];
?>      

<section class="topSeo topSeo--<?= $block['id'] ?>">

<div class="topSeo__left" style="background-image:url(<?= $background ?>)">
<h1 style="color:<?php echo $color_title['value'] ?>"><?=$title?></h1>
</div>
<div class="topSeo__right" style="background-color:<?php echo $color_block['value'] ?>">
<div class="<?= substr($color_block['value'], 1) ?>">
<?= $intro ?>
<?php if (get_field("cta_link")) : ?>
<a class="cta" href="<?php echo get_field("cta_link")['url']?>">
<div class="picto-cta"><?php include('wp-content/themes/aesthe/assets/img/fleche-cta.svg'); ?></div>
    <button class="cta">
    <span>Je Réserve</span>
    <span><?php echo get_field("cta_link")['title']?></span>
    </button>
</a></div>
<?php endif ?>
</div>
</section>
<?php endif ?>
