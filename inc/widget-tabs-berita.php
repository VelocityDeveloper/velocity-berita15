<?php
/**
 * WIDGET TABS BERITA 6
 */
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class Tabs_Berita_6_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'tabs_berita_6_widget',
            __('Berita 6 Tabs', 'velocity'),
            array( 'description' => __( 'Menampilkan tabs template berita 6', 'velocity' ), )
        );
    }

    public function form( $instance ) {
        $title      = ! empty( $instance['title'] ) ? $instance['title'] : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Judul:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

        return $instance;
    }
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );

        echo $args['before_widget'];

            if ( ! empty( $title ) ) {
                echo $args['before_title'] . $title . $args['after_title'];
            }

            ?>

            <ul class="nav nav-tabs p-0" style="font-size:.75rem;" id="widgetberitaTabs" role="tablist" style="border-bottom: 0.2rem solid var(--color-theme);">
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-0 mb-0 bg-light active" id="wb-popular-tab" data-bs-toggle="tab" data-bs-target="#wb-tab-popular" type="button" role="tab" aria-controls="wb-tab-popular" aria-selected="true">
                        POPULAR
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-0 mb-0 mx-1 bg-light" id="wb-comments-tab" data-bs-toggle="tab" data-bs-target="#wb-tab-comments" type="button" role="tab" aria-controls="wb-tab-comments" aria-selected="false">
                        COMMENTS
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-0 mb-0 bg-light" id="wb-tags-tab" data-bs-toggle="tab" data-bs-target="#wb-tab-tags" type="button" role="tab" aria-controls="wb-tab-tags" aria-selected="false">
                        TAGS
                    </button>
                </li>
            </ul>
            <div class="tab-content pt-2" id="widgetberitaTabsContent">
                <div class="tab-pane fade show active" id="wb-tab-popular" role="tabpanel" aria-labelledby="wb-popular-tab" tabindex="0">
                    <?php
                    // The Query
                    $popular_query = new WP_Query(
                        array(
                            'post_type'         => 'post',
                            'posts_per_page'    => 3,
                            'meta_key'          => 'hit',
                            'orderby'           => 'meta_value_num',
                        )
                    );
                    // The Loop
                    if ($popular_query->have_posts()) {
                        echo '<div class="tabpopular-post-part">';
                            while ($popular_query->have_posts()) {
                                $popular_query->the_post();
                                echo '<div class="tabpopular-post-item border-bottom pb-2 mb-2">';                                    
                                    echo module_cardposts(1);
                                echo '</div>';
                            }
                        echo '</div>';
                    }
                    /* Restore original Post Data */
                    wp_reset_postdata();
                    ?>
                </div>
                <div class="tab-pane fade" id="wb-tab-comments" role="tabpanel" aria-labelledby="wb-comments-tab" tabindex="0">
                    <?php
                    // The Query
                    $postcomment_query = new WP_Query(
                        array(
                            'post_type'         => 'post',
                            'posts_per_page'    => 3,
                            'orderby'           => 'comment_count',
                            'order'             => 'DESC',
                        )
                    );
                    // The Loop
                    if ($postcomment_query->have_posts()) {
                        echo '<div class="tabcomment-post-part">';
                        while ($postcomment_query->have_posts()) {
                            $postcomment_query->the_post();
                            echo '<div class="tabcomment-post-item border-bottom pb-1 mb-1">';
                                echo '<div class="row">';
                                    echo '<div class="col-3 text-center">';
                                        echo '<div class="fst-italic text-muted">';
                                            echo '<div class="fw-bold">' . get_comments_number() . '</div>';
                                            echo '<small>Komentar</small>';
                                        echo '</div>';
                                    echo '</div>';
                                    echo '<div class="col">';
                                        echo '<a class="fw-bold" href="' . get_the_permalink() . '">' . get_the_title() . '</a>';
                                        echo '<div class="text-muted"><small>Posted on: ' . get_the_date() . '</small></div>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        }
                        echo '</div>';
                    }
                    /* Restore original Post Data */
                    wp_reset_postdata();
                    ?>
                </div>
                <div class="tab-pane fade" id="wb-tab-tags" role="tabpanel" aria-labelledby="berita-tab" tabindex="0">
                    <?php
                    $tags = get_tags(array(
                        'orderby'   => 'count',
                        'order'     => 'DESC',
                        'number'    => 8,
                    ));
                    echo '<div class="tabpost_tags">';
                    foreach ($tags as $tag) {
                        $tag_link = get_tag_link($tag->term_id);

                        echo "<a href='{$tag_link}' title='{$tag->name} Tag' class='btn btn-sm btn-dark me-1 mb-1 bg-color-theme rounded-0'>";
                        echo "{$tag->name}</a>";
                    }
                    echo '</div>';
                    ?>
                </div>
            </div>

            <?php

        echo $args['after_widget'];
    }

}

function register_Tabs_Berita_6_Widget() {
    register_widget( 'Tabs_Berita_6_Widget' );
}
add_action( 'widgets_init', 'register_Tabs_Berita_6_Widget' );