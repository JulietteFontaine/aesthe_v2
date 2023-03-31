<?php

/**
 * Block Name: Centre
 *
 * 
 */

?>

<?php
if (is_admin()) : echo "<div style=\"width: 100%; padding: 20px 20px;text-align: center;font-size: 10px;background: #eee\">Centres (Cliquer pour modifier)</div>";
else :
    global $post;
    $centers = get_field('centers');
?>
    <section class="center center--<?= $block['id'] ?>">
            <?php foreach ($centers as $center) :
                if ($centers) :
                 ?>
            <div class="center-left" style="background-image: url(<?= get_field("background", $center->ID)["url"] ?>)">

            <div class="center-left__content">
            <div class="center-left__adress">
                <?php echo "<p>" .get_field("town", $center->ID) . "</p>"; ?> 
                <?php echo "<p>" .get_field("adress", $center->ID) . "</p>"; ?>
            </div>

            <?php $times = get_field('times', $center->ID);
            if($times) :
            echo '<div class="center-left__times">';
            foreach ($times as $time):
               echo '<p>' . $time['days'] . '</p>';
               echo '<p>' . $time['opening'] ;
               echo include('wp-content/themes/aesthe/assets/img/fleche-horizontale.svg');
               echo substr($time['closing'],1) . '</p>';
            endforeach;        
            echo '</div>';
            endif;
            ?>

                <div class="center-left__acces">
                <?php $parking = get_field('parkings', $center->ID); 
                if($parking) :?>
                    <div class="center-left__acces--parking">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30" height="30">
                        <circle cx="15" cy="15" r="13" stroke-width="2" stroke="#5D23D0" fill="white" fill-opacity="0"/>
                        <text x="50%" y="50%" text-anchor="middle" dominant-baseline="central" fill="#5D23D0" font-weight="bold" font-family="Montserrat" font-size="17px">P</text>
                    </svg>
                    <?php foreach ($parking as $p): 
                        echo '<p>' . $p['parking_name'] . '</p>';
                    endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <?php $subways = get_field('subways', $center->ID); 
                     if($subways) :
                     ?>
                    <div class="center-left__acces--subway">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30" height="30">
                        <circle cx="15" cy="15" r="13" stroke-width="2" stroke="#5D23D0" fill="white" fill-opacity="0"/>
                        <text x="50%" y="50%" text-anchor="middle" dominant-baseline="central" fill="#5D23D0" font-weight="bold" font-family="Montserrat" font-size="17px">M</text>
                    </svg>
                    <?php 
                        $stop = $subways['stop'];
                        $picto = $subways['subway_picto'];
                        foreach ($picto as $p) : ?>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30" height="30">
                                <circle cx="15" cy="15" r="13" fill="<?php echo $p["couleur"] ?>" />
                                <text x="50%" y="50%" text-anchor="middle" dominant-baseline="central" fill="<?php echo $p["couleur_numero"] ?>" font-weight="bold"  font-family="Montserrat" font-size="17px"><?php echo $p["numero"] ?></text>
                            </svg>
                        <?php 
                        endforeach; 
                        foreach ($stop as $s) :
                            echo '<p>' . $s['stop_name'] . '</p>';
                        endforeach;
                        echo '</div>';
                        endif ; ?>
                    </div>
                    
                </div>
                <div class="center-left__links">
                <div class="center-left__links--nous-ecrire">
                    <?php if (get_field("contact_link", $center->ID)) : ?>
                        <a href="<?php the_field("contact_link", $center->ID) ?>">Nous écrire</a>
                    <?php endif ?>
                </div>
                <div class="center-left__links--centers">
                    <?php if (get_field("centers_link", $center->ID)) : ?>
                        <a href="<?php the_field("centers_link", $center->ID) ?>">Voir tout nos centres</a>
                    <?php endif ?>
                </div>
                </div>

                </div>

                <div class="center-right">
                    <?php echo get_field("maps", $center->ID) ?>
                </div>


<?php
                endif;
            endforeach ?>
    </section>
<?php
endif
?>