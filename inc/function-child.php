<?php

/**
 * Fuction yang digunakan di theme ini.
 */
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

add_action('after_setup_theme', 'velocitychild_theme_setup', 9);

function velocitychild_theme_setup()
{

	// Pengaturan Customizer ada di inc/customizer.php (tanpa Kirki).

	//remove action from Parent Theme
	remove_action('justg_header', 'justg_header_menu');
	remove_action('justg_do_footer', 'justg_the_footer_open');
	remove_action('justg_do_footer', 'justg_the_footer_content');
	remove_action('justg_do_footer', 'justg_the_footer_close');

}

add_action( 'after_setup_theme', 'childtheme_formats', 11 );
function childtheme_formats() {
	add_theme_support(
		'post-formats',
		array(
			'aside', 
			'gallery',
			'image',
			'video',
			'quote',
			'link',
		)
	);
}

///add action builder part
add_action('justg_header', 'justg_header_berita');
function justg_header_berita()
{
	require_once(get_stylesheet_directory() . '/inc/part-header.php');
}
add_action('justg_do_footer', 'justg_footer_berita');
function justg_footer_berita()
{
	require_once(get_stylesheet_directory() . '/inc/part-footer.php');
}

if (!function_exists('justg_right_sidebar_check')) {
    /**
     * Right sidebar check
     * 
     */
    function justg_right_sidebar_check()
    {
        $sidebar_pos            = velocitytheme_option('justg_sidebar_position', 'right');
        $pages_sidebar_pos      = velocitytheme_option('justg_pages_sidebar_position');
        $singular_sidebar_pos   = velocitytheme_option('justg_blogs_sidebar_position');
        $archives_sidebar_pos   = velocitytheme_option('justg_archives_sidebar_position');
        $shop_sidebar_pos       = velocitytheme_option('justg_shop_sidebar_position', 'default');

        if ($sidebar_pos === 'disable') {
            return;
        }

        if (is_page() && !in_array($pages_sidebar_pos, array('', 'default'))) {
            $sidebar_pos = $pages_sidebar_pos;
        }

        if (is_singular() && !in_array($singular_sidebar_pos, array('', 'default'))) {
            $sidebar_pos = $singular_sidebar_pos;
        }

        if (is_archive() && !in_array($archives_sidebar_pos, array('', 'default'))) {
            $sidebar_pos = $archives_sidebar_pos;
        }

        if (is_singular('fl-builder-template')) {
            return;
        }

        if ('right' === $sidebar_pos) {
            if (!is_active_sidebar('main-sidebar') && !has_action('justg_before_main_sidebar') && !has_action('justg_after_main_sidebar')) {
                return;
            }

        ?>
            <div class="widget-area right-sidebar col-sm-4 order-3" id="right-sidebar" role="complementary">
                <?php do_action('justg_before_main_sidebar'); ?>
                <?php dynamic_sidebar('main-sidebar'); ?>
                <?php do_action('justg_after_main_sidebar'); ?>
            </div>
            <?php
        }
    }
}

function get_berita_iklan($idiklan)
{
	$iklan_content = velocity_berita15_url_gambar(get_theme_mod('image_' . $idiklan, ''));
	echo '<div class="part_' . esc_attr($idiklan) . ' berita_iklan">';
	if ($iklan_content) {
		$linkiklan = get_theme_mod('link_' . $idiklan, '');
		echo '<div class="mb-3 text-center position-relative">';
		echo $linkiklan ? '<a href="' . esc_url($linkiklan) . '" target="_blank" rel="noopener">' : '';
		echo '<img class="img-fluid" src="' . esc_url($iklan_content) . '" alt="' . esc_attr__('Iklan', 'justg') . '" loading="lazy" decoding="async">';
		echo $linkiklan ? '</a>' : '';
		echo '<button type="button" class="close_berita_iklan position-absolute top-0 end-0 btn btn-link btn-sm" aria-label="' . esc_attr__('Tutup iklan', 'justg') . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16" aria-hidden="true"> <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/> </svg></button>';
		echo '</div>';
	}
	echo '</div>';
}

function vdberita_limit_text($text, $limit)
{
	if (str_word_count($text, 0) > $limit) {
		$words = str_word_count($text, 2);
		$pos   = array_keys($words);
		$text  = substr($text, 0, $pos[$limit]) . '...';
	}
	return $text;
}

// Penghitung tayangan (meta hit). Velocity Addons yang statistiknya aktif sudah menghitungnya sendiri.
function tambahkan_hit_ke_post_meta()
{
	if (!is_single() || class_exists('Velocity_Addons_Statistic')) {
		return;
	}
	$post_id = get_the_ID();
	update_post_meta($post_id, 'hit', (int) get_post_meta($post_id, 'hit', true) + 1);
}
add_action('wp_footer', 'tambahkan_hit_ke_post_meta');

function justg_get_hit() {
	echo (int) get_post_meta(get_the_ID(), 'hit', true);
}

function justg_get_sosmed() {
	foreach (velocity_berita15_sosmed() as $key => $sosmed) {
		$datalink = get_theme_mod('link_sosmed_' . $key, 'https://' . $key . '.com/');
		if ($datalink) {
			echo '<a class="btn border-0 btn-sm me-1 btn-secondary" style="--bs-btn-bg:' . esc_attr($sosmed[1]) . ';min-width:1.75rem;" href="' . esc_url($datalink) . '" target="_blank" rel="noopener" aria-label="' . esc_attr($sosmed[0]) . '"><i class="fa fa-' . esc_attr($key) . '" aria-hidden="true"></i></a>';
		}
	}
}

/**
 * Tombol bagikan. justg_share() pindah dari tema induk ke Velocity Addons 2.x; situs dengan
 * induk baru + Addons lama tetap mendapat tombol bagikan dari fungsi ini.
 */
function velocity_berita15_share()
{
	if (function_exists('justg_share')) {
		return justg_share();
	}
	$url    = rawurlencode(get_permalink());
	$judul  = rawurlencode(get_the_title());
	$tujuan = array(
		'facebook' => array('Facebook', '#2d59a1', 'https://www.facebook.com/sharer/sharer.php?u=' . $url),
		'twitter'  => array('Twitter', '#14171a', 'https://twitter.com/intent/tweet?text=' . $judul . '&url=' . $url),
		'whatsapp' => array('WhatsApp', '#25d366', 'https://wa.me/?text=' . $judul . '%20' . $url),
		'telegram' => array('Telegram', '#0088cc', 'https://t.me/share/url?url=' . $url . '&text=' . $judul),
		'envelope' => array('Email', '#444444', 'mailto:?subject=' . $judul . '&body=' . $url),
	);
	$html = '<div class="berita-share">';
	foreach ($tujuan as $ikon => $t) {
		$html .= '<a class="btn btn-sm text-white rounded-0 me-1 mb-1" style="background:' . esc_attr($t[1]) . '" href="' . esc_url($t[2]) . '" target="_blank" rel="noopener" aria-label="' . esc_attr($t[0]) . '"><i class="fa fa-' . esc_attr($ikon) . '" aria-hidden="true"></i></a>';
	}
	return $html . '</div>';
}

add_action( 'widgets_init', 'justgberita15_widgets_init', 55 );

if ( ! function_exists( 'justgberita15_widgets_init' ) ) {
	/**
	 * Initializes themes widgets.
	 */
	function justgberita15_widgets_init() {

		// Register footer widget area
		for ($x = 1; $x <= 4; $x++) {
			
			register_sidebar(
				array(
					'name'          => __( 'Home Widget Area '.$x.'', 'justg' ),
					'id'            => 'home-widget-'.$x,
					'description'   => __( '', 'justg' ),
					'before_widget' => '<aside id="%1$s" class="mb-3 widget %2$s">',
					'after_widget'  => '</aside>',
					'before_title'  => '<h3 class="widget-title"><span>',
					'after_title'   => '</span></h3>',
				)
			);

		}

	}
} // End of function_exists( 'justgberita15_widgets_init' ).

