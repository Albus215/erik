<?php

// Function to create a custom post type for sliders
function create_slider_post_type() {
     // Registers a new post type in WordPress
    register_post_type('slider', // The post type key. Must be less than 20 characters
        array(
            'labels'      => array( 
                'name'          => __('Sliders'), // General name for the post type, usually plural
                'singular_name' => __('Slider'), // Name for one object of this post type
            ),
            'public'      => true, // Controls how the type is visible to authors and readers
            'has_archive' => true, // Enables post type archives. Will use $post_type as archive slug by default
            'supports'    => array('title', 'editor', 'thumbnail'), // Features this post type supports  
            'menu_icon'   => 'dashicons-images-alt2',  // Icon
        )
    );
}

// This action is used to define custom post types
add_action('init', 'create_slider_post_type');