<?php

	class maan_custom_post_type {

		function __construct() {

			add_action('init', array(&$this,'maan_builder_post_type'));
			add_action('init', array(&$this,'create_builder_post_taxonomy'));
            add_action('init', array(&$this, 'create_services_cpt'));
            add_action('init', array(&$this, 'services_taxonomy'), 0);
            add_action('init', array(&$this, 'create_features_cpt'));
            add_action('init', array(&$this, 'features_taxonomy'), 0);
        }
	  // Builder Post Type
		function maan_builder_post_type() {
        $labels = array(
            'name' => __('Maan Builder', 'maan'),
            'singular_name' => __('Maan Builder', 'maan'),
            'add_new' => __('Add builder', 'maan'),
            'add_new_item' => __('Add builder', 'maan'),
            'edit_item' => __('Edit builder', 'maan'),
            'new_item' => __('New builder', 'maan'),
            'all_items' => __('All builder', 'maan'),
            'view_item' => __('View builder', 'maan'),
            'search_items' => __('Search builder', 'maan'),
            'not_found' => __('No builder found', 'maan'),
            'not_found_in_trash' => __('No portfolio found in the trash', 'maan'),
            'parent_item_colon' => '',
            'menu_name' => __('Maan Theme Builder', 'maan')
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'menu_position' => 4,
            'menu_icon' => 'dashicons-admin-multisite',
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt','elementor'),
            'has_archive' => false,
        );
            register_post_type('maan_builders', $args);
        }

        function create_builder_post_taxonomy() {
            $labels = array(
                'name' => __('Category', 'maan'),
                'singular_name' => __('Category', 'maan'),
                'search_items' => __('Search categories', 'maan'),
                'all_items' => __('Categories', 'maan'),
                'parent_item' => __('Parent category', 'maan'),
                'parent_item_colon' => __('Parent category:', 'maan'),
                'edit_item' => __('Edit category', 'maan'),
                'update_item' => __('Update category', 'maan'),
                'add_new_item' => __('Add category', 'maan'),
                'new_item_name' => __('New category', 'maan'),
                'menu_name' => __('Category', 'maan'),
            );
            $args = array(
                'labels' => $labels,
                'hierarchical' => true,
                'show_ui' => true,
                'show_admin_column' => true,
                'rewrite' => array('slug' => 'maan_builder_cat'),
            );
            register_taxonomy('maan_builder_cat', 'maan_builders', $args);
        }
        // Services Post type
        function create_services_cpt() {
            $labels = array(
                'name' => __('Service', 'maan'),
                'singular_name' => __('Service', 'maan'),
                'add_new' => __('Add service', 'maan'),
                'add_new_item' => __('Add service', 'maan'),
                'edit_item' => __('Edit service', 'maan'),
                'new_item' => __('New service', 'maan'),
                'all_items' => __('All service', 'maan'),
                'view_item' => __('View service', 'maan'),
                'search_items' => __('Search service', 'maan'),
                'not_found' => __('No service found', 'maan'),
                'not_found_in_trash' => __('No portfolio found in the trash', 'maan'),
                'parent_item_colon' => '',
                'supports' => array('post-formats'),
                'menu_name' => __('Services', 'maan')
            );
            $args = array(
                'labels' => $labels,
                'public' => true,
                'menu_position' => 5,
                'menu_icon' => 'dashicons-megaphone',
                'taxonomies' => array('service_category'),
                'supports' => array('title', 'editor', 'thumbnail', 'excerpt','elementor'),
                'has_archive' => true,
            );
            register_post_type('services', $args);
        }

        function services_taxonomy() {
            $labels = array(
                'name' => __('Category', 'maan'),
                'singular_name' => __('Category', 'maan'),
                'search_items' => __('Search categories', 'maan'),
                'all_items' => __('Categories', 'maan'),
                'parent_item' => __('Parent category', 'maan'),
                'parent_item_colon' => __('Parent category:', 'maan'),
                'edit_item' => __('Edit category', 'maan'),
                'update_item' => __('Update category', 'maan'),
                'add_new_item' => __('Add category', 'maan'),
                'new_item_name' => __('New category', 'maan'),
                'menu_name' => __('Category', 'maan'),
            );
            $args = array(
                'labels' => $labels,
                'hierarchical' => true,
                'show_ui' => true,
                'show_admin_column' => true,
                'rewrite' => array('slug' => 'service_category'),
            );
            register_taxonomy('service_category', 'services', $args);
        }
        // Features Post type
        function create_features_cpt() {
            $labels = array(
                'name' => __('Feature', 'maan'),
                'singular_name' => __('Feature', 'maan'),
                'add_new' => __('Add feature', 'maan'),
                'add_new_item' => __('Add feature', 'maan'),
                'edit_item' => __('Edit feature', 'maan'),
                'new_item' => __('New feature', 'maan'),
                'all_items' => __('All feature', 'maan'),
                'view_item' => __('View feature', 'maan'),
                'search_items' => __('Search feature', 'maan'),
                'not_found' => __('No feature found', 'maan'),
                'not_found_in_trash' => __('No portfolio found in the trash', 'maan'),
                'parent_item_colon' => '',
                'supports' => array('post-formats'),
                'menu_name' => __('Features', 'maan')
            );
            $args = array(
                'labels' => $labels,
                'public' => true,
                'menu_position' => 6,
                'menu_icon' => 'dashicons-welcome-learn-more',
                'taxonomies' => array('feature_category'),
                'supports' => array('title', 'editor', 'thumbnail', 'excerpt','elementor'),
                'has_archive' => true,
            );
            register_post_type('features', $args);
        }

        function features_taxonomy() {
            $labels = array(
                'name' => __('Category', 'maan'),
                'singular_name' => __('Category', 'maan'),
                'search_items' => __('Search categories', 'maan'),
                'all_items' => __('Categories', 'maan'),
                'parent_item' => __('Parent category', 'maan'),
                'parent_item_colon' => __('Parent category:', 'maan'),
                'edit_item' => __('Edit category', 'maan'),
                'update_item' => __('Update category', 'maan'),
                'add_new_item' => __('Add category', 'maan'),
                'new_item_name' => __('New category', 'maan'),
                'menu_name' => __('Category', 'maan'),
            );
            $args = array(
                'labels' => $labels,
                'hierarchical' => true,
                'show_ui' => true,
                'show_admin_column' => true,
                'rewrite' => array('slug' => 'feature_category'),
            );
            register_taxonomy('feature_category', 'features', $args);
        }


    }

    new maan_custom_post_type();

