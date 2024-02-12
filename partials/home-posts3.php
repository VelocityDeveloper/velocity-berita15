<?php
$post3_title    = velocitytheme_option('title_posts_home_3', 'Recent Posts');
$post3_cat      = velocitytheme_option('cat_posts_home_3');
?>
<div class="widget position-relative part_posts_home_3">

    <h3 class="heading-theme position-relative"> 
        <span>    
            <?php if ($post3_title && $post3_title !== 'disable') : ?>
                <a style="color: inherit;" href="<?php echo get_tag_link($post3_cat); ?>">
                    <?php echo $post3_title; ?>
                </a>
            <?php else: ?>
                <?php echo $post3_title; ?>
            <?php endif; ?>
        </span>   
    </h3>
    <div class="part-post-home-3">
        <?php
        $post3_args = array(
            'post_type'     => 'post',
            'cat'           => $post3_cat,
            'posts_per_page' => 6,
        );
        // The Query
        $n2 = 1;
        $post2query = new WP_Query($post3_args);
        $count2 = $post2query->post_count;
        if ($post2query->have_posts()) {
            echo '<div class="row g-2 align-items-stretch">';
            while ($post2query->have_posts()) {
                $post2query->the_post();
                 
                echo '<div class="col-md-6">';
                    echo '<div class="border h-100 p-3">';
                    echo module_cardposts(4);
                    echo '</div>';
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