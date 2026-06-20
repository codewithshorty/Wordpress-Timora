<?php
function register_testimonial_post_type()
{
    $labels = array(
        'name'                  => _x('Testimonials', 'Post type general name', 'testimonial'),
        'singular_name'         => _x('Testimonial', 'Post type singular name', 'testimonial'),
        'menu_name'             => _x('Testimonials', 'Admin Menu text', 'testimonial'),
        'name_admin_bar'        => _x('Testimonial', 'Add New on Toolbar', 'testimonial'),
        'add_new'               => __('Add New', 'testimonial'),
        'add_new_item'          => __('Add New testimonial', 'testimonial'),
        'new_item'              => __('New testimonial', 'testimonial'),
        'edit_item'             => __('Edit testimonial', 'testimonial'),
        'view_item'             => __('View testimonial', 'testimonial'),
        'all_items'             => __('All recipes', 'testimonial'),
        'search_items'          => __('Search recipes', 'testimonial'),
        'parent_item_colon'     => __('Parent recipes:', 'testimonial'),
        'not_found'             => __('No recipes found.', 'testimonial'),
        'not_found_in_trash'    => __('No recipes found in Trash.', 'testimonial'),
        'featured_image'        => _x('Testimonial Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'testimonial'),
        'set_featured_image'    => _x('Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'testimonial'),
        'remove_featured_image' => _x('Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'testimonial'),
        'use_featured_image'    => _x('Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'testimonial'),
        'archives'              => _x('Testimonial archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'testimonial'),
        'insert_into_item'      => _x('Insert into testimonial', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'testimonial'),
        'uploaded_to_this_item' => _x('Uploaded to this testimonial', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'testimonial'),
        'filter_items_list'     => _x('Filter recipes list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'testimonial'),
        'items_list_navigation' => _x('Testimonials list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'testimonial'),
        'items_list'            => _x('Testimonials list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'testimonial'),
    );
    $args = array(
        'labels'             => $labels,
        'description'        => 'Testimonial custom post type.',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'testimonial'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'menu_icon'          => "dashicons-admin-tools",
        'supports'           => array('title', 'editor', 'author', 'thumbnail'),
        'taxonomies'         => array('category', 'post_tag'),
        'show_in_rest'       => true
    );

    register_post_type('testimonial', $args);
}
