<?php
/**
 * Created by PhpStorm.
 * User: matthijs
 * Date: 25-05-18
 * Time: 11:05
 */

register_nav_menus( array(
    'top'    => __( 'Top Menu', 'twentyseventeen' ),
    'social' => __( 'Social Links Menu', 'twentyseventeen' ),
) );

function theme_styles(){
    wp_enqueue_style('main', get_template_directory_uri() . '/style.css', array(), rand(121,9999), 'all');
}

add_action('wp_enqueue_scripts()','theme_styles');

?>
