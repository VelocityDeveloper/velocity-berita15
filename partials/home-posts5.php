<div class="widget position-relative part_posts_home_5">

    <?php velocity_berita15_kepala_blok('posts_home_5'); ?>
    <div class="part-post-home-5">
        <?php
        $post5query = new WP_Query(velocity_berita15_query_blok('posts_home_5', 4));
        if ($post5query->have_posts()) {
            echo '<div>';
            while ($post5query->have_posts()) {
                $post5query->the_post();
                echo '<div class="border-bottom pb-2 mb-2">';
                module_cardposts(1);
                echo '</div>';
            }
            echo '</div>';
        }
        wp_reset_postdata();
        ?>
    </div>
</div>
