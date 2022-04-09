<?php if ( ! defined( 'ABSPATH' )  ) { die; }

$prefix_page_opts = '_servicemeta';


CSF::createMetabox( $prefix_page_opts, array(
  'title'        => 'Service Options',
  'post_type'    => ['services'],
  'show_restore' => false,
  'theme'=> 'light',
) );

//
// Create a section
//
CSF::createSection( $prefix_page_opts, array(
  'title'  => 'Service Fields',
  'icon'   => 'fas fa-rocket',
  'fields' => array(
      array(
          'id'    => 'service_icon',
          'type'  => 'icon',
          'title' => 'Service Icon',
      ),
  )
) );

