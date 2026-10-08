<div class="widget position-relative part_posts_home_4">

    <?php velocity_berita15_kepala_blok('posts_home_4'); ?>
    <div class="part-post-home-4">
        <?php
        $post4query = new WP_Query(velocity_berita15_query_blok('posts_home_4', 6));
        if ($post4query->have_posts()) {
            echo '<div class="carousel-posthome-4">';
            while ($post4query->have_posts()) {
                $post4query->the_post();
                echo '<div class="item-posthome px-1 px-md-2">';
                echo '<div class="p-2 border">';
                module_cardposts(3);
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
        }
        wp_reset_postdata();
        ?>
    </div>
</div>
