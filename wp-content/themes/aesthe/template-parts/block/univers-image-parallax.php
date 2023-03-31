<?php

/**
 * Block Name: Univers image parallax
 *
 *
 */

if (is_admin()) : echo "<div style=\"width: 100%; padding: 20px 20px;text-align: center;font-size: 10px;background: #eee\">Univers image parallax</div>";
else : ?>
<section class="universImgPara">
  <img src="<?= get_field("image")["url"] ?>" data-speed="-0.65" class="img-parallax">
  </section>
<?php
endif ;
?>