<?php

/**
 * Block Name: Cartes presentation accueil
 *
 */


if (is_admin()) : echo "<div style=\"width: 100%; padding: 20px 20px;text-align: center;font-size: 10px;background: #eee\">Cartes presentation soins (cliquer pour modifier)</div>";
else :
?>

    <section class="presentationCards presentationCards--<?= $block['id'] ?>">



        <?php if (get_field('text')) : ?>
            <div class="presentationCards__title title-capitalize">
                <?= the_field('text') ?>
            </div>
        <?php endif; ?>

        <?php
        $cards = get_field('cards');
        if ($cards) :
            $without = "Avec" ;
            foreach ($cards as $c) :
                if ($c['with_background'] == "Sans") :
                    $without = "Sans";
            endif;
            endforeach;
            ?>
                <div class="presentationCards__controls">
                    <li class="presentationCards__controls --prev" aria-disabled>
                    <?php if ($without == "Sans") :
                        include('wp-content/themes/aesthe/assets/img/pointe-noir.svg'); 
                        else : 
                        include('wp-content/themes/aesthe/assets/img/pointe-blanc.svg'); 
                        endif;
                        ?>
                    </li>
                    <li class="presentationCards__controls --next" aria-disabled>
                    <?php if ($without == "Sans") :
                        include('wp-content/themes/aesthe/assets/img/pointe-noir.svg'); 
                        else : 
                        include('wp-content/themes/aesthe/assets/img/pointe-blanc.svg'); 
                        endif;
                        ?>
                    </li>
                    </li>
                </div>

            <div class="presentationCards__cards">
                <?php
                $i = 1;
                $j = 0;
                foreach ($cards as $c) :
                    $j++;
                ?>
                    <div class="presentationCards__card <?= $c['with_background'] ?>" style="background-image: url(<?= $c['background'] ?>)">
                        <div class="presentationCards__card__title"><span class="nbr">0<?= $i ?>. </span><span style="background-color: <?php if ($j == 3) : echo "#C53E23";
                                                                                    elseif ($j == 2) : echo "#FF8040";
                                                                                    else : echo "#5D23D0";
                                                                                    endif; ?>" class="bille"></span>
                                                                                    <span class="text"><?= $c['title'] ?>
                                                                                    </span>
                                                                                </div>
                        <div class="p-pres"><?= $c['presentation'] ?></div>
                        <?php $focus = $c['focus']; ?>
                        <div class="presentationCards__card__focus">
                            <?php foreach ($focus as $f) : ?>
                                <div class="presentationCards__card__focus__tab close">
                                    <span><?= $f['title'] ?></span>
                                    <div style="background-color: <?php if ($without == "Sans" && $j == 3): 
                                                                                    echo "#C53E23";
                                                                                    elseif ($without == "Sans" && $j == 2) :
                                                                                    echo "#FF8040";
                                                                                    elseif ($without == "Sans"):
                                                                                    echo "#5D23D0";
                                                                                    endif;?>">
                                    <?= $f['text'] ?>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                        <button>
                            <a href="<?php echo $c['link'] ?>">
                            <?php
                            if ($c['with_background'] == "Avec") :
                            include('wp-content/themes/aesthe/assets/img/fleche-FFFFFF.svg');
                            else :
                            include('wp-content/themes/aesthe/assets/img/fleche-grey.svg');
                            endif
                            ?>
                            <span>Je découvre</span></a></button>
                    </div>
                <?php
                    $i++;
                    if ($j == 3) : $j = 0;
                    endif;
                endforeach; ?>
            </div>
        <?php endif; ?>

    </section>

<?php
endif;
?>