<?php

/** 
 * Search result page
 */

get_header();

global $wp_query;

// The Query
$tech_meds = [];
$articles = [];
$pages = [];

if ($wp_query->have_posts()) :
    $posts = $wp_query->posts;
    foreach ($posts as $post) :
        $ID = get_the_ID($post);
        $post_type = get_post_type($ID);
        if ($post_type == "soins" || $post_type == "tech-meds") :
            $tech_meds[] = $post;
        elseif ($post_type == "page" && $post_type !== "soins" && $post_type !== "tech-meds") :
            $pages[] = $post;
            elseif ($post_type == "post" || $post_type == "conseils") :
            $articles[] = $post;
        endif;
    endforeach;
endif;
?>
<div class="searchPage wrapper">
<?php
get_template_part( 'template-parts/breadcrumb' );
?>
    <!-- SECTION  TECHNIQUES ET OFFRES -->

    <?php if (count($tech_meds) > 0) : ?>
        <section class="sliderCards three">
            <h2 class="h3">Soins</h2>
            <div class="sliderCards__controls three">
                <li class="sliderCards__controls three --prev"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/prev.svg" alt=""></li>
                <li class="sliderCards__controls three --next"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/next.svg" alt=""></li>
            </div>
            <div class="sliderCards__three">
            <div class="sliderCards__container three ">
                <?php
                // global $post;
                foreach ($tech_meds as $post) :
                    get_template_part('template-parts/card');
                endforeach;
                ?>
            </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- SECTION CARD CONSULT -->
    <section class="searchPage__cardConsult">
    <article class="card">
        <div class="card__btn-more"><?php include('wp-content/themes/aesthe/assets/img/fleche-FFFFFF.svg');?></div>
            <div class="card__single">
                <div class="card__top" style="background-image: url(https://aesthe.com/wp-content/uploads/Copie-de-DSC05635-scaled.jpg)">
                <div class="card__circle"></div>      
                </div>
                <div class="card__bottom">
                    <div class="card__title">
                        <h5>Consultation personnalisée</h5> 
                    </div>
                    <div class="card__content">
                    <p>Chez aesthé, tout patient fait systématiquement l’objet d’une consultation approfondie avec l’un de nos médecins.</p>
                        
                    <a class="cta" href="https://aesthe.com/offres/consultation-medicale-aesthe/">
                            <div class="picto-cta"><?php include('wp-content/themes/aesthe/assets/img/fleche-cta.svg');?></div>
                                <button class="cta">
                                    <span>Je découvre</span>
                                    <span>Consultation personnalisée</span>
                                </button>
                        </a>
                    </div>
                </div>
        </div>
        </article>
        <div class="texteExplicatif">Chez aesthé, tout nouveau patient bénéficie d'une consultation personnalisée et gratuite avec l'un de nos médecins. Cet échange permet d'exposer au médecin les besoins de votre peau, de votre visage ou toutes vos interrogations concernant nos soins et nos techniques. Notre équipe est à votre écoute pour définir avec vous le protocole de soins qui vous conviendra.</div>
    </section>

    <!-- SECTION DES ARTICLES -->
    <?php
        if (count($articles) > 0) :
            echo '<h2 class="h3 articlesResult">Articles</h2>';
            echo '<section class="searchPage__articlesResult">';
            foreach ($articles as $a) :
                echo "<a class=\"searchPost\" href=\"" . get_the_permalink($a->ID) . "\">";
                if (!empty(get_the_post_thumbnail_url($a->ID))) :
                echo "<div class='searchPost__thumb' style='background-image: url(" . get_the_post_thumbnail_url($a->ID, 'thumbnail') . ")'>";
                // echo get_the_post_thumbnail($a->ID, 'thumbnail');
                echo "</div>";
                endif;
                echo "<h3>" . $a->post_title . "</h3>";
                echo "<p class=\"searchPost__excerpt\">" . $a->post_excerpt .  "</p>" ;
                echo "<p>" . wp_trim_words($a->post_content, 30) .  "</p>";
                echo "</a>";
            endforeach;
            echo '</section>';
        endif;
        ?>

        <!-- SECTION DES Pages -->
        <?php
        if (count($pages) > 0) :
            echo '<h2 class="h3 pagesResult">Pages</h2>';
            echo '<section class="searchPage__pagesResult">';
            foreach ($pages as $p) :
                echo "<a href=\"" . get_the_permalink($p->ID)  . "\">";
                // echo "<div class=\"searchPosts__thumb\">";
                // echo get_the_post_thumbnail($p->ID, 'thumbnail');
                // echo "</div>";
                echo "<h3>" . $p->post_title . "</h3>";
                echo "<p>" . wp_trim_words($p->post_excerpt, 60) . "</p>";
                // echo $p->post_excerpt;
                echo "</a>";
            endforeach;
            echo '</section>';
        endif;
        ?>
</div>

<?php get_footer(); ?>