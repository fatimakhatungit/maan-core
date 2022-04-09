<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class maan_team extends Widget_Base
{

    public function get_name()
    {
        return 'maan-leader';
    }

    public function get_title()
    {
        return __('Team', 'maan');
    }

    public function get_categories()
    {
        return ['maanelement-addons'];
    }

    public function get_icon()
    {
        return 'eicon-person';
    }

    protected function _register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'maan'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'grid',
            [
                'label' => __('Grid', 'maan'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 4,
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'member_name',
            [
                'label' => __('Name', 'maan'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Al Mahmud', 'maan'),
            ]
        );
        $repeater->add_control(
            'member_designation',
            [
                'label' => __('Designation', 'maan'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Founder & CEO', 'maan'),
            ]
        );
        $repeater->add_control(
            'member_photo', [
                'label' => __('Photo', 'maan'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeater->add_control(
            'url1',
            [
                'label' => __('Link 1', 'maan'),
                'type' => \Elementor\Controls_Manager::URL,
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );
        $repeater->add_control(
            'icon1',
            [
                'label' => __( 'Icon 1', 'maan' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fab fa-twitter',
                    'library' => 'brand',
                ],
            ]
        );

        $repeater->add_control(
            'url2',
            [
                'label' => __('Link 2', 'maan'),
                'type' => \Elementor\Controls_Manager::URL,
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );
        $repeater->add_control(
            'icon2',
            [
                'label' => __( 'Icon 2', 'maan' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fab fa-twitter',
                    'library' => 'brand',
                ],
            ]
        );
        $repeater->add_control(
            'url3',
            [
                'label' => __('Link 3', 'maan'),
                'type' => \Elementor\Controls_Manager::URL,
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );
        $repeater->add_control(
            'icon3',
            [
                'label' => __( 'Icon 3', 'maan' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fab fa-twitter',
                    'library' => 'brand',
                ],
            ]
        );
        $repeater->add_control(
            'url4',
            [
                'label' => __('Link 4', 'maan'),
                'type' => \Elementor\Controls_Manager::URL,
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );
        $repeater->add_control(
            'icon4',
            [
                'label' => __( 'Icon 4', 'maan' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fab fa-twitter',
                    'library' => 'brand',
                ],
            ]
        );
        $this->add_control(
            'member_list',
            [
                'label' => __('List', 'maan'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'member_name' => __('Al Mahmud', 'maan'),
                    ],
                    [
                        'member_name' => __('Al Mahmud', 'maan'),
                    ],
                    [
                        'member_name' => __('Al Mahmud', 'maan'),
                    ],
                    [
                        'member_name' => __('Al Mahmud', 'maan'),
                    ],
                ],
                'title_field' => '{{{ member_name }}}',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_style',
            [
                'label' => __('Style', 'maan'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'maan'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-box .team-overlay .team-bio h4' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_fonts',
                'label' => __('Title Typography', 'maan'),
                'selector' => '{{WRAPPER}} .team-box .team-overlay .team-bio h4',
            ]
        );
        $this->add_control(
            'des_color',
            [
                'label' => __('Designation Color', 'maan'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-box .team-overlay .team-bio span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'des_fonts',
                'label' => __('Designation Typography', 'maan'),
                'selector' => '{{WRAPPER}} .team-box .team-overlay .team-bio span',
            ]
        );
        $this->add_control(
            'ic_color',
            [
                'label' => __('Social Icon Color', 'maan'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .footer-social li a i' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'ic_colorb',
            [
                'label' => __('Social Icon BG', 'maan'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .footer-social li a i' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'ic_colorbh',
            [
                'label' => __('Social Icon Hover BG', 'maan'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .footer-social li a i:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'social_bg',
            [
                'label' => __( 'Team Overlay', 'maan' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'team_socials_bg',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .team-box .team-overlay',
            ]
        );
        $this->add_responsive_control(
            'wrapper_margin',
            [
                'label' => __('Item Margin', 'maan'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .team-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        echo ' <!-- Start Team
		============================================= -->
        <div class="team-area">
         <div class="team-wpr grid-' . $settings['grid'] . '">';
        if ($settings['member_list']) {
            foreach ($settings['member_list'] as $members) {
                echo '<div class="team-box wow fadeInUp">
                        ' . get_that_image($members['member_photo']) . '
                        <div class="team-overlay">
                            <div class="team-bio">
                                <h4>' . $members['member_name'] . '</h4>
                                <span>' . $members['member_designation'] . '</span>
                            </div>
                            <div class="team-social">
                                <ul class="footer-social">
                                    <li><a  ' . get_that_link($members['url1']) . '>';\Elementor\Icons_Manager::render_icon( $members['icon1'], [ 'aria-hidden' => 'true' ] );echo'</a></li>
                                    <li><a  ' . get_that_link($members['url2']) . '>';\Elementor\Icons_Manager::render_icon( $members['icon2'], [ 'aria-hidden' => 'true' ] );echo'</a></li>
                                    <li><a  ' . get_that_link($members['url3']) . '>';\Elementor\Icons_Manager::render_icon( $members['icon3'], [ 'aria-hidden' => 'true' ] );echo'</a></li>
                                    <li><a  ' . get_that_link($members['url4']) . '>';\Elementor\Icons_Manager::render_icon( $members['icon4'], [ 'aria-hidden' => 'true' ] );echo'</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>';
            }
        }
        echo '</div>
        </div>
        <!-- End Team -->
        ';
    }

    protected function content_template()
    {
    }

    public function render_plain_content($instance = [])
    {
    }

}

Plugin::instance()->widgets_manager->register_widget_type(new maan_team());
?>