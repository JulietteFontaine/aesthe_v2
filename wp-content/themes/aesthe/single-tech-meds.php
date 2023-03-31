<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <!-- <h1 class="post-title"><?php the_title(); ?></h1> -->

        <section class="gutenbergSection  wrapper  single">
        <?php get_template_part( 'template-parts/breadcrumb' ); ?>
                <?php the_content(); ?>
        </section>
<?php endwhile;
endif; ?>

<?php
get_footer();
?>