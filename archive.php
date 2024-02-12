<?php

/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package justg
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = velocitytheme_option('justg_container_type', 'container');
?>

<div class="wrapper" id="archive-wrapper">

    <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

        <div class="border-start border-5 border-color-theme bg-light pt-2 px-3 mb-3" style="font-size: 0.8rem;">
            <?php echo justg_breadcrumb(); ?>
        </div>

        <div class="row">

            <!-- Do the left sidebar check -->
            <?php do_action('justg_before_content'); ?>

            <main class="site-main col order-2" id="main">

                <?php

                if (have_posts()) {
                ?>
                    <header class="page-header block-primary">
                        <?php
                        the_archive_title('<h1 class="page-title text-uppercase">', '</h1>');
                        the_archive_description('<div class="taxonomy-description border fw-light fst-italic bg-light d-block p-3 pb-1 mb-3"><small>', '</small></div>');
                        ?>
                    </header><!-- .page-header -->
                    <?php
                    // Start the loop.
                    $postcount = 1;
                    while (have_posts()) {
                        the_post();
                        ?>
                        <article <?php post_class('mb-4 border-bottom pb-3'); ?> id="post-<?php the_ID(); ?>">

                            <div class="row">
                                <div class="col-5 col-md-3 col-xl-2">
                                    <a href="<?php echo get_the_permalink(); ?>">
                                        <div class="ratio ratio-1x1 bg-light overflow-hidden">
                                            <?php echo get_the_post_thumbnail( get_the_ID(), 'thumbnail', array( 'class' => 'w-100' ) ); ?>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-7 col-md-9 col-xl-10">
                                    <?php 
                                    $categories = get_the_terms( get_the_ID(), 'category' );
                                    if ($categories) : ?>
                                        <a class="d-inline-block small mb-1 fw-bold" href="<?php echo get_term_link( $categories[0]->slug, 'category' );?>">
                                            <?php echo $categories[0]->name; ?>
                                        </a>
                                    <?php endif; ?>
                                    <?php
                                    the_title(
                                        sprintf('<h2 class="h5 mb-md-2"><a href="%s" rel="bookmark">', esc_url(get_permalink())),
                                        '</a></h2>'
                                    );
                                    ?>
                                    <div class="d-none d-md-block">
                                        <?php echo vdberita_limit_text(strip_tags(get_the_excerpt()), 25); ?>
                                    </div>
                                    <div class="mt-2 small opacity-50">
                                        <?php echo get_the_date(); ?>
                                    </div>
                                </div>
                            </div>                           

                        </article>

                        <?php

                        if ($postcount == 1) :
                            get_berita_iklan('iklan_archive');
                        endif;
                        if ($postcount == 8) :
                            get_berita_iklan('iklan_archive_2');
                        endif;

                        $postcount++;
                    }
                } else {
                    get_template_part('loop-templates/content', 'none');
                }
                ?>
                <!-- Display the pagination component. -->
                <?php justg_pagination(); ?>

            </main><!-- #main -->

            <!-- Do the right sidebar check. -->
            <?php do_action('justg_after_content'); ?>

        </div><!-- .row -->

    </div><!-- #content -->

</div><!-- #archive-wrapper -->

<?php
get_footer();
