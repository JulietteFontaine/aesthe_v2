<?php

    global $post;

    // echo "<bre>";
    // var_dump($post->post_type);
    // echo "</bre>";
    // wp_die();

    $current_post = $post;
    $breadcrumb_parents = [];
    // sort la liste un tableau du breadcrumb
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

    $numItems = count($breadcrumb_parents);
    $i = 0;

?>
    <!-- rajouter un if couleur not empty couleur else noir -->
    <section class="breadcrumbs <?= (get_field('lien')) ? '' : 'nocta' ?>">
        <nav class="bread-centered">
            <div style="color: <?= $couleur ?>" class="breadcrumb">
                <?php if ($post->post_type === "tech-meds") : ?>
                    <span><a href="https://aesthe.com/">Accueil</a></span>
                    <svg width="7" height="7" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="5" cy="5" r="5" fill="#5D23D0"/></svg>
                    <span><a href="https://aesthe.com/techniques-medicales/">Nos techniques</a></span>
                    <svg width="7" height="7" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="5" cy="5" r="5" fill="#5D23D0"/></svg>
                    <span><?= $post->post_title ?></span>
                <?php else : ?>
                    <a href="<?= get_home_url(); ?>/"><?php _e('Accueil') ?></a>
                    <?php foreach ($breadcrumb_parents as $parent) :
                        if (++$i === $numItems) : ?>
                            <svg width="7" height="7" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="5" cy="5" r="5" fill="#5D23D0"/></svg>
                            <span title="<?= $parent[0] ?>"><?= wp_trim_words($parent[0], 2) ?></span>
                        <?php else : ?>
        <svg width="5" height="5" viewBox="0 0 5 5" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 6C1.933 6 3.5 4.65685 3.5 3C3.5 1.34315 1.933 0 0 0V6Z" fill="#5D23D0" />
        </svg> <a title="<?= $parent[0] ?>" href="<?= $parent[1]; ?>"><?= wp_trim_words($parent[0], 2) ?></a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </nav>
    </section>