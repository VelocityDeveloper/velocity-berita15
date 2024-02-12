
<div class="carouselHome mb-4">                        
    <?php
    // The Query
    $posts_query = new WP_Query(
        array(
            'post_type'         => 'post',
            'posts_per_page'    => 5,
        )
    );
    // The Loop
    $nm = 1;
    if ($posts_query->have_posts()) {
        echo '<div id="carouselHome" class="carousel slide carousel-fade" data-bs-ride="carousel">';
            echo '<div class="carousel-inner">';
            while ($posts_query->have_posts()) {
                $posts_query->the_post();
                ?>
                <div class="slideshow-post-item carousel-item  <?php echo ($nm == 1 ? 'active' : ''); ?>">
                    <a class="d-block position-relative" href="<?php echo get_the_permalink(); ?>">

                        <div class="ratio ratio-16x9 bg-light overflow-hidden">
                            <?php
                            if (has_post_thumbnail()) {
                                $img_atr = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                                echo '<img class="w-100" src="' . $img_atr[0] . '" alt="' . get_the_title() . '" loading="lazy">';
                            } ?>
                        </div>

                        <div class="carousel-caption text-md-start text-center start-0 end-0 bottom-0 p-2 pb-3">
                            <span class="bg-color-theme d-inline-block p-2 px-md-3" style="--bs-bg-opacity: 0.90;">
                                <?php echo get_the_title(); ?>
                            </span>
                        </div>

                    </a>
                </div>
                <?php
                $nm++;
            }
            $nm = 0;
            echo '</div>';
            echo '<div class="carousel-indicators m-0 p-0">';
            while ($posts_query->have_posts()) {
                $posts_query->the_post();
                echo '<button type="button" data-bs-target="#carouselHome" data-bs-slide-to="' . $nm . '" ' . ($nm == 0 ? 'class="active"' : '') . ' aria-current="true" aria-label="Slide ' . $nm . '"></button>';
                $nm++;
            }
            echo '</div>';
        echo '</div>';
    }
    /* Restore original Post Data */
    wp_reset_postdata();
    ?>
</div>