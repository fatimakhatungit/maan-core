<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


class maan_nav_builder extends Widget_Base {

    public function get_name() {
        return 'nav-builder';
    }

    public function get_title() {
        return __('Nav Menu Builder', 'maan');
    }

    public function get_icon() {
        return 'eicon-nav-menu';
    }

    public function get_categories() {
        return array('maan-header');
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Main Nav', 'maan' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'main_nav',
            [
                'label' => __('Main Menu', 'maan'),
                'type' => Controls_Manager::SELECT2,
                'options' =>  king_menu_select_choices(),
                'multiple' => false,
                'label_block' => true,
            ]
        );
        $this->add_control(
            'main_m_nav',
            [
                'label' => __('Mobile Menu', 'maan'),
                'type' => Controls_Manager::SELECT2,
                'options' =>  king_menu_select_choices(),
                'multiple' => false,
                'label_block' => true,
            ]
        );
        $this->add_responsive_control(
            'menu_align',
            [
                'label' => __( 'Menu Alignment', 'maan' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __( 'Left', 'maan' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'maan' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => __( 'Right', 'maan' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .maan-main-header.maan-nav-builder' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'menu_style',
            [
                'label' => __( 'Main Menu', 'maan' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'nav_color',
            [
                'label' => __( 'Color', 'maan' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header-nav-style .main-navigation-area ul > li a, {{WRAPPER}} .header-main-menu ul > .dropdown:before' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'nav_fonts',
                'label' => __( 'Typography', 'maan' ),
                'selector' => '{{WRAPPER}} .header-nav-style .main-navigation-area ul > li a',
            ]
        );
        $this->add_responsive_control(
            'sdpda',
            [
                'label' =>   esc_html__('Item Padding', 'thepack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .header-nav-style .main-navigation-area ul > li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'sdpd',
            [
                'label' =>   esc_html__('Item Margin', 'thepack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .header-nav-style .main-navigation-area ul > li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'sub_menu_style',
            [
                'label' => __( 'Sub Menu', 'maan' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'sub_color',
            [
                'label' => __( 'Color', 'maan' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header-main-menu ul > li .dropdown-menu > li > a' => 'color: {{VALUE}} !important',
                ],
            ]
        );
        $this->add_responsive_control(
            'sdpdaa',
            [
                'label' =>   esc_html__('Item Padding', 'thepack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .header-main-menu ul > li .dropdown-menu > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_control(
            'hsub_color',
            [
                'label' => __( 'Hover Color', 'maan' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header-main-menu ul > li .dropdown-menu > li > a:hover' => 'color: {{VALUE}} !important',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'sub_fonts',
                'label' => __( 'Typography', 'maan' ),
                'selector' => '{{WRAPPER}} .header-main-menu ul > li .dropdown-menu > li > a',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'sub_shadow',
                'label' => __( 'Shadow', 'maan' ),
                'selector' => '{{WRAPPER}} .header-main-menu ul > li .dropdown-menu',
            ]
        );
        $this->add_control(
            'droph',
            [
                'label' => __( 'DropDown Hover BG', 'maan' ),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'dropbgh',
                'label' => __( 'Main BG', 'maan' ),
                'types' => [ 'classic', 'gradient' ],
                'show_label' => true,
                'selector' => '{{WRAPPER}} .header-nav-style .main-navigation-area ul > li a:hover',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => __( 'Menu Border', 'maan' ),
                'selector' => '{{WRAPPER}} .header-main-menu ul > li .dropdown-menu li',
            ]
        );
        $this->add_responsive_control(
            'dropwi',
            [
                'label' => __( 'DropDown Width', 'maan' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .header-main-menu ul > li .dropdown-menu' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'drop',
            [
                'label' => __( 'DropDown BG', 'maan' ),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'dropbg',
                'label' => __( 'Main BG', 'maan' ),
                'types' => [ 'classic', 'gradient' ],
                'show_label' => true,
                'selector' => '{{WRAPPER}} .header-main-menu ul > li .dropdown-menu',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'droborder',
                'label' => __( 'Main Border', 'maan' ),
                'selector' => '{{WRAPPER}} .header-main-menu ul > li .dropdown-menu',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'mobile_style',
            [
                'label' => __( 'Mobile Menu', 'maan' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'm_color',
            [
                'label' => __( 'Main Color', 'maan' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .str-mobile_menu_content .str-mobile-main-navigation .navbar-nav > li a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'm_fonts',
                'label' => __( 'Main Typography', 'maan' ),
                'selector' => '{{WRAPPER}} .str-mobile_menu_content .str-mobile-main-navigation .navbar-nav > li a',
            ]
        );
        $this->add_control(
            's_color',
            [
                'label' => __( 'Sub Color', 'maan' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .str-mobile_menu_content .str-mobile-main-navigation .navbar-nav > li ul > li a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 's_fonts',
                'label' => __( 'Sub Typography', 'maan' ),
                'selector' => '{{WRAPPER}} .str-mobile_menu_content .str-mobile-main-navigation .navbar-nav > li ul > li a',
            ]
        );
        $this->add_control(
            'tgcolor',
            [
                'label' => __( 'Toggle Color', 'maan' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .str-mobile_menu_button' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'tgbg',
            [
                'label' => __( 'Mobile Menu BG', 'maan' ),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tbg',
                'label' => __( 'Main BG', 'maan' ),
                'types' => [ 'classic', 'gradient' ],
                'show_label' => true,
                'selector' => '{{WRAPPER}} .str-mobile_menu_content',
            ]
        );
        $this->end_controls_section();

    }
        
    protected function render() {

        $settings = $this->get_settings();

        $main_menu = $settings['main_nav'];
        $mobile_menu = $settings['main_m_nav'];

        ?>

<!-- Start of header section
	============================================= -->
<header class="maan-main-header maan-nav-builder">
        <div id="main-header" class="main-header-area header-nav-style">
            <div class="container">
                <div class="header-main-menu  clearfix">
                    <div class="main-header-menu-item">
                        <nav class="main-navigation-area clearfix ul-li">
                            <?php
                            echo str_replace(['menu-item-has-children', 'sub-menu'], ['dropdown', 'dropdown-menu clearfix'], wp_nav_menu( array(
                                    'echo' => false,
                                    'menu' => $main_menu,
                                    'items_wrap' => '<ul class="menu-navigation">%3$s</ul>'
                                ) )
                            );
                            ?>
                        </nav>
                    </div>
                </div>
                <div class="str-mobile_menu relative-position">
                    <div class="str-mobile_menu_button str-open_mobile_menu">
                        <i class="fas fa-bars"></i>
                    </div>
                    <div class="str-mobile_menu_wrap">
                        <div class="mobile_menu_overlay str-open_mobile_menu"></div>
                        <div class="str-mobile_menu_content">
                            <div class="str-mobile_menu_close str-open_mobile_menu">
                                <span><i class="fas fa-times"></i></span>
                            </div>
                            <nav class="str-mobile-main-navigation  clearfix ul-li">
                                <?php
                                echo str_replace(['menu-item-has-children', 'sub-menu'], ['dropdown', 'dropdown-menu clearfix'], wp_nav_menu( array(
                                        'echo' => false,
                                        'menu' => $mobile_menu,
                                        'items_wrap' => '<ul id="main-nav" class="navbar-nav text-capitalize clearfix">%3$s</ul>'
                                    ) )
                                );
                                ?>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- /mobile-menu -->
            </div>
        </div>
</header>
<!-- End of header section
	============================================= -->

  <?php  }

}
Plugin::instance()->widgets_manager->register_widget_type( new maan_nav_builder() );