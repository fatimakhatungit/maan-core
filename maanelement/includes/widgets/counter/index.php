<?php

namespace Elementor;

if (!defined('ABSPATH')) 
    exit; // Exit if accessed directly


class maan_counter extends Widget_Base {

    public function get_name() {
        return 'maan-counter';
    }
 
    public function get_title() {
        return __('Maan Counter', 'maan');
    }

    public function get_icon() {
        return 'eicon-form-horizontal';
    }

    public function get_categories() {
        return ['maanelement-addons'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Counter', 'maan' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'slider_number',
            [
                'label' => __('Counter Grid', 'maan'),
                'type' => Controls_Manager::NUMBER,
                'default' => 4,
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'title',
            [
                'label' => __( 'Title', 'maan' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Happy Clients', 'maan' ),
            ]
        );
        $repeater->add_control(
            'count',
            [
                'label' => __( 'Count', 'maan' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 39,
            ]
        );
        $repeater->add_control(
            'suffix',
            [
                'label' => __( 'Suffix', 'maan' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'k', 'maan' ),
            ]
        );
        $repeater->add_control(
            'photo', [
                'label' => __( 'Photo', 'appilo' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'counter_list',
            [
                'label' => __( 'Counter List', 'maan' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => __( 'Happy Clients', 'maan' ),
                    ],
                    [
                        'title' => __( 'Happy Clients', 'maan' ),
                    ],
                    [
                        'title' => __( 'Happy Clients', 'maan' ),
                    ],
                    [
                        'title' => __( 'Happy Clients', 'maan' ),
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );
        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_settings',
            [
                'label' => __( 'General', 'maan' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'post_title_color',
            [
                'label' => __( 'Title Color', 'maan' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fun-fact .fun-desc .timer' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ttih',
                'label' => __( 'Title Typography', 'maan' ),
                'selector' => '{{WRAPPER}} .fun-fact .fun-desc .timer',
            ]
        );
        $this->add_control(
            'hh_c',
            [
                'label' => __( 'Content Color', 'maan' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fun-fact .fun-desc .medium' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ttihaa',
                'label' => __( 'Content Typography', 'maan' ),
                'selector' => '{{WRAPPER}} .fun-fact .fun-desc .medium',
            ]
        );
        $this->end_controls_section();

    }
        
    protected function render(){

        $settings = $this->get_settings();
      ?>

               <?php echo ' <!-- Start Counter 
		============================================= -->
		<div class="counter-area">
				<div class="counter-wpr grid-'.$settings['slider_number'].'">';
					if ($settings['counter_list']) {
					    foreach ($settings['counter_list'] as $counter) {
                            echo '<div class="fun-fact wow fadeInUp">
						<span class="fun-icon">
                            <i>
                                '.get_that_image($counter['photo']).'
                            </i>
                        </span>
						<div class="fun-desc">
							<p class="timer" data-count="'.$counter['suffix'].'"  data-to="'.$counter['count'].'" data-speed="3000">'.$counter['count'].'</p>
							<span class="medium">'.$counter['title'].'</span>
						</div>
					</div>';
                        }
                    }
				echo '</div>
		</div>
		<!-- End Counter -->
';
    }


}
Plugin::instance()->widgets_manager->register_widget_type( new maan_counter() );