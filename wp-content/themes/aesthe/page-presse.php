<?php /* Template Name: Page presse */

get_header();

    $args = array(
        'post_type' => 'presse',
        'post_status' => 'publish',
        'posts_per_page' => -1,
    );

    $query_presse = new WP_Query($args);

    if ($query_presse->have_posts()) :
    ?>
        <section class="pressPage wrapper">

        <div class="pressPage__title">
            <h1>Les articles qui parlent de nous</h1>
        </div>
            <div class="pressPosts">
                <?php
                $i = 0 ;
                 while ($query_presse->have_posts()) : $query_presse->the_post();
                $i ++;
                    echo "<a class='pressPosts__post' target='_blank' href='" . get_field('lien', get_the_ID()) . "'>";
                    echo "<div class='pressPosts__thumb' style='background-image: url(" . get_the_post_thumbnail_url() . ")'>";
                    echo "</div>";
                    echo "<div class=\"pressPosts__info\">";
                    echo "<div class=\"pressPosts__postTitleDate\">";
                    ?>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 7 7" width="7" height="7">
                    <circle cx="3.5" cy="3.5" r="3.5" fill=" <?php if($i == 3): echo "#C53E23"; elseif( $i == 2) : echo "#FF8040"; else: echo "#5D23D0"; endif; ?> "/>
                    </svg>
                    <?php
                    the_field('date', get_the_ID());
                    echo "</div>";
                    the_field('paragraphe', get_the_ID());
                    echo "</div>";
                    echo "</a>";
                    if($i == 3) : $i = 0; endif;
                endwhile;
            endif;
                ?>
            </div>
        </section>
        
<?php get_footer(); ?>