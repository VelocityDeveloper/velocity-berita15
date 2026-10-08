<div class="widget position-relative part_posts_home_2">

    <?php velocity_berita15_kepala_blok('posts_home_2'); ?>
    <div class="part-post-home-2">
        <?php
        $post2query = new WP_Query(velocity_berita15_query_blok('posts_home_2', 4));
        if ($post2query->have_posts()) {
            $n2 = 1;
            echo '<div class="row g-3">';
            while ($post2query->have_posts()) {
                $post2query->the_post();
                if (1 === $n2) {
                    echo '<div class="col-md-7">';
                    module_cardposts(5);
                    echo '</div>';
                } else {
                    if (2 === $n2) {
                        echo '<div class="col-md-5">';
                    }
                    echo '<div class="mb-2 mb-md-3">';
                    module_cardposts(1);
                    echo '</div>';
                }
                $n2++;
            }
            if ($n2 > 2) {
                echo '</div>';
            }
            echo '</div>';
        }
        wp_reset_postdata();
        ?>
    </div>
</div>
