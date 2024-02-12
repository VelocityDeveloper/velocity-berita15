<?php

/**
 * The template for displaying all single posts
 *
 * @package justg
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
$container  = velocitytheme_option('justg_container_type', 'container');
$format     = get_post_format() ?: 'standard';
?>

<div class="wrapper" id="single-wrapper">

	<div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

        <div class="border-start border-5 border-color-theme bg-light pt-2 px-3 mb-3" style="font-size: 0.8rem;">
            <?php echo justg_breadcrumb(); ?>
        </div>

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php do_action('justg_before_content'); ?>

			<main class="site-main" id="main">

				<?php

				while (have_posts()) {
					the_post();
                    ?>

                    <?php get_berita_iklan('iklan_content'); ?>

                    <?php the_title('<h1 class="entry-title h3 fw-bold">', '</h1>'); ?>

                    <div class="position-relative d-flex border-bottom border-2 pb-2 mt-2 mb-3">
                            <small>
                                Author by <?php echo get_the_author(); ?>
                            </small>
                            <span class="mx-2">|</span>
                            <small>
                                Post on <?php echo get_the_date(); ?>
                            </small>
                            
                            <?php 
                            $categories = get_the_terms( get_the_ID(), 'category' );
                            if ($categories) : ?>
                                <span class="mx-2">|</span>
                                <small>
                                    Category 
                                    <?php foreach ($categories as $index => $tag) : ?>
                                        <?php echo $index === 0 ? '' : ','; ?>
                                        <a href="<?php echo get_tag_link($tag->term_id); ?>"> <?php echo $tag->name; ?> </a>
                                        <?php if ($index > 1) {
                                            break;
                                        } ?>
                                    <?php endforeach; ?>
                                </small>
                            <?php endif; ?>
                    </div>

                    <div class="entry-content">

                        <?php get_berita_iklan('iklan_content_2'); ?>

                        <?php
                        if (has_post_thumbnail() && $format !== 'video' && $format !== 'gallery') {
                            echo '<div class="mb-3">';
                                echo get_the_post_thumbnail( get_the_ID(), 'full', array( 'class' => 'w-100' ) );
                                $featured_image_caption = get_the_post_thumbnail_caption(get_the_ID());
                                if($featured_image_caption){
                                    echo '<div class="text-muted fst-italic"><small>' . $featured_image_caption . '</small></div>';
                                }
                            echo '</div>';
                        }
                        ?>

                        <div class="row">
                            <div class="col-md-9 col-xl-10">

                                <?php the_content(); ?>
                            
                                <?php $gettags = get_the_tags(get_the_ID()); ?>
                                <?php if ($gettags) : ?>
                                    <div class="mt-2 mb-4">
                                        <?php foreach ($gettags as $index => $tag) : ?>
                                            <?php echo $index === 0 ? '' : ' '; ?>
                                            <a class="btn btn-dark btn-sm bg-color-theme border-0 rounded-0" href="<?php echo get_tag_link($tag->term_id); ?>"> <?php echo $tag->name; ?> </a>
                                            <?php if ($index > 1) {
                                                break;
                                            } ?>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                                

                                <?php
                                wp_link_pages(
                                    array(
                                        'before' => '<div class="page-links">' . __('Pages:', 'justg'),
                                        'after'  => '</div>',
                                    )
                                );
                                ?>

                            </div>
                            <div class="col-md-3 col-xl-2">
                                <div class="sticky-top d-none d-md-block">
                                    <?php get_berita_iklan('iklan_content_3'); ?>
                                </div>                              
                            </div>
                        </div>

                    </div><!-- .entry-content -->

                    <div class="single-post-nav border-top border-bottom py-2 my-3">
                        <div class="share-post">
                            <?php echo justg_share(); ?>
                        </div>
                        <div class="nav-post mt-2">
                            <div class="d-flex justify-content-between" aria-label="Navigation Post">
                                <?php
                                $prev_post = get_adjacent_post(false, '', true);
                                if (!empty($prev_post)) {
                                    echo '<a href="' . get_permalink($prev_post->ID) . '" class="btn btn-sm btn-light rounded-0 border" title="' . $prev_post->post_title . '">Prev</a>';
                                }
                                $next_post = get_adjacent_post(false, '', false);
                                if (!empty($next_post)) {
                                    echo '<a href="' . get_permalink($next_post->ID) . '" class="btn btn-sm btn-light rounded-0 border" title="' . $next_post->post_title . '">Next</a>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="mostview-post">
                        <h6 class="heading-theme mb-3"><span>RELATED POSTS</span></h6>
                        <div class="related-post-loop">
                            <?php                            
                            $categories = wp_get_post_categories(get_the_ID());
                            $category_ids = array();
                            foreach ($categories as $category) {
                                $category_ids[] = $category;
                            }
                            $post1_args = array(
                                'post_type'         => 'post',
                                'post__not_in'      => [get_the_ID()],
                                'posts_per_page'    => 4,
                                'category__in'      => $category_ids
                            );
                            // The Query
                            $the_query = new WP_Query($post1_args);
                            if ($the_query->have_posts()) {
                                echo '<div class="row g-3 align-items-stretch">';
                                while ($the_query->have_posts()) {
                                    $the_query->the_post();
                                    echo '<article class="col-md-6 col-xl-3">';
                                        echo '<div class="bg-light p-2 h-100">';
                                        echo module_cardposts(2);
                                        echo '</div>';
                                    echo '</article>';
                                }
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>

                    <?php
					// If comments are open or we have at least one comment, load up the comment template.
					if (comments_open() || get_comments_number()) {

						do_action('justg_before_comments');
						comments_template();
						do_action('justg_after_comments');
					}
				}
				?>

			</main><!-- #main -->

			<!-- Do the right sidebar check. -->
			<?php do_action('justg_after_content'); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php 
$post = get_post( get_the_ID() );
$previous_post = get_previous_post();
$previous_post = $previous_post->ID; 
$next_post = get_next_post();
$next_post = $next_post->ID; 

// The Query.
$the_recquery = new WP_Query( 
    array( 
        'post_type' => 'post',
        'post__not_in' => array(get_the_ID()),
        'posts_per_page'=> 2
    )  
);
?>

<?php if($the_recquery->have_posts()): ?>
    <div class="toast-container position-fixed bottom-0 start-0 p-3">
        <div class="toast show bg-white" data-bs-config='{"show":1}' role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Rekomendasi</strong>                
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body p-0">
                <?php
                echo '<ul class="list-group list-group-flush">';
                while ( $the_recquery->have_posts() ) {
                    $the_recquery->the_post();
                    echo '<li class="list-group-item">';                    
                    the_title(
                        sprintf('<a href="%s" rel="bookmark">', esc_url(get_permalink())),
                        '</a>'
                    );
                    echo '</li>';
                }
                echo '</ul>';
                // Restore original Post Data.
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>
<?php endif; ?>


<?php
get_footer();