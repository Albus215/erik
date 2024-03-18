<?php


function load_post_content_by_ajax() {
    // Check if post_id is set and sanitize it by converting to integer
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    
    // Retrieve the post by its ID
    $post = get_post($post_id);

    // If the post exists, prepare the response data
    if ($post) {
        $response = array(
            'title' => get_the_title($post), // Get the post title
            'content' => apply_filters('the_content', $post->post_content), // Apply content filters and get the post content
        );
        wp_send_json_success($response); // Send success response with post data
    } else {
        wp_send_json_error('Post not found'); // Send error response if post not found
    }

    wp_die(); // Terminate AJAX execution and exit  
}

// Hook the function for logged-in users
add_action('wp_ajax_load_post_content', 'load_post_content_by_ajax');
// Hook the function for non-logged-in users
add_action('wp_ajax_nopriv_load_post_content', 'load_post_content_by_ajax');
