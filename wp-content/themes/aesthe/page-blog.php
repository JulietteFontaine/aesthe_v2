<?php /* Template Name: Page blog */

get_header();

        $args_ahead = array(
            'post_type' => array('conseils', 'post'),
            'post_status' => array('publish'),
            'posts_per_page' => '-1',
            'category_name' => 'ahead',
            'order' => 'DESC'
        );

        $query_ahead = new WP_Query($args_ahead);

        $args_side = array(
            'post_type' => array('conseils', 'post'),
            'post_status' => array('publish'),
            'posts_per_page' => '-1',
            'category__not_in' => '1',
            'order' => 'DESC'
        );

        $query_side = new WP_Query($args_side);

?>

<div class="wrapper"><?php get_template_part( 'template-parts/breadcrumb' ); ?></div>
<section class="conseilPage wrapper">

<!-- les plus lu  -->
<?php if ($query_ahead->have_posts()) : 
          $posts = $query_ahead->posts;?>
        <div class="conseilPageAhead">
        <h1 class="conseilPageAhead__title">Le blog Aesthe</h1>
        <?php  foreach ($posts as $post) :

                $catname = "";
                foreach (get_the_category($post) as $cat) :
                    if ($cat->name !== "En avant" && $cat->name !== "On page search") :
                    $catname = $cat->name;
                    endif;
                endforeach;
                
                echo "<a class=\"conseilPostAhead\" href=\"" . get_the_permalink() . "\">";
                echo "<div class='conseilPostAhead__thumb' style='background-image: url(" . get_the_post_thumbnail_url() . ")'>";
                echo "</div>";
                echo "<div class='catname'><span>" . $catname . "</span></div>";
                echo "<h3>" . get_the_title() . "</h3>";
                echo "<p class=\"conseilPostAhead__excerpt\">" . temps_lecture() .  "</p>" ;
                echo "<p>" . get_the_excerpt() .  "</p>";
                echo "</a>";

                ?>
   
<?php endforeach; ?>
</div>
<?php endif; ?>

<div class="circle circle--one"></div>
<div class="circle circle--two"></div>
<div class="circle circle--three"></div>

<!-- side articles -->
<?php if ($query_side->have_posts()) :
    $posts = $query_side->posts;
    ?>
    <div class="conseilPageSide">
        <?php 
        echo "<div class='conseilPageSide--left'>";
         foreach ($posts as $k => $post ) :
            $catname = "";
            foreach (get_the_category($post) as $cat) :
                if ($cat->name !== "En avant" && $cat->name !== "On page search") :
                $catname = $cat->name;
                endif;
            endforeach;
            if ($k%2 !== 1) :
            echo "<a class=\"conseilPostSide\" href=\"" . get_the_permalink() . "\">";
            echo "<div class='conseilPostSide__thumb' style='background-image: url(" . get_the_post_thumbnail_url() . ")'>";
            echo "</div>";
            echo "<div class='catname'><span>" . $catname . "</span></div>";
            echo "<h3>" . get_the_title() . "</h3>";
            echo "<p class=\"conseilPostSide__excerpt\">" . temps_lecture() .  "</p>" ;
            echo "<p>" . get_the_excerpt() .  "</p>";
            echo "</a>";
            endif ;
            endforeach;
            echo "</div>";

        echo "<div class='conseilPageSide--right'>";
         foreach ($posts as $k=>$post) :
            $catname = "";
            foreach (get_the_category($post) as $cat) :
                if ($cat->name !== "En avant" && $cat->name !== "On page search") :
                $catname = $cat->name;
                endif;
            endforeach;
            if ($k%2 == 1) :
            echo "<a class=\"conseilPostSide\" href=\"" . get_the_permalink() . "\">";
            echo "<div class='conseilPostSide__thumb' style='background-image: url(" . get_the_post_thumbnail_url() . ")'>";
            echo "</div>";
            echo "<div class='catname'><span>" . $catname . "</span></div>";
            echo "<h3>" . get_the_title() . "</h3>";
            echo "<p class=\"conseilPostSide__excerpt\">" . temps_lecture() .  "</p>" ;
            echo "<p>" . get_the_excerpt() .  "</p>";
            echo "</a>";
            endif ;
            endforeach;
            echo "</div>";
            ?>
            
        </div>
<?php endif; ?>

<?php 
    the_posts_pagination();
?>

</section>

<?php get_footer(); ?>