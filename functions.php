<?php
/**
 * Thème enfant  - fichier function.php
 * Nom raccourcis : wct (wp-child-theme)
 */

/**
 * Chargement des fichiers CSS et de scripts
 */
add_action( 'wp_enqueue_scripts', 'wct_enqueue_styles' );
function wct_enqueue_styles() {

    // Parent thème style
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

    // Enfant thème style
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ) );

    // Fichiers de scripts
    wp_enqueue_script( 'child-style', get_stylesheet_directory_uri().'/scripts.js' );

}

/**
 * Shortcode Carousel
 */
function wct_carousel( $atts ) {

	// Attributes
	$atts = shortcode_atts(
		array(
      'slides' => null
		),
    $atts
	);

  ob_start();
  $images = get_post_meta( $atts["slides"], 'Image' );
  ?>

  <div class="carousel-wrapper">

    <ul class="slides-container" id="slides-container">
      <?php foreach ($images as $key => $value) : ?>
      <li class="slide"><?php echo $value ?></li>
      <?php endforeach; ?>
    </ul>

    <button class="slide-arrow" id="slide-arrow-prev">
      &#8249;
    </button>
    <button class="slide-arrow" id="slide-arrow-next">
      &#8250;
    </button>

  </div>

  <?php
	return ob_get_clean();
}
add_shortcode( 'wct_carousel', 'wct_carousel' );

/**
 * Custom post type : Slides
 */
function wct_cpt() {
	$labels = array(
		'name'                => "Slide",
		'singular_name'       => "Slides",
    'add_new_item' => 'Ajouter un slide',
    'edit_item' => 'Modifier un slide',
    'menu_name' => 'Slides'
	);
	$args = array(
		'label'               =>"Slide",
		'description'         => "Slides",
		'labels'              => $labels,
    'public' => true,
    'show_in_rest' => true,
    'has_archive' => true,
    'supports' => array( 'title', 'custom-fields' ),
		'capability_type'     => 'page',
    'menu_position' => 5,
    'menu_icon' => 'dashicons-admin-customizer',
	);
	register_post_type('slide', $args);
}

add_action('init', 'wct_cpt', 10);

/**
 * Désactiver Guttenberg dans certains CPT
 */
function wct_disable_gutenberg($current_status, $post_type) {
  if ($post_type === 'slide') return false;
  return $current_status;
}
add_filter('use_block_editor_for_post_type', 'wct_disable_gutenberg', 10, 2);
