<?php
function maan_welcome_page(){
    require_once 'maan-welcome.php';
}
function maan_demo_importer_function(){
    admin_url( 'admin.php?page=maan-demo-importer' );
}
add_action( 'admin_menu', 'maan_admin_meu' );
function maan_admin_meu() {
    // add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
    add_menu_page( 'Maan', 'Maan', 'administrator', 'maan-admin-menu', 'maan_welcome_page', 'dashicons-smiley', 2 );
    add_submenu_page('maan-admin-menu', 'Theme Options', 'Theme Options', 'manage_options', 'customize.php' );
    add_submenu_page( 'maan-admin-menu', esc_html__( 'Demo Importer', 'maan' ), esc_html__( 'Demo Importer', 'maan' ), 'administrator', 'maan-demo-importer',  'maan_demo_importer_function');
}