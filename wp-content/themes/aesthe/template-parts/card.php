<?php
$post_type = get_post_type($post->ID);
$post_type_obj = get_post_type_object($post_type);
$label = $post_type_obj->labels->singular_name;
$post_taxo = get_the_terms($post->ID, 'type');
// pour les sliders
$posts = get_field('cards');

?>

    <?php
    if ($posts) :
        foreach ($posts as $related_posts) :
    ?>
    <article class="card">
        <div class="card__btn-more"><?php include('wp-content/themes/aesthe/assets/img/fleche-FFFFFF.svg');?></div>
            <div class="card__single">
                <div class="card__top" style="background-image: url(<?php echo get_the_post_thumbnail_url($related_posts->ID);
                    ?>)">
                <div class="card__circle"></div>      
                </div>
                <div class="card__bottom">
                    <div class="card__title">
                        <h3 class="cardtitle"><?= $related_posts->post_title ?></h3> 
                    </div>
                    <div class="card__content">
                    <p><?php echo wp_trim_words(get_the_excerpt($related_posts->ID), 18);?></p>
                        
                    <div class="cta">
                            <div class="picto-cta"><?php include('wp-content/themes/aesthe/assets/img/fleche-cta.svg');?></div>
                                <button class="cta">
                                    <span>Je découvre</span>
                                    <a href="<?php the_permalink($related_posts->ID)?>">
                                    <span><?= $related_posts->post_title ?></span>
                                    </a>
                                </button>
                    </div>
                    
                    </div>
                </div>
        </div>
            </article>
    <?php
        endforeach;
    elseif ($post) : ?>
        <article class="card">
        <div class="card__btn-more"><?php include('wp-content/themes/aesthe/assets/img/fleche-FFFFFF.svg');?></div>
            <div class="card__single">
                <div class="card__top" style="background-image: url(<?php echo get_the_post_thumbnail_url($post);
                    ?>)">
                <div class="card__circle"></div>      
                </div>
                <div class="card__bottom">
                    <div class="card__title">
                        <h5><?= $post->post_title ?></h5> 
                    </div>
                    <div class="card__content">
                    <p><?php echo wp_trim_words(get_the_excerpt($post->ID), 18);?></p>
                        
                    <a class="cta" href="<?php the_permalink($post)?>">
                            <div class="picto-cta"><?php include('wp-content/themes/aesthe/assets/img/fleche-cta.svg');?></div>
                                <button class="cta">
                                    <span>Je découvre</span>
                                    <span><?= $post->post_title ?></span>
                                </button>
                        </a>
                    </div>
                </div>
        </div>
            </article>
    <?php endif; ?>