<div class="widget position-relative part_posts_home_1">

    <h3 class="position-relative h5 border-top border-secondary border-5">
        <span class="position-absolute z-1 rounded-0 badge bg-secondary top-0 start-0">
            <?php echo esc_html(velocity_berita15_judul('posts_home_1')); ?>
        </span>
    </h3>
    <div class="part-post-home-1">
        <?php
        $post1query = new WP_Query(velocity_berita15_query_blok('posts_home_1', 4));
        if ($post1query->have_posts()) {
            echo '<div class="row g-2">';
            while ($post1query->have_posts()) {
                $post1query->the_post();
                echo '<div class="col-6">';
                module_cardposts(3);
                echo '</div>';
            }
            echo '</div>';
        }
        wp_reset_postdata();
        ?>
    </div>
</div>
