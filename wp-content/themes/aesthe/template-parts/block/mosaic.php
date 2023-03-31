<?php

/**
 * Block Name: Mosaique
 *
 *
 */


if (is_admin()) : echo "<div style=\"width: 100%; padding: 20px 20px;text-align: center;font-size: 10px;background: #eee\">Mosaique (cliquer pour modifier)</div>";
else :
    ?>

<section class="mosaic mosaic--<?= $block['id'] ?>">
                    <h2><?php the_field("mosaic_title") ?></h2>

                    <div class="mosaic__controls">
                        <?php
                            $rows = get_field("mosaic");
                            if($rows) : 
                                $i = 0;
                                ?>
                        <ul class="mosaic__controls__container__<?= count($rows) ?>">
                            <?php
                                foreach ($rows as $k => $row) :
                                    $i++;
                            ?>
                                <li style="background-image: url(<?php if ($row["background_image"]) : echo $row["background_image"]['url'];endif;?>)" class="mosaic__controls__case <?php if ($k == 0) : ?>active<?php endif; ?>"><?php echo $row['case_title'] ?></li>
                            <?php
                                endforeach;
                            endif;
                            ?>

                        </ul>
                    </div>
                    <div class="mosaic__informations__slider">
                    <?php  foreach ($rows as $k => $row) : ?>
                        <div class="mosaic__informations">
                            <div class="mosaic-content">
                            <span class="btn-close"><?php include('wp-content/themes/aesthe/assets/img/croix5D23D0.svg'); ?></span>
                            <?php
                            echo "<h3>" . $row['case_title'] . "</h3>";
                            echo $row['text'];
                            ?>
                            <?php if ($row["button_link"]) : ?>

                            <div class="cta">
                            <div class="picto-cta"><?php include('wp-content/themes/aesthe/assets/img/fleche-cta.svg'); ?></div>
                            <button class="cta">
                                <span>En savoir plus</span>
                                <a href="<?php echo $row["button_link"]['url']?>">
                                <span class="cta-link"><?php echo $row["button_link"]['title']?></span>
                                </a>
                            </button>
                            </div>

                            <?php endif ;?>
                            </div>
                    </div>
                            <?php endforeach ?>
                    </div>

</section>
<?php endif ?>