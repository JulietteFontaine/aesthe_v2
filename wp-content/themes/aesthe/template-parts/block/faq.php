<?php

/**
 * Block Name: Faq

 *
 *
 */

if (is_admin()) : echo "<div style=\"width: 100%; padding: 20px 20px;text-align: center;font-size: 10px;background: #eee\">Faq (cliquer pour modifier)</div>";
else : ?>

        <section class="faq faq--<?= $block['id'] ?>">
                    <h2 class="title-uppercase">F.A.Q <?php the_field("faq_title") ?></h2>
                <ul class="faq__list">
                    <?php
                    if (have_rows('faq_fields')) :
                        while (have_rows('faq_fields')) : the_row();
                            echo "<li>";
                            echo "<h3 class='question'>";
                            echo get_sub_field('faq_question');
                            echo "</h3>";
                            echo "<div class='answer'>";
                            echo get_sub_field('faq_answer');
                            echo "</div>";
                            echo "</li>";
                        endwhile;
                    endif;
                    ?>
                </ul>
        </section>
<?php endif ?>