<?php
function maan_import_files() {
    return array(
        array(
            'import_file_name'           => 'Home 1',
            //'categories'                 => array( 'App Landing' ),
            'import_file_url'            => trailingslashit( MAAN_DEMO_FILES ) . 'home-1/data.xml',
            'import_widget_file_url'     => trailingslashit( MAAN_DEMO_FILES ) . 'home-1/widget.wie',
            'import_customizer_file_url' => trailingslashit( MAAN_DEMO_FILES ) . 'home-1/options.dat',
            'import_preview_image_url'   => trailingslashit( MAAN_DEMO_FILES ).   'home-1/home1.jpg',
            'import_notice'              => __( 'All are set with one click demo import', 'maan' ),
            'preview_url'                => 'http://wp.themexriver.com/maan',
        ),
        array(
            'import_file_name'           => 'Home 2',
            //'categories'                 => array( 'App Landing' ),
            'import_file_url'            => trailingslashit( MAAN_DEMO_FILES ) . 'home-1/data.xml',
            'import_widget_file_url'     => trailingslashit( MAAN_DEMO_FILES ) . 'home-1/widget.wie',
            'import_customizer_file_url' => trailingslashit( MAAN_DEMO_FILES ) . 'home-1/options.dat',
            'import_preview_image_url'   => trailingslashit( MAAN_DEMO_FILES ).   'home-2/home2.jpg',
            'import_notice'              => __( 'All are set with one click demo import', 'maan' ),
            'preview_url'                => 'http://wp.themexriver.com/maan',
        ),
        array(
            'import_file_name'           => 'Home 3',
            //'categories'                 => array( 'App Landing' ),
            'import_file_url'            => trailingslashit( MAAN_DEMO_FILES ) . 'home-1/data.xml',
            'import_widget_file_url'     => trailingslashit( MAAN_DEMO_FILES ) . 'home-1/widget.wie',
            'import_customizer_file_url' => trailingslashit( MAAN_DEMO_FILES ) . 'home-1/options.dat',
            'import_preview_image_url'   => trailingslashit( MAAN_DEMO_FILES ).   'home-3/home3.jpg',
            'import_notice'              => __( 'All are set with one click demo import', 'maan' ),
            'preview_url'                => 'http://wp.themexriver.com/maan',
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'maan_import_files' );

// Before Import
function maan_clear_before_import() {
    global $wpdb;
    //delete posts
    $tables = ['commentmeta','comments','postmeta','posts','termmeta','terms','term_relationships','term_taxonomy'];

    foreach ( $tables as $table ) {
        $table  = $wpdb->prefix . $table;
        $wpdb->query( "TRUNCATE TABLE $table" );
    }
}
add_action( 'pt-ocdi/before_content_import', 'maan_clear_before_import' );

// After Import
function maan_after_import_setup($selected_import) {
    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );


    set_theme_mod( 'nav_menu_locations', array(
            'primary' => $main_menu->term_id, // replace 'main-menu' here with the menu location identifier from register_nav_menu() function
        )
    );

    // Assign front page and posts page (blog page).
    if ($selected_import['import_file_name'] == 'Home 1') {
        $front_page_id = get_page_by_title('Home Version 1');
    }elseif ($selected_import['import_file_name'] == 'Home 2'){
        $front_page_id = get_page_by_title('Home Version 2');
    }else{
        $front_page_id = get_page_by_title('Home Version 3');
    }
    $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );

//    if ( class_exists( 'RevSlider' )) {
//
//            $slider_array = array(
//                MAAN_DEMO_SLIDER . 'home-1/slider-8.zip',
//            );
//
//
//        $slider = new RevSlider();
//
//        foreach($slider_array as $filepath){
//            $slider->importSliderFromPost(true,true,$filepath);
//        }
//
//    }

}
add_action( 'pt-ocdi/after_import', 'maan_after_import_setup' );

//Personalize
function maan_plugin_page_setup( $default_settings ) {
    $default_settings['parent_slug'] = 'themes.php';
    $default_settings['page_title']  = esc_html__( 'Demo Importer' , 'maan' );
    $default_settings['menu_title']  = esc_html__( 'Demo Importer' , 'maan' );
    $default_settings['capability']  = 'import';
    $default_settings['menu_slug']   = 'maan-demo-importer';

    return $default_settings;
}
add_filter( 'pt-ocdi/plugin_page_setup', 'maan_plugin_page_setup' );

add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

function maan_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes','maan_mime_types');
