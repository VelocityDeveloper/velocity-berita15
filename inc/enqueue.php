<?php
/**
 * Enqueue child theme styles and scripts.
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Load the parent style.css file
 *
 * @link http://codex.wordpress.org/Child_Themes
 */
if (!function_exists('justg_child_enqueue_parent_style')) {
    function justg_child_enqueue_parent_style()
    {
        // Dynamically get version number of the parent stylesheet (lets browsers re-cache your stylesheet when you update your theme)
        $parenthandle = 'parent-style';
        $theme = wp_get_theme();

        // Load the stylesheet
        wp_enqueue_style(
            $parenthandle,
            get_template_directory_uri() . '/style.css',
            array(),  // if the parent theme code has a dependency, copy it to here
            $theme->parent()->get('Version')
        );

        // Font Roboto 400 (dulu dimuat Kirki lewat tipografi tema induk).
        wp_enqueue_style('velocity-berita15-roboto', 'https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap', array(), null);

        // Slick hanya dipakai carousel Posts Home 4 di beranda.
        if (is_front_page() || is_home()) {
            wp_enqueue_style('slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css', array(), '1.8.1');
            wp_enqueue_script('slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array('jquery'), '1.8.1', true);
        }

        $css_version = $theme->parent()->get('Version') . '.' . filemtime(get_stylesheet_directory() . '/css/custom.css');
        wp_enqueue_style(
            'custom-style',
            get_stylesheet_directory_uri() . '/css/custom.css',
            array(),  // if the parent theme code has a dependency, copy it to here
            $css_version
        );

        // Dimuat sesudah CSS tema induk (justg-styles) supaya skala ukuran lama berlaku.
        wp_enqueue_style(
            'velocity-berita15-skala',
            get_stylesheet_directory_uri() . '/css/skala.css',
            array('justg-styles'),
            $theme->get('Version') . '.' . filemtime(get_stylesheet_directory() . '/css/skala.css')
        );

        wp_enqueue_style(
            'child-style',
            get_stylesheet_uri(),
            array($parenthandle),
            $theme->get('Version')
        );

        $js_version = $theme->parent()->get('Version') . '.' . filemtime(get_stylesheet_directory() . '/js/custom.js');
        wp_enqueue_script('justg-custom-scripts', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), $js_version, true);
    }
    // Prioritas bawaan (10): urutan CSS sama seperti versi lama, tampilan tidak bergeser.
    add_action('wp_enqueue_scripts', 'justg_child_enqueue_parent_style');
}
