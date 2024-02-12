<?php
$post1_title    = velocitytheme_option('title_posts_home_1', 'Recent Posts');
$post1_cat      = velocitytheme_option('cat_posts_home_1');
?>
<div class="widget position-relative part_posts_home_1">

    <h3 class="position-relative h5 border-top border-secondary border-5">
        <span class="position-absolute z-1 rounded-0 badge bg-secondary top-0 start-0">
            <?php echo $post1_title; ?>
        </span>
    </h3>
    <div class="part-post-home-1">
        <?php
        $post1_args = array(
            'post_type'     => 'post',
            'cat'           => $post1_cat,
            'posts_per_page' => 4,
        );
        // The Query
        $post1query = new WP_Query($post1_args);
        if ($post1query->have_posts()) {
            echo '<div class="row g-2">';
            while ($post1query->have_posts()) {
                $post1query->the_post();
                echo '<div class="col-6">';
                echo module_cardposts(3);
                echo '</div>';
            }
            echo '</div>';
        }
        /* Restore original Post Data */
        wp_reset_postdata();
        ?>
    </div>
</div>