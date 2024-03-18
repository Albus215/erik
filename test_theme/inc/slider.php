<?php

// Defines a shortcode for a custom slider
function slider_shortcode() {

    // Setup query to fetch the latest 10 'slider' posts in descending order
    $args = array(
        'post_type' => 'slider', // Specifies the custom post type to query
        'posts_per_page' => 10,
        'order' => 'DESC', // Sets the order of posts
    );

    $query = new WP_Query($args);

     // Initializes the HTML for the slider, including Swiper container and navigation buttons
    $html = '
    <div class="swiper-buttons-wrapper">
            <div class="swiper-button-prev"></div> 
            <div class="swiper-button-next"></div> </div>
    <div class="swiper-container">
    <div class="swiper-wrapper">';

    // Check if there are any posts matching the query
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');

            // Constructs the HTML for each slide
            $html .= '<div class="swiper-slide" data-post-id="'.get_the_ID().'">'; // Includes a data attribute for the post ID
            $html .= '<div class="swiper-slide__img"><img src="' . esc_url($image_url) . '" alt="' . get_the_title() . '"></div>'; // The post's featured image
            $html .= '<h2>' . get_the_title() . '</h2>'; // The post's title
            $html .= '</div>';
        }
    }

    // Closes the swiper-wrapper and swiper-container divs and adds the swiper-pagination container
    $html .= '</div><div class="swiper-pagination"></div></div>';

    wp_reset_postdata();// Resets global $post object to avoid conflicts

    return $html; // Returns the constructed HTML for output
}

// Registers the shortcode in WordPress
add_shortcode('slider', 'slider_shortcode');