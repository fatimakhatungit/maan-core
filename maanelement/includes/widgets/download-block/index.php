<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class maan_download_blok extends Widget_Base {

   public function get_name() {
      return 'maan-download-blok';
   }

   public function get_title() {
      return __( 'Maan Download Block', 'maan' );
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
                'label' => __( 'Download Block', 'maan' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'grid',
            [
                'label' => __('Download Grid', 'maan'),
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
                'options' => ae_drop_cat('download_category'),
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
                'options' => ae_drop_posts('download'),
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
                    '{{WRAPPER}} .work-title, .widget_block h2' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ttih',
                'label' => __( 'Title Typography', 'maan' ),
                'selector' => '{{WRAPPER}} .work-title, .widget_block h2',
            ]
        );
        $this->add_control(
            'post_in_color',
            [
                'label' => __( 'Meta Color', 'maan' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .work-box .work-desc .work-meta, 
                    {{WRAPPER}} .work-box .work-desc .work-btns ul' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ttihii',
                'label' => __( 'Meta Typography', 'maan' ),
                'selector' => '{{WRAPPER}} .work-box .work-desc .work-meta, 
                    {{WRAPPER}} .work-box .work-desc .work-btns ul',
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
                'post_type' => 'download',
                'posts_per_page' => $per_page,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'download_category',
                        'field' => 'term_id',
                        'terms' => $cat,
                    ) ,
                ) ,
            );
        }

        if($settings['query_type'] == 'individual'){
            $query_args = array(
                'post_type' => 'download',
                'posts_per_page' => $per_page,
                'post__in' =>$id,
                'orderby' => 'post__in'
            );
        }

        $wp_query = new \WP_Query($query_args);

        echo '<!-- Start Discover
		============================================= -->
		<div class="discover-area">
				<div class="discover-wpr">
					
                    <div class="discover-item grid-'.$settings['grid'].'">';
                        if( $wp_query->have_posts() ) {
                            while( $wp_query->have_posts() ) {
                                $wp_query->the_post();
                echo '<div class="work-box wow fadeInLeft">
                            <div class="work-pic">
                                '.get_the_post_thumbnail().'
                                 <a href="'.get_the_post_thumbnail_url().'" class="item work-popup popup-link">      <i class="fas fa-search"></i>
                                                </a>
                            </div>
                            <div class="work-desc">
                                <a href="theme-single.html">
                                    <h5 class="work-title">
                                        '.get_the_title().'
                                    </h5>
                                </a>
                                <div class="work-meta">
                                    <ul class="space-between">
                                        <li>By- <a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'">'.esc_html( get_the_author() ).'</a></li>
                                        <li>
                                            <div class="price-rating d-flex align-items-center">
                                                '.maan_avarage_rating().'
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="work-bottom space-between">
                                    <div class="work-price">
                                        <span class="value">';edd_price();echo'</span>
                                    </div>
                                    <div class="work-btns">
                                        <ul>
                                            <li>'.edd_get_total_sales().' Sale</li>
                                            <li><a href="'.get_the_permalink().'" class="btn-7">Preview</a></li>
                                             <li><a class="btn-cart" href="'.esc_url(home_url('/').'checkout?edd_action=add_to_cart&download_id='.get_the_ID()).'"><i class="fas fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>';
                        }
                        wp_reset_postdata();
                       }
                echo'</div>
				</div>
		</div>
		<!-- End Discover -->';
    }
    protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register_widget_type( new maan_download_blok() );
?>