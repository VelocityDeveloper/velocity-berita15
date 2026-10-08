<div class="widget position-relative part_posts_home_6">

    <?php velocity_berita15_kepala_blok('posts_home_6'); ?>
    <div class="part-post-home-6">
        <?php
        $post6query = new WP_Query(velocity_berita15_query_blok('posts_home_6', 3));
        if ($post6query->have_posts()) {
            echo '<div class="bg-light p-3">';
            while ($post6query->have_posts()) {
                $post6query->the_post();
                echo '<div class="border-bottom pb-2 mb-2">';
                the_title(
                    sprintf('<h2 class="fs-6 fw-bold"><a href="%s" rel="bookmark">', esc_url(get_permalink())),
                    '</a></h2>'
                );
                echo '<small>' . esc_html(vdberita_limit_text(wp_strip_all_tags(get_the_excerpt()), 15)) . '</small>';
                echo '</div>';
            }
            echo '</div>';
        }
        wp_reset_postdata();
        ?>
    </div>
</div>
