        <div class="menu-full-header-container close">
            <!-- MENU GAUCHE -->
            <div id="menu-left-header" class="menu <?= $color ?>">
            <?php if ($left_menu_items) :?>
                <ul>
                    <?php foreach ($left_menu_items as $left_item) : 
                        $item = $left_item['menu_item'] ;
                        $submenu = $left_item['first_submenu'] ;
                        ?> 
                        <li class="menu_item">
                            <?php if ($item['menu_item_link']) :?>
                                <a href="<?php echo $item['menu_item_link'] ?>"><?php echo $item['menu_item_title'] ?></span></a>
                            <?php else : ?>
                                <?php echo $item['menu_item_title'] ?></span>
                            <?php endif ; ?>

                            <?php if ($submenu) :  ?>
                                <ul class="first_children">
                                <?php foreach ($submenu as $submenu_item) :
                                $first_items = $submenu_item["first_submenu_item"];
                                $second_items = $submenu_item["second_submenu_item"];
                                    vd($first_items);
                                    vd($second_items);
                                    ?>
                                <li class="submenu_item">

                                </li>
                                <?php endforeach ?>
                                </ul>
                            <?php endif ; ?>

                        </li>

                    <?php endforeach ; ?>
                </ul>
                <?php endif; ?>
            </div>
            <!-- FIN MENU COTE GAUCHE -->

            <div  class="menu-logo-header">
            <a class="aesthe_logo" href="<?php bloginfo('url'); ?>/" aria-label="aesthé, médecine esthétique">
                <?php if ($color == "blanc") :
                    include('assets/img/logoB.svg');
                elseif ($color == "noir") :
                    include('assets/img/logoN.svg');
                endif ?>
            </a>
            <button class="burger <?= $color ?> close"><span></span><span></span><span></span></button>
            </div>

            <!-- MENU DROITE -->
            <div id="menu-right-header" class="menu <?= $color ?>">

                <ul>

                </ul>

            </div>
            <!-- FIN MENU DROITE -->
        </div>