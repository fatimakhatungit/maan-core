<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class maan_services extends Widget_Base {

   public function get_name() {
      return 'maan-services';
   }

   public function get_title() {
      return __( 'Maan Services', 'maan' );
   }
    public function get_categories() {
		return [ 'maanelement-addons' ];
	}
   public function get_icon() { 
        return 'eicon-posts-group';
   }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Services', 'maan' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'grid',
            [
                'label' => __('Posts Grid', 'maan'),
                'type' => Controls_Manager::NUMBER,
                'default' => 3,
            ]
        );
        $this->add_control(
            'query_type',
            [
                'label' => __('Query type', 'maan'),
                'type' => Controls_Manager::SELECT,
                'default' => 'individual',
                'options' => [
                    'category' => __('Category', 'maan'),
                    'individual' => __('Individual', 'maan'),
                ],
            ]
        );

        $this->add_control(
            'cat_query',
            [
                'label' => __('Category', 'maan'),
                'type' => Controls_Manager::SELECT2,
                'options' => ae_drop_cat('service_category'),
                'multiple' => true,
                'label_block' => true,
                'condition' => [
                    'query_type' => 'category',
                ],
            ]
        );

        $this->add_control(
            'id_query',
            [
                'label' => __('Posts', 'maan'),
                'type' => Controls_Manager::SELECT2,
                'options' => ae_drop_posts('services'),
                'multiple' => true,
                'label_block' => true,
                'condition' => [
                    'query_type' => 'individual',
                ],
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Posts Per Page', 'maan'),
                'type' => Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );
        $this->add_control(
            'layout',
            [
                'label' => __( 'Layout', 'maan' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'service-box' => [
                        'title' => __( 'Layout 1', 'maan' ),
                        'icon' => 'eicon-checkbox',
                    ],
                    'service-box-2' => [
                        'title' => __( 'Layout 2', 'maan' ),
                        'icon' => 'eicon-image-box',
                    ],
                ],
                'default' => 'service-box',
                'toggle' => true,
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'content_sty',
            [
                'label' => __( 'Style', 'maan' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'post_title_color',
            [
                'label' => __( 'Title Color', 'maan' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-box .service-desc h5' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ttih',
                'label' => __( 'Title Typography', 'maan' ),
                'selector' => '{{WRAPPER}} .service-box .service-desc h5',
            ]
        );
        $this->add_control(
            'post_in_color',
            [
                'label' => __( 'Info Color', 'maan' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-box .service-desc p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ttihii',
                'label' => __( 'Info Typography', 'maan' ),
                'selector' => '{{WRAPPER}} .service-box .service-desc p',
            ]
        );
        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        $per_page = $settings['posts_per_page'];
        $cat = $settings['cat_query'];
        $id = $settings['id_query'];


        if($settings['query_type'] == 'category'){
            $query_args = array(
                'post_type' => 'services',
                'posts_per_page' => $per_page,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'service_category',
                        'field' => 'term_id',
                        'terms' => $cat,
                    ) ,
                ) ,
            );
        }

        if($settings['query_type'] == 'individual'){
            $query_args = array(
                'post_type' => 'services',
                'posts_per_page' => $per_page,
                'post__in' =>$id,
                'orderby' => 'post__in'
            );
        }

        $wp_query = new \WP_Query($query_args);

    echo '<!-- Start Services
		============================================= -->
        <div class="sevice-area">
                <div class="service-wpr grid-'.$settings['grid'].'">';
                        if( $wp_query->have_posts() ) {
                            while( $wp_query->have_posts() ) {
                                $wp_query->the_post();
                echo '<div class="'.$settings['layout'].' wow fadeInUp">
                        <div class="service-icon">
                            <i>'.get_the_post_thumbnail().'</i>
                        </div>
                        <div class="service-desc">
                            <h5 class="work-title"><a href="'.get_the_permalink().'">' . get_the_title() . '</a></h5>
                            <p class="mb-0">
                                ' . get_the_excerpt() . '
                            </p>
                        </div>
                    </div>';
                        }
                        wp_reset_postdata();
                       }
                echo'</div>
        </div>
        <!-- End Services -->
        ';
    }
    protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register_widget_type( new maan_services() );
?>