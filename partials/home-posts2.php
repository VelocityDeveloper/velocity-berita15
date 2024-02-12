<?php
$post2_title    = velocitytheme_option('title_posts_home_2', 'Recent Posts');
$post2_cat      = velocitytheme_option('cat_posts_home_2');
?>
<div class="widget position-relative part_posts_home_1">

    <h3 class="heading-theme position-relative"> 
        <span>    
            <?php if ($post2_title && $post2_title !== 'disable') : ?>
                <a style="color: inherit;" href="<?php echo get_tag_link($post2_cat); ?>">
                    <?php echo $post2_title; ?>
                </a>
            <?php else: ?>
                <?php echo $post2_title; ?>
            <?php endif; ?>
        </span>   
    </h3>
    <div class="part-post-home-2">
        <?php
        $post2_args = array(
            'post_type'     => 'post',
            'cat'           => $post2_cat,
            'posts_per_page' => 4,
        );
        // The Query
        $n2 = 1;
        $post2query = new WP_Query($post2_args);
        $count2 = $post2query->post_count;
        if ($post2query->have_posts()) {
            echo '<div class="row g-3">';
            while ($post2query->have_posts()) {
                $post2query->the_post();

                if($n2 == 1){                   
                    echo '<div class="col-md-7">';
                    echo module_cardposts(5);
                    echo '</div>';
                }

                if($n2 == 2){
                    echo '<div class="col-md-5">';
                }

                if($n2 > 1){
                    echo '<div class="mb-2 mb-md-3">';
                    echo module_cardposts(1);
                    echo '</div>';
                }

                $n2++;
            }
            if($count2 > 1){
                echo '</div>';
            }
            echo '</div>';
        }
        /* Restore original Post Data */
        wp_reset_postdata();
        ?>
    </div>
</div>