<?php

/**
 * Block Name: Univers horizontal scroll
 *
 *
 */

if (is_admin()) : echo "<div style=\"width: 100%; padding: 20px 20px;text-align: center;font-size: 10px;background: #eee\">Univers horizontal scroll</div>";
else : ?>
  <section class="universHorScroll universHorScroll--<?= $block['id'] ?>">
  <?php
  $i = 0;
  if( have_rows('words') ):
    while ($i <= 1) :
    echo "<span class='text'>";
    while( have_rows('words') ) : the_row();
    echo the_sub_field('word');
    include('wp-content/themes/aesthe/assets/img/rond-orange.svg');
    endwhile;
    echo "&nbsp;</span>";
    $i++;
    endwhile;
    endif;
?>
  </section>

<?php
endif ;
?>