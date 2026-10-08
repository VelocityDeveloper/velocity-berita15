<div class="widget position-relative part_posts_home_3">

    <?php velocity_berita15_kepala_blok('posts_home_3'); ?>
    <div class="part-post-home-3">
        <?php
        $post3query = new WP_Query(velocity_berita15_query_blok('posts_home_3', 6));
        if ($post3query->have_posts()) {
            echo '<div class="row g-2 align-items-stretch">';
            while ($post3query->have_posts()) {
                $post3query->the_post();
                echo '<div class="col-md-6">';
                echo '<div class="border h-100 p-3">';
                module_cardposts(4);
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
        }
        wp_reset_postdata();
        ?>
    </div>
</div>
