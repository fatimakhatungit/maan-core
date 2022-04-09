<?php

namespace Elementor;
use MaanElement_Elementor_Addons;
if (!defined('ABSPATH')) exit; // Exit if accessed directly

class pricing_table extends Widget_Base
{

    public function get_name()
    {
        return 'pricing-table';
    }

    public function get_title()
    {
        return __('Pricing Table', 'maan');
    }

    public function get_categories()
    {
        return ['maanelement-addons'];
    }

    public function get_icon()
    {
        return 'eicon-sitemap';
    }

    public function render_plain_content($instance = [])
    {
    }

    protected function _register_controls()
    {


        $this->start_controls_section(
            'pm',
            [
                'label' => __('Monthly', 'maan'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'grid',
            [
                'label' => __('Grid Item', 'maan'),
                'type' => Controls_Manager::NUMBER,
                'default' => __('3', 'maan'),
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control(
            'title',
            [
                'label' => __('Title', 'maan'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Basic', 'maan'),
            ]
        );
        $repeater->add_control(
            'sub',
            [
                'label' => __('Sub Title', 'maan'),
                'type' => Controls_Manager::TEXT,
                'default' => __('month', 'maan'),
            ]
        );
        $repeater->add_control(
            'price',
            [
                'label' => __('Price', 'maan'),
                'type' => Controls_Manager::NUMBER,
                'default' => __('29', 'maan'),
            ]
        );
        $repeater->add_control(
            'unit',
            [
                'label' => __('Unit', 'maan'),
                'type' => Controls_Manager::TEXT,
                'default' => __('$', 'maan'),
            ]
        );
        $repeater->add_control(
            'features',
            [
                'label' => __('Features', 'maan'),
                'type' => MaanElement_Elementor_Addons::LIST_CONTROL,
            ]
        );
        $repeater->add_control(
            'button',
            [
                'label' => __('Button', 'maan'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Start Now', 'maan'),
            ]
        );
        $repeater->add_control(
            'link', [
                'label' => __('Link', 'maan'),
                'type' => Controls_Manager::URL,
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );
        $repeater->add_control(
            'photo', [
                'label' => __('Photo', 'maan'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'price_list',
            [
                'label' => __('Pricing Table', 'maan'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => 'Primary Plan',
                    ],
                    [
                        'title' => 'Basic Plan',
                    ],
                    [
                        'title' => 'Premium Plan',
                    ],

                ],
                'title_field' => '{{{ title }}}',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_style',
            [
                'label' => __('Style', 'maan'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'maan'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-box .price-head .price-ribbon-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_fonts',
                'label' => __('Title Typography', 'maan'),
                'selector' => '{{WRAPPER}} .price-box .price-head .price-ribbon-title',
            ]
        );
        $this->add_control(
            'pricing_color',
            [
                'label' => __('Pricing Color', 'maan'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-box .price-head .price-value h4' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pr_fonts',
                'label' => __('Pricing Typography', 'maan'),
                'selector' => '{{WRAPPER}} .price-box .price-head .price-value h4',
            ]
        );
        $this->add_control(
            'unit_color',
            [
                'label' => __('Unit Color', 'maan'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-box .price-head .price-value h4 span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pruu_fonts',
                'label' => __('Unit Typography', 'maan'),
                'selector' => '{{WRAPPER}} .price-box .price-head .price-value h4 span',
            ]
        );
        $this->add_control(
            'fe_color',
            [
                'label' => __('Feature Color', 'maan'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-box .price-info ul li' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fea_fonts',
                'label' => __('Feature Typography', 'maan'),
                'selector' => '{{WRAPPER}} .price-box .price-info ul li',
            ]
        );
        $this->add_control(
            'btn_color',
            [
                'label' => __('Button Color', 'maan'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-box .price-bottom .btn-6' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btn_bg_color',
            [
                'label' => __('Button BG Color', 'maan'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-box .price-bottom .btn-6' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btn_hover_color',
            [
                'label' => __('Button Hover Color', 'maan'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-box .price-bottom .btn-6:before' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        echo '<!-- Start Price
		============================================= -->
        <div class="price-area">
                <div class="price-wpr grid-'.$settings['grid'].'">';

        if ($settings['price_list']) {

            foreach ($settings['price_list'] as $monthly) {

                echo '<div class="price-box wow fadeInLeft">
                        <div class="price-head">
                            <div class="price-image">
							    '.get_that_image($monthly['photo']).'
							</div>
                            <div class="price-rib">
                                <span class="price-ribbon-title">' . $monthly['title'] . '</span>
                            </div>
                            <div class="price-value">
                                <h4><span>' . $monthly['unit'] . '</span>' . $monthly['price'] . '<span>/' . $monthly['sub'] . '</span></h4>
                            </div>
                        </div>
                        <div class="price-info">
                            <ul>';
                                maan_list_control($monthly['features'], '<i class="fas fa-check-circle"></i>');
                            echo'</ul>
                        </div>
                        <div class="price-bottom">
                            <a ' . get_that_link($monthly['link']) . ' class="btn-6">' . $monthly['button'] . '</a>
                        </div>
                    </div>';

            }
        }
        echo '</div>
        </div>
        <!-- End Price -->';
    }


    protected function content_template()
    {
    }

}

Plugin::instance()->widgets_manager->register_widget_type(new pricing_table());
?>