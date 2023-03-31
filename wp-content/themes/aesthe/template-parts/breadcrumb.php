<?php

    global $post;

    $cat = get_the_category(get_queried_object_id());
    $color = "noir";
    foreach ($cat as $c) :
        if ($c->slug == "menu-blanc") :
            $color = "white";
        endif;
    endforeach;

    $current_post = $post;
    $breadcrumb_parents = [];
    // sort la liste un tableau du breadcrumb
    if(!empty($post)) :
    while ($current_post->post_parent) :
        $current_post->post_title;
        $breadcrumb_parents[] = array(
            $current_post->post_title,
            get_permalink($current_post->ID)
        );
        $current_post = get_post($current_post->post_parent);
    endwhile;

    $breadcrumb_parents[] = array(
        $current_post->post_title,
        get_permalink($current_post->ID)
    );

    $breadcrumb_parents = array_reverse($breadcrumb_parents);
    endif;
    
    $numItems = count($breadcrumb_parents);
    $i = 0;

?>
    <!-- rajouter un if couleur not empty couleur else noir -->
    <section class="breadcrumbs <?php if (is_front_page()) : echo "Accueil"; endif ?>">
        <nav class="bread-centered">
            <div style="color: <?= $color ?>" class="breadcrumb">
            <!-- Si pages d'une techniques medicales -->
                <?php if (!empty($post) && $post->post_type === "tech-meds") : ?>
                    <span><a href="https://aesthe.com/">Accueil</a></span>
                    <svg width="7" height="7" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="5" cy="5" r="5" fill="#5D23D0"/></svg>
                    <span><a href="https://aesthe.com/techniques-medicales/">Nos techniques</a></span>
                    <svg width="7" height="7" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="5" cy="5" r="5" fill="#5D23D0"/></svg>
                    <span><?= $post->post_title ?></span>
            <!-- Si page search -->
                    <?php  elseif (is_search()): ?>
                    <a href="<?= get_home_url(); ?>/"><?php _e('Aesthé') ?></a>
                    <svg width="7" height="7" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="5" cy="5" r="5" fill="#5D23D0"/></svg>
                    <span>Résultats de la recherche : <?= get_query_var('s') ?></span>
                 
                <?php else : ?>
                    <a href="<?= get_home_url(); ?>/"><?php _e('Accueil') ?></a>
                    <?php foreach ($breadcrumb_parents as $parent) :
                        if (++$i === $numItems) : ?>
                            <svg width="7" height="7" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="5" cy="5" r="5" fill="#5D23D0"/></svg>
                            <span title="<?= $parent[0] ?>"><?= wp_trim_words($parent[0], 3) ?></span>
                            <?php else : ?>
                                <svg width="7" height="7" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="5" cy="5" r="5" fill="#5D23D0"/></svg>
                                <a title="<?= $parent[0] ?>" href="<?= $parent[1]; ?>"><?= wp_trim_words($parent[0], 3) ?></a>        
                            <?php endif; ?>
                    <?php endforeach; ?>

                <?php endif; ?>
            </div>
        </nav>
    </section>


