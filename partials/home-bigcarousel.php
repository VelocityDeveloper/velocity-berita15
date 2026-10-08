<?php
$posts_query = new WP_Query(velocity_berita15_query_blok('bigcarousel_home', 5));
if ($posts_query->have_posts()) : ?>
<div class="carouselHome mb-4 part_bigcarousel_home">
    <div id="carouselHome" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php
            $nm = 0;
            while ($posts_query->have_posts()) :
                $posts_query->the_post(); ?>
                <div class="slideshow-post-item carousel-item<?php echo 0 === $nm ? ' active' : ''; ?>">
                    <a class="d-block position-relative" href="<?php the_permalink(); ?>">
                        <div class="ratio ratio-16x9 bg-light overflow-hidden">
                            <?php
                            if (has_post_thumbnail()) {
                                // Slide pertama tampil langsung (LCP), sisanya dimuat belakangan.
                                the_post_thumbnail('large', array(
                                    'class'         => 'w-100',
                                    'alt'           => the_title_attribute(array('echo' => false)),
                                    'loading'       => 0 === $nm ? 'eager' : 'lazy',
                                    'fetchpriority' => 0 === $nm ? 'high' : 'auto',
                                ));
                            } ?>
                        </div>
                        <div class="carousel-caption text-md-start text-center start-0 end-0 bottom-0 p-2 pb-3">
                            <span class="bg-color-theme d-inline-block p-2 px-md-3">
                                <?php the_title(); ?>
                            </span>
                        </div>
                    </a>
                </div>
                <?php
                $nm++;
            endwhile; ?>
        </div>
        <div class="carousel-indicators m-0 p-0">
            <?php for ($i = 0; $i < $nm; $i++) : ?>
                <button type="button" data-bs-target="#carouselHome" data-bs-slide-to="<?php echo $i; ?>"<?php echo 0 === $i ? ' class="active" aria-current="true"' : ''; ?> aria-label="<?php echo esc_attr(sprintf(__('Slide %d', 'justg'), $i + 1)); ?>"></button>
            <?php endfor; ?>
        </div>
    </div>
</div>
<?php
endif;
wp_reset_postdata();
