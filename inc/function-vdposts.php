<?php
function module_cardposts($style){
    global $post;
    
    switch ($style) {
        case '1':
            echo '<div class="row g-2">';
                echo '<div class="col-4">';
                    echo '<a class="d-block ratio ratio-1x1 bg-light" href="'.get_the_permalink().'">';
                        echo get_the_post_thumbnail( get_the_ID(), 'thumbnail', array( 'class' => 'w-100' ) );
                    echo '</a>';
                echo '</div>';
                echo '<div class="col-7">';
                    echo '<a class="d-block mb-1" href="'.get_the_permalink().'">';
                        echo get_the_title();
                    echo '</a>';
                    echo '<small class="opacity-75">';
                        echo get_the_date();
                    echo '</small>';
                echo '</div>';
            echo '</div>';
            break;
        case '2':
            if (has_post_thumbnail()) :
                echo '<a class="d-block mb-2" href="'.get_the_permalink().'">';
                    echo '<div class="ratio ratio-16x9 bg-light">';
                        echo get_the_post_thumbnail( get_the_ID(), 'medium', array( 'class' => 'w-100' ) );
                    echo '</div>';
                echo '</a>';
            endif;
            echo '<div>';
                echo '<a class="d-block mb-1" href="'.get_the_permalink().'">';
                    echo get_the_title();
                echo '</a>';
                echo '<small class="opacity-75">';
                    echo get_the_date();
                echo '</small>';
            echo '</div>';
            break;
        case '3':
            echo '<div class="d-block position-relative overflow-hidden cardposts-3">';
                echo '<a class="ratio ratio-4x3 bg-light" href="'.get_the_permalink().'">';
                    echo get_the_post_thumbnail( get_the_ID(), 'medium', array( 'class' => 'w-100' ) );
                echo '</a>';
                echo '<div class="position-absolute bottom-0 end-0 start-0 p-2">';
                    echo '<a title="'.get_the_title().'" class="position-relative small z-1 text-white" href="'.get_the_permalink().'">' . vdberita_limit_text(get_the_title(),5) . '</a>';
                    echo '<div class="bg-dark opacity-50 position-absolute top-0 bottom-0 end-0 start-0"></div>';
                echo '</div>';
            echo '</div>';
            break;
        case '4':
            echo '<div class="posts-item d-flex">';
                echo '<div class="me-2">';
                    echo '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16"> <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/> </svg>';
                echo '</div>';
                echo '<a class="d-block" href="' . get_the_permalink() . '">' . get_the_title() . '</a>';
            echo '</div>';
            break;
        case '5':
            echo '<div class="position-relative">';
                echo '<div class="ratio ratio-4x3 bg-secondary">';
                    echo get_the_post_thumbnail( get_the_ID(), 'large', array( 'class' => 'w-100' ) );
                echo '</div>';
                echo '<div class="position-absolute end-0 start-0 bottom-0 p-3">';
                    echo '<div class="position-relative z-1">';
                        the_title(
                            sprintf('<h2 class="fs-6 m-0 fw-bold"><a href="%s" class="text-white" rel="bookmark">', esc_url(get_permalink())),
                            '</a></h2>'
                        );
                        echo '<small class="text-white opacity-75">'.get_the_date().'</small>';
                    echo '</div>';
                    echo '<div class="bg-dark opacity-50 position-absolute top-0 bottom-0 end-0 start-0"></div>';
                echo '</div>';
            echo '</div>';
            break;
        case '6':
            echo '<div class="bg-light shadow-sm p-3">';
                echo '<div class="row g-2">';
                    echo '<div class="col-4">';
                        echo '<div class="ratio ratio-1x1 bg-secondary">';
                        echo get_the_post_thumbnail( get_the_ID(), 'thumbnail', array( 'class' => 'w-100' ) );
                        echo '</div>';
                    echo '</div>';
                    echo '<div class="col-7">';
                        the_title(
                            sprintf('<div class="fw-bold"><a href="%s" rel="bookmark">', esc_url(get_permalink())),
                            '</a></div>'
                        );
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            break;
        default:
            echo '<div class="posts-item">';
            echo '<a href="' . get_the_permalink() . '">' . get_the_title() . '</a>';
            echo '</div>';
            break;
        }
}
