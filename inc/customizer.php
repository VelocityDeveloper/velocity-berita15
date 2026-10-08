<?php

/**
 * Pengaturan Berita 15 di Customizer bawaan WordPress (tanpa Kirki).
 *
 * Nama theme mod sama dengan versi Kirki (color_theme, image_iklan_*, link_iklan_*,
 * link_sosmed_*, title_posts_home_*, cat_posts_home_*, cat_bigcarousel_home) supaya nilai
 * yang sudah tersimpan tetap terbaca sesudah tema diperbarui.
 * Warna latar memakai pengaturan Background tema induk.
 */
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/** Warna bawaan tema (bawaan field Kirki color_theme versi lama). */
define('VELOCITY_BERITA15_WARNA', '#20c1eb');

/**
 * Slot iklan yang dipanggil template: id => [label, keterangan ukuran]. Slot tanpa gambar tidak tampil.
 * Ukuran "WxH" di keterangan dibaca installer untuk membuat banner "Ruang Iklan" seukuran slot.
 */
function velocity_berita15_slot_iklan()
{
	return array(
		'iklan_header'    => array('Iklan Header', 'Iklan di bawah menu 728x90'),
		'iklan_home_1'    => array('Iklan Home 1', 'Iklan Halaman Depan 840x100'),
		'iklan_home_2'    => array('Iklan Home 2', 'Iklan Halaman Depan 650x70'),
		'iklan_home_3'    => array('Iklan Home 3', 'Iklan Halaman Depan 1000x100'),
		'iklan_content'   => array('Iklan Single', 'Iklan atas judul artikel 840x100'),
		'iklan_content_2' => array('Iklan Single 2', 'Iklan atas gambar artikel 840x100'),
		'iklan_content_3' => array('Iklan Single 3', 'Iklan samping isi artikel 150x500'),
		'iklan_archive'   => array('Iklan Archive', 'Iklan Arsip sesudah artikel ke-1 840x100'),
		'iklan_archive_2' => array('Iklan Archive 2', 'Iklan Arsip sesudah artikel ke-8 840x100'),
	);
}

/** Sosial media: id => [label, warna tombol]. Link kosong = ikon disembunyikan. */
function velocity_berita15_sosmed()
{
	return array(
		'facebook'  => array('Facebook', '#2d59a1'),
		'twitter'   => array('Twitter / X', '#079be3'),
		'instagram' => array('Instagram', '#e72283'),
		'youtube'   => array('YouTube', '#dd2c26'),
	);
}

/** Blok berita beranda: id => label. */
function velocity_berita15_blok()
{
	return array(
		'bigcarousel_home' => 'Slider Utama',
		'posts_home_1'     => 'Posts Home 1 (samping slider)',
		'posts_home_2'     => 'Posts Home 2',
		'posts_home_3'     => 'Posts Home 3 (daftar judul)',
		'posts_home_4'     => 'Posts Home 4 (carousel)',
		'posts_home_5'     => 'Posts Home 5 (kolom kiri)',
		'posts_home_6'     => 'Posts Home 6 (kolom kanan)',
	);
}

function velocity_berita15_sanitize_kategori($value)
{
	$value = (string) $value;
	return ($value !== '' && term_exists((int) $value, 'category')) ? (string) absint($value) : '';
}

add_action('customize_register', 'velocity_berita15_customize_register', 20);
function velocity_berita15_customize_register(WP_Customize_Manager $wp_customize)
{
	$wp_customize->add_panel('panel_berita', array(
		'priority' => 10,
		'title'    => esc_html__('Berita', 'justg'),
	));

	// Warna.
	$wp_customize->add_section('section_colorberita', array(
		'panel'       => 'panel_berita',
		'title'       => esc_html__('Warna', 'justg'),
		'description' => esc_html__('Kosongkan untuk memakai warna utama tema (Primary Color) atau warna bawaan tema. Warna latar diatur di Background.', 'justg'),
		'priority'    => 10,
	));
	$wp_customize->add_setting('color_theme', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_theme', array(
		'label'   => esc_html__('Warna Tema', 'justg'),
		'section' => 'section_colorberita',
	)));

	// Iklan.
	$wp_customize->add_section('section_iklanberita', array(
		'panel'       => 'panel_berita',
		'title'       => esc_html__('Iklan', 'justg'),
		'description' => esc_html__('Slot tanpa gambar tidak ditampilkan.', 'justg'),
		'priority'    => 20,
	));
	foreach (velocity_berita15_slot_iklan() as $id => $slot) {
		$wp_customize->add_setting('image_' . $id, array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		));
		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'image_' . $id, array(
			'label'       => sprintf(esc_html__('Gambar %s', 'justg'), $slot[0]),
			'description' => $slot[1],
			'section'     => 'section_iklanberita',
		)));
		$wp_customize->add_setting('link_' . $id, array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		));
		$wp_customize->add_control('link_' . $id, array(
			'type'    => 'url',
			'label'   => sprintf(esc_html__('Link %s', 'justg'), $slot[0]),
			'section' => 'section_iklanberita',
		));
	}

	// Sosial media.
	$wp_customize->add_section('section_sosmedberita', array(
		'panel'       => 'panel_berita',
		'title'       => esc_html__('Sosial Media', 'justg'),
		'description' => esc_html__('Kosongkan link untuk menyembunyikan ikonnya.', 'justg'),
		'priority'    => 30,
	));
	foreach (velocity_berita15_sosmed() as $id => $sosmed) {
		$wp_customize->add_setting('link_sosmed_' . $id, array(
			'default'           => 'https://' . $id . '.com/',
			'sanitize_callback' => 'esc_url_raw',
		));
		$wp_customize->add_control('link_sosmed_' . $id, array(
			'type'    => 'url',
			'label'   => sprintf(esc_html__('Link %s', 'justg'), $sosmed[0]),
			'section' => 'section_sosmedberita',
		));
	}

	// Blok berita beranda.
	$wp_customize->add_section('section_homeberita', array(
		'panel'       => 'panel_berita',
		'title'       => esc_html__('Home', 'justg'),
		'description' => esc_html__('Judul kosong = nama kategori yang dipilih (tanpa kategori: Recent Posts).', 'justg'),
		'priority'    => 40,
	));

	$kategori = array('' => esc_html__('Semua Kategori (terbaru)', 'justg'));
	foreach (get_categories(array('hide_empty' => false, 'exclude' => array(1))) as $term) {
		$kategori[(string) $term->term_id] = $term->name;
	}

	foreach (velocity_berita15_blok() as $id => $label) {
		if ('bigcarousel_home' !== $id) {
			$wp_customize->add_setting('title_' . $id, array(
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			));
			$wp_customize->add_control('title_' . $id, array(
				'type'    => 'text',
				'label'   => sprintf(esc_html__('Judul %s', 'justg'), $label),
				'section' => 'section_homeberita',
			));
		}
		$wp_customize->add_setting('cat_' . $id, array(
			'default'           => '',
			'sanitize_callback' => 'velocity_berita15_sanitize_kategori',
		));
		$wp_customize->add_control('cat_' . $id, array(
			'type'    => 'select',
			'label'   => sprintf(esc_html__('Kategori %s', 'justg'), $label),
			'section' => 'section_homeberita',
			'choices' => $kategori,
		));
	}
}

/**
 * Warna tema: pilihan Customizer Berita, lalu Primary Color induk (diisi installer dari
 * warna klien), lalu warna bawaan tema.
 */
function velocity_berita15_warna()
{
	$warna = sanitize_hex_color((string) get_theme_mod('color_theme', ''));
	if (!$warna) {
		$utama = sanitize_hex_color((string) get_theme_mod('primary_color', ''));
		$warna = ($utama && strtolower($utama) !== '#1e73be') ? $utama : VELOCITY_BERITA15_WARNA;
	}
	return $warna;
}

add_action('wp_head', 'velocity_berita15_css_warna', 100);
function velocity_berita15_css_warna()
{
	printf(
		'<style id="velocity-berita15-warna">:root{--color-theme:%1$s;}.border-color-theme{--bs-border-color:%1$s;}.bg-color-theme{background-color:%1$s;}'
		// Tipografi dasar yang dulu dicetak Kirki.
		. 'body{font-family:Roboto,Arial,Helvetica,sans-serif;font-size:14px;font-weight:400;line-height:1.5;}</style>' . "\n",
		esc_attr(velocity_berita15_warna())
	);
}

/** URL gambar iklan; Kirki lama bisa menyimpan id lampiran atau array. */
function velocity_berita15_url_gambar($nilai)
{
	if (is_numeric($nilai)) {
		return (string) wp_get_attachment_url((int) $nilai);
	}
	if (is_array($nilai)) {
		$nilai = isset($nilai['url']) ? $nilai['url'] : (isset($nilai['id']) ? wp_get_attachment_url((int) $nilai['id']) : '');
	}
	return (string) $nilai;
}

/**
 * Id kategori blok untuk WP_Query ('' = semua kategori).
 * Pilihan "Nonaktifkan" versi Kirki ('disable') pada praktiknya menampilkan semua kategori.
 */
function velocity_berita15_kategori($id)
{
	$cat = get_theme_mod('cat_' . $id, '');
	$cat = is_array($cat) ? (string) reset($cat) : (string) $cat;
	return ($cat === '' || !term_exists((int) $cat, 'category')) ? '' : (string) absint($cat);
}

/**
 * Judul blok: isian Customizer, lalu nama kategori yang dipilih, lalu "Recent Posts"
 * (judul bawaan versi lama).
 */
function velocity_berita15_judul($id)
{
	$judul = trim((string) get_theme_mod('title_' . $id, ''));
	if ($judul !== '') {
		return $judul;
	}
	$cat  = velocity_berita15_kategori($id);
	$term = ($cat !== '') ? get_term((int) $cat, 'category') : null;
	return ($term && !is_wp_error($term)) ? $term->name : 'Recent Posts';
}

/** Kepala blok beranda: judul, menjadi link ke arsip kategori bila kategori dipilih. */
function velocity_berita15_kepala_blok($id)
{
	$cat   = velocity_berita15_kategori($id);
	$judul = esc_html(velocity_berita15_judul($id));
	echo '<h3 class="heading-theme position-relative"><span>';
	echo ($cat !== '') ? '<a href="' . esc_url(get_category_link((int) $cat)) . '">' . $judul . '</a>' : $judul;
	echo '</span></h3>';
}

/** Argumen WP_Query blok beranda. */
function velocity_berita15_query_blok($id, $jumlah)
{
	return array(
		'post_type'           => 'post',
		'cat'                 => velocity_berita15_kategori($id),
		'posts_per_page'      => $jumlah,
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	);
}
