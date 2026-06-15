<?php
function register_services_post_type()
{
    $labels = array(
        'name'                  => _x('Services', 'Post type general name', 'service'),
        'singular_name'         => _x('Service', 'Post type singular name', 'service'),
        'menu_name'             => _x('Services', 'Admin Menu text', 'service'),
        'name_admin_bar'        => _x('Service', 'Add New on Toolbar', 'service'),
        'add_new'               => __('Add New', 'service'),
        'add_new_item'          => __('Add New service', 'service'),
        'new_item'              => __('New service', 'service'),
        'edit_item'             => __('Edit service', 'service'),
        'view_item'             => __('View service', 'service'),
        'all_items'             => __('All recipes', 'service'),
        'search_items'          => __('Search recipes', 'service'),
        'parent_item_colon'     => __('Parent recipes:', 'service'),
        'not_found'             => __('No recipes found.', 'service'),
        'not_found_in_trash'    => __('No recipes found in Trash.', 'service'),
        'featured_image'        => _x('Service Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'service'),
        'set_featured_image'    => _x('Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'service'),
        'remove_featured_image' => _x('Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'service'),
        'use_featured_image'    => _x('Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'service'),
        'archives'              => _x('Service archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'service'),
        'insert_into_item'      => _x('Insert into service', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'service'),
        'uploaded_to_this_item' => _x('Uploaded to this service', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'service'),
        'filter_items_list'     => _x('Filter recipes list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'service'),
        'items_list_navigation' => _x('Services list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'service'),
        'items_list'            => _x('Services list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'service'),
    );
    $args = array(
        'labels'             => $labels,
        'description'        => 'Service custom post type.',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'service'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'menu_icon'          => "dashicons-admin-tools",
        'supports'           => array('title', 'editor', 'author', 'thumbnail'),
        'taxonomies'         => array('category', 'post_tag'),
        'show_in_rest'       => true
    );

    register_post_type('Service', $args);
}
