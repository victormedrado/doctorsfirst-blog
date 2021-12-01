<?php 
add_theme_support( 'post-thumbnails' );

add_image_size( '350x395', 350, 395, true );

add_image_size( '730x395', 730, 395, true );

add_image_size( '50x50', 50, 50, true );

function custom_excerpt_length( $length ) {
 return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length');

?>