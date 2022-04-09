<?php
/*
Plugin Name: Maan Core
Plugin URI: https://maantheme.com/
Description: Maan Core.
Author: Maan Theme
Author URI: https://maantheme.com/
Version: 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) exit;
define( 'MAAN_VERSION', '1.0.0' );
define( 'MAAN_PLUG_DIR', dirname(__FILE__).'/' );
define('MAAN_PLUG_URL', plugin_dir_url(__FILE__));
define('MAAN_DEMO_FILES', plugin_dir_url(__FILE__). 'vendor/demo/data/xml/');
define('MAAN_DEMO_SLIDER', plugin_dir_path(__FILE__). 'vendor/demo/data/xml/');

function cs_framework_init_check() {

    if( ! function_exists( 'cs_framework_init' ) && ! class_exists( 'CSFramework' ) ) {
         
          require_once MAAN_PLUG_DIR .'/vendor/codestar-framework/codestar-framework.php';
          require_once MAAN_PLUG_DIR .'/vendor/configstar/customiser.php';
          require_once MAAN_PLUG_DIR .'/vendor/configstar/pagemeta.php';
          require_once MAAN_PLUG_DIR . '/vendor/configstar/servicemeta.php';
          require_once MAAN_PLUG_DIR .'/vendor/configstar/profile.php';
          require_once MAAN_PLUG_DIR .'/vendor/configstar/taxonomy.php';
          require_once MAAN_PLUG_DIR .'/vendor/configstar/downloadmeta.php';
          require_once MAAN_PLUG_DIR .'/vendor/admin-pages/admin.php';
          require_once MAAN_PLUG_DIR .'/vendor/edd/index.php';
          require_once MAAN_PLUG_DIR . '/vendor/demo/includes/demo-importer.php';

    }
 
    if( ! class_exists( 'MaanElement_Elementor_Addons' ) ) {
        require_once MAAN_PLUG_DIR .'/maanelement/index.php';
        require_once MAAN_PLUG_DIR. '/helper/customiser-extra.php';
        require_once MAAN_PLUG_DIR. '/helper/cpt.php';
    }

}

add_action( 'plugins_loaded', 'cs_framework_init_check' );

function maanelement_footer_select($type='') {

        $type = $type ? $type :'elementor_library';
        global $post;
        $args = array('numberposts' => -1,'post_type' => $type,);
        $posts = get_posts($args);  
        $categories = array(
        ''  => __( 'Select', 'maan' ),
        );
        foreach ($posts as $pn_cat) {
            $categories[$pn_cat->ID] = get_the_title($pn_cat->ID);
        }
        return $categories;   
}


if (class_exists('ELEMENTOR')){
    add_action( 'template_redirect', function() {
        $instance = \Elementor\Plugin::$instance->templates_manager->get_source( 'local' );
        remove_action( 'template_redirect', [ $instance, 'block_template_frontend' ] );
    }, 9 );
}
?>