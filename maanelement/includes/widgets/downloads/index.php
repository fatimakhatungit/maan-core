<?php

namespace Elementor;

if (!defined('ABSPATH')) 
    exit; // Exit if accessed directly


class download_filter extends Widget_Base {

    public function get_name() {
        return 'download-filter';
    }
 
    public function get_title() {
        return __('Download Filter', 'maan');
    }

    public function get_icon() {
        return 'eicon-form-horizontal';
    }

    public function get_categories() {
        return ['maanelement-addons'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_content',
            [
                'label' => __('General', 'maan'),
            ]
        );

        $this->add_control(
            'cat',
            [
                'label' => __('Category', 'maan'),
                'type' => Controls_Manager::SELECT2,
                'options' => ae_drop_cat('download_category'),
                'label_block' => true,
                'multiple' => true,
            ]
        );
        $this->add_control(
            'show_cat',
            [
                'label' => esc_html__( 'Show Category', 'maan' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => esc_html__( '5', 'maan' ),
            ]
        );
        $this->add_control(
            'post_per',
            [
                'label' => esc_html__( 'Post Per Tab', 'maan' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => esc_html__( '5', 'maan' ),
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'maan' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Unique Theme', 'maan' ),
                'condition' => [
                    'layout' => ['layout2']
                ]
            ]
        );
        $this->add_control(
            'layout',
            [
                'label' => __( 'Layout', 'maan' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'layout1' => [
                        'title' => __( 'Layout 1', 'maan' ),
                        'icon' => 'eicon-checkbox',
                    ],
                    'layout2' => [
                        'title' => __( 'Layout 2', 'maan' ),
                        'icon' => 'eicon-image-box',
                    ],
                ],
                'default' => 'layout1',
                'toggle' => true,
            ]
        );
        $this->end_controls_section();
        
        $this->start_controls_section(
            'ttb',
            [
                'label' => __( 'Tab Title', 'maan' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ttc',
            [
                'label' => __( 'Title Color', 'maan' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mix-item-menu button' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'ttca',
            [
                'label' => __( 'Active Color', 'maan' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mix-item-menu button.active' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ttih',
                'label' => __( 'Title Typography', 'maan' ),
                'selector' => '{{WRAPPER}} .mix-item-menu button',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'tti',
            [
                'label' => __( 'Tab Item', 'maan' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ittc',
            [
                'label' => __( 'Title Color', 'maan' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .work-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ittih',
                'label' => __( 'Title Typography', 'maan' ),
                'selector' => '{{WRAPPER}} .work-title',
            ]
        );
        $this->add_control(
            'itatc',
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
                'name' => 'itatih',
                'label' => __( 'Meta Typography', 'maan' ),
                'selector' => '{{WRAPPER}} .work-box .work-desc .work-meta, 
                {{WRAPPER}} .work-box .work-desc .work-btns ul',
            ]
        );
        $this->end_controls_section();

    }
        
    protected function render(){

        $settings = $this->get_settings();
        $layout = $settings['layout'];
        include dirname(__FILE__) . '/'.$layout.'.php';
    }


}
Plugin::instance()->widgets_manager->register_widget_type( new download_filter() );