<?php /* Template Name: Page */ ?>

<?php 
get_header();
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <section class="gutenbergSection  wrapper">
        <?php get_template_part( 'template-parts/breadcrumb' ); ?>
            <?php the_content(); ?>

        </section>
<?php endwhile;

endif;
?>

<?php 
get_footer(); 
?>