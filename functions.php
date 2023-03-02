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
      'rubrique' => null
		),
    $atts
	);

  ob_start();
  ?>

  <div class="carousel-wrapper">

    <ul class="slides-container" id="slides-container">
      <li class="slide"></li>
      <li class="slide"></li>
      <li class="slide"></li>
      <li class="slide"></li>
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
