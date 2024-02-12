<?php
$post5_title    = velocitytheme_option('title_posts_home_5', 'Recent Posts');
$post5_cat      = velocitytheme_option('cat_posts_home_5');
?>
<div class="widget position-relative part_posts_home_5">

    <h3 class="heading-theme position-relative"> 
        <span>    
            <?php if ($post5_title && $post5_title !== 'disable') : ?>
                <a style="color: inherit;" href="<?php echo get_tag_link($post5_cat); ?>">
                    <?php echo $post5_title; ?>
                </a>
            <?php else: ?>
                <?php echo $post5_title; ?>
            <?php endif; ?>
        </span>   
    </h3>
    <div class="part-post-home-5">
        <?php
        $post5_args = array(
            'post_type'     => 'post',
            'cat'           => $post5_cat,
            'posts_per_page' => 4,
        );
        // The Query
        $n2 = 1;
        $post2query = new WP_Query($post5_args);
        $count2 = $post2query->post_count;
        if ($post2query->have_posts()) {
            echo '<div>';
            while ($post2query->have_posts()) {
                $post2query->the_post();
                 
                echo '<div class="border-bottom pb-2 mb-2">';
                    echo module_cardposts(1);
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