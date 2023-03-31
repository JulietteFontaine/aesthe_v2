<?php

/**
 * Block Name: Univers scrolling
 *
 *
 */

if (is_admin()) : echo "<div style=\"width: 100%; padding: 20px 20px;text-align: center;font-size: 10px;background: #eee\">Univers scrolling</div>";
else : ?>
    <section class="universScrolling universScrolling__container universScrolling--<?= the_field("position") ?> universScrolling--<?= $block['id'] ?>">
    <div class="universScrolling__title --<?= the_field("number") ?>">
        <div class="universScrolling__number --<?= the_field("number") ?>"><?= the_field("number") ?> <span>.</span></div>
        <div class="universScrolling__text"><?= the_field("title") ?></div>
        <?php if(get_field("text")) :?>
        <div class="universScrolling__content"><?= the_field("text") ?></div>
        <?php elseif (get_field("image")) : ?>
            <div class="universScrolling__content">
            <img src="<?= get_field("image")['url'] ?>">
            </div>
        <?php endif ?>
    </div>
    </section>
<?php
endif ;
?>