<?php
$post6_title    = velocitytheme_option('title_posts_home_6', 'Recent Posts');
$post6_cat      = velocitytheme_option('cat_posts_home_6');
?>
<div class="widget position-relative part_posts_home_6">

    <h3 class="heading-theme position-relative"> 
        <span>    
            <?php if ($post6_title && $post6_title !== 'disable') : ?>
                <a style="color: inherit;" href="<?php echo get_tag_link($post6_cat); ?>">
                    <?php echo $post6_title; ?>
                </a>
            <?php else: ?>
                <?php echo $post6_title; ?>
            <?php endif; ?>
        </span>   
    </h3>
    <div class="part-post-home-3">
        <?php
        $post6_args = array(
            'post_type'     => 'post',
            'cat'           => $post6_cat,
            'posts_per_page' => 3,
        );
        // The Query
        $n2 = 1;
        $post2query = new WP_Query($post6_args);
        $count2 = $post2query->post_count;
        if ($post2query->have_posts()) {
            echo '<div class="bg-light p-3">';
            while ($post2query->have_posts()) {
                $post2query->the_post();
                 
                echo '<div class="border-bottom pb-2 mb-2">';
                    the_title(
                        sprintf('<h2 class="fs-6 fw-bold"><a href="%s" rel="bookmark">', esc_url(get_permalink())),
                        '</a></h2>'
                    );
                    echo '<small>'.vdberita_limit_text(strip_tags(get_the_excerpt()), 15).'</small>';
                echo '</div>';

                $n2++;
            }
            echo '</div>';
        }
        /* Restore original Post Data */
        wp_reset_postdata();
        ?>
    </div>
</div>