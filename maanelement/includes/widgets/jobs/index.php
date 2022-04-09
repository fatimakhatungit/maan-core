<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class maan_jobs extends Widget_Base {

   public function get_name() {
      return 'maan-jobs';
   }

   public function get_title() {
      return __( 'Maan Jobs', 'maan' );
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
                'label' => __( 'Jobs', 'maan' ),
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
                'options' => ae_drop_cat('jobpost_category'),
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
                'options' => ae_drop_posts('jobpost'),
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
                    '{{WRAPPER}} .part-single .part-single-content ul li .part-icon h5' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ttih',
                'label' => __( 'Title Typography', 'maan' ),
                'selector' => '{{WRAPPER}} .part-single .part-single-content ul li .part-icon h5',
            ]
        );
        $this->add_control(
            'post_in_color',
            [
                'label' => __( 'Info Color', 'maan' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ecp-yrr' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ttihii',
                'label' => __( 'Info Typography', 'maan' ),
                'selector' => '{{WRAPPER}} .ecp-yrr',
            ]
        );
        $this->add_control(
            'btn',
            [
                'label' => __( 'Button Color', 'maan' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-10' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btnbg',
            [
                'label' => __( 'Button BG Color', 'maan' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-10' => 'background-color: {{VALUE}}',
                ],
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
                'post_type' => 'jobpost',
                'posts_per_page' => $per_page,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'jobpost_category',
                        'field' => 'term_id',
                        'terms' => $cat,
                    ) ,
                ) ,
            );
        }

        if($settings['query_type'] == 'individual'){
            $query_args = array(
                'post_type' => 'jobpost',
                'posts_per_page' => $per_page,
                'post__in' =>$id,
                'orderby' => 'post__in'
            );
        }

        $wp_query = new \WP_Query($query_args);

            echo '<!-- Start part
		============================================= -->
		<div class="part-area">
			
				<div class="part-wpr">';
                        if( $wp_query->have_posts() ) {
                            while( $wp_query->have_posts() ) {
                                $wp_query->the_post();
                echo '<div class="part-single wow fadeInLeft">
						<div class="part-single-content">
							<ul>
								<li>
									<div class="part-icon">
										<i>'.get_the_post_thumbnail().'</i>
										<h5 class="mb-0">' . get_the_title() . '</h5>
									</div>
								</li>
								<li><span class="ecp-yrr">Location <br /> '; sjb_the_job_location(); echo '</span></li>
								<li><span class="ecp-yrr">Deadline <br /> '; printf(sjb_get_the_job_posting_time()); echo '</span></li>
								<li>
									<div class="part-right-bt">
										<a href="'.get_the_permalink().'" class="btn-10">
											<i class="fas fa-arrow-right"></i>
										</a>
									</div>
								</li>
							</ul>
						</div>
					</div>';
                        }
                        wp_reset_postdata();
                       }
                echo'</div>
		</div>
		<!-- End Part -->';
    }
    protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register_widget_type( new maan_jobs() );
?>