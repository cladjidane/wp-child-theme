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


}

