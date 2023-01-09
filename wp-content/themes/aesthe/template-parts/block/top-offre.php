<?php

/**
 * Block Name: Top offre
 *
 *
 */

if (is_admin()) : echo "<div style=\"width: 100%; padding: 20px 20px;text-align: center;font-size: 10px;background: #eee\">Top Offre (cliquer pour modifier)</div>";
else :

    global $post;
    $bg = get_field("background");
    $cp = get_field("catchphrase");
?>

    <section class="offreTop offreTop--<?= $block['id'] ?>">
        <div class="offreTop--bg" style="background-image: url('<?php echo esc_url($bg['url']); ?>">
        <div class="offreTop__content wrapper">
            <div class="offreTop__content__left">
                <img class="offreTop__content__catchphrase" src="<?php echo esc_url($cp['url']); ?>" alt="phrase d'accorche annimée">
            </div>
            <div class="offreTop__content__right">
                <h1><?php echo $post->post_title ?></h1>
                <?php $featured_posts = get_field('prestations');
                if ($featured_posts) :
                ?>
                    <span>Selectionnez une prestation</span>

                    <div class="offreTop__controls">
                        <ul class="offreTop__controls__container">
                            <?php
                            foreach ($featured_posts as $k => $featured_post) :
                            ?>
                                <li class="<?php if ($k == 0) : ?>active<?php endif; ?>"><?php the_field('entitled', $featured_post->ID); ?></li>
                            <?php
                            endforeach;
                            ?>
                        </ul>
                    </div>

                    <div class="offreTop__informations">
                        <?php foreach ($featured_posts as $k => $featured_post) : ?>
                            <div class="offreTop__single">
                            <div class="offreTop__informations price"><?php echo get_field('price', $featured_post->ID); ?></div>
                                <div class="offreTop__informations rate">
                                <?php $stars = get_field('rate', $featured_post->ID);
                                if ($stars == 0) :
                                     include('wp-content/themes/aesthe/assets/img/stars/star-empty.svg'); include('wp-content/themes/aesthe/assets/img/stars/star-empty.svg'); include('wp-content/themes/aesthe/assets/img/stars/star-empty.svg'); include('wp-content/themes/aesthe/assets/img/stars/star-empty.svg'); include('wp-content/themes/aesthe/assets/img/stars/star-empty.svg');
                                    elseif ($stars == 1):
                                    include('wp-content/themes/aesthe/assets/img/stars/star.svg'); include('wp-content/themes/aesthe/assets/img/stars/star-empty.svg'); include('wp-content/themes/aesthe/assets/img/stars/star-empty.svg'); include('wp-content/themes/aesthe/assets/img/stars/star-empty.svg'); include('wp-content/themes/aesthe/assets/img/stars/star-empty.svg');
                                    elseif ($stars == 1.5):
                                    include('wp-content/themes/aesthe/assets/img/stars/star.svg'); include('wp-content/themes/aesthe/assets/img/stars/star-half.svg'); include('wp-content/themes/aesthe/assets/img/stars/star-empty.svg'); include('wp-content/themes/aesthe/assets/img/stars/star-empty.svg'); include('wp-content/themes/aesthe/assets/img/stars/star-empty.svg');
                                    elseif ($stars == 2):
                                        include('wp-content/themes/aesthe/assets/img/stars/star.svg'); include('wp-content/themes/aesthe/assets/img/stars/star.svg'); include('wp-content/themes/aesthe/assets/img/stars/star-empty.svg'); include('wp-content/themes/aesthe/assets/img/stars/star-empty.svg'); include('wp-content/themes/aesthe/assets/img/stars/star-empty.svg');
                                        elseif ($stars == 2.5):
                                            include('wp-content/themes/aesthe/assets/img/stars/star.svg'); include('wp-content/themes/aesthe/assets/img/stars/star.svg'); include('wp-content/themes/aesthe/assets/img/stars/star-half.svg'); include('wp-content/themes/aesthe/assets/img/stars/star-empty.svg'); include('wp-content/themes/aesthe/assets/img/stars/star-empty.svg');
                                            elseif ($stars == 3):
                                                include('wp-content/themes/aesthe/assets/img/stars/star.svg'); include('wp-content/themes/aesthe/assets/img/stars/star.svg'); include('wp-content/themes/aesthe/assets/img/stars/star.svg'); include('wp-content/themes/aesthe/assets/img/stars/star-empty.svg'); include('wp-content/themes/aesthe/assets/img/stars/star-empty.svg');
                                                elseif ($stars == 3.5):
                                                    include('wp-content/themes/aesthe/assets/img/stars/star.svg'); include('wp-content/themes/aesthe/assets/img/stars/star.svg'); include('wp-content/themes/aesthe/assets/img/stars/star.svg'); include('wp-content/themes/aesthe/assets/img/stars/star-half.svg'); include('wp-content/themes/aesthe/assets/img/stars/star-empty.svg');
                                                    elseif ($stars == 4):
                                                        include('wp-content/themes/aesthe/assets/img/stars/star.svg'); include('wp-content/themes/aesthe/assets/img/stars/star.svg'); include('wp-content/themes/aesthe/assets/img/stars/star.svg'); include('wp-content/themes/aesthe/assets/img/stars/star.svg'); include('wp-content/themes/aesthe/assets/img/stars/star-empty.svg');
                                                        elseif ($stars == 4.5):
                                                            include('wp-content/themes/aesthe/assets/img/stars/star.svg'); include('wp-content/themes/aesthe/assets/img/stars/star.svg'); include('wp-content/themes/aesthe/assets/img/stars/star.svg'); include('wp-content/themes/aesthe/assets/img/stars/star.svg'); include('wp-content/themes/aesthe/assets/img/stars/star-half.svg');
                                                            elseif ($stars == 5):
                                                                include('wp-content/themes/aesthe/assets/img/stars/star.svg'); include('wp-content/themes/aesthe/assets/img/stars/star.svg'); include('wp-content/themes/aesthe/assets/img/stars/star.svg'); include('wp-content/themes/aesthe/assets/img/stars/star.svg'); include('wp-content/themes/aesthe/assets/img/stars/star.svg');
                                    endif;
                                ?>
                                <a href="#"><?php echo get_field('number_reviews', $featured_post->ID);?> avis</a></div>
                                <!-- <div class="offreTop__informations--bg"></div> -->
                                <div class="offreTop__informations description"><?php echo get_field('description', $featured_post->ID); ?>
                                <a href="<?php echo get_field("rdv_link", $featured_post->ID)['url']?>">
                                    <button class="offreTop__informations button">JE RESREVE</br><?php echo get_field("rdv_link", $featured_post->ID)['title']?></button>
                                </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                <?php endif; ?>
            </div>
        </div>
        <!-- bg -->
        </div>
    </section>

<?php
endif;
// vd($post);
?>