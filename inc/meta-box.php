<?php
// Add a meta box
function hrm_movie_add_custom_meta_box() {
    add_meta_box(
        'hrm_movie_custom_meta_box',      // ID
        __('Extra Post Info', 'hrm_movie'), // Title
        'hrm_movie_custom_meta_box_html', // Callback function
        'movie',                         // Screen (post, page, or custom post type)
        'side',                         // Context (normal, side, advanced)
        'default'                       // Priority
    );
}
add_action('add_meta_boxes', 'hrm_movie_add_custom_meta_box');

// Meta box HTML
function hrm_movie_custom_meta_box_html($post) {
    // Get existing value
    $subtitle = get_post_meta($post->ID, '_hrm_movie_english_name', true);
    $release_year = get_post_meta($post->ID, '_hrm_movie_release_year', true);

    // Add a nonce for security
    wp_nonce_field('hrm_movie_save_meta_box_data', 'hrm_movie_meta_box_nonce');
    ?>
    <p>
        <label for="hrm_movie_english_name"><?php _e('نام فیلم به انگلیسی:', 'hrm_movie'); ?></label><br>
        <input type="text" name="hrm_movie_english_name" id="hrm_movie_english_name" value="<?php echo esc_attr($subtitle); ?>" style="width:100%;">
    </p>
    <p>
        <label for="hrm_movie_release_year"><?php _e('تولید در سال:', 'hrm_movie'); ?></label><br>
        <input type="text" name="hrm_movie_release_year" id="hrm_movie_release_year" value="<?php echo esc_attr($release_year); ?>" style="width:100%;">
    </p>
    <?php
}



// Save meta box data
function hrm_movie_save_meta_box_data($post_id) {
    // Check if nonce is set and valid
    if (!isset($_POST['hrm_movie_meta_box_nonce']) ||
        !wp_verify_nonce($_POST['hrm_movie_meta_box_nonce'], 'hrm_movie_save_meta_box_data')) {
        return;
    }

    // Check for autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check user permissions
    if (isset($_POST['post_type']) && 'page' === $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return;
        }
    } else {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }

    // Save field value
    if (isset($_POST['hrm_movie_english_name'])) {
        update_post_meta($post_id, '_hrm_movie_english_name', sanitize_text_field($_POST['hrm_movie_english_name']));
    }
    if (isset($_POST['hrm_movie_release_year'])) {
        update_post_meta($post_id, '_hrm_movie_release_year', sanitize_text_field($_POST['hrm_movie_release_year']));
    }
}
add_action('save_post', 'hrm_movie_save_meta_box_data');
