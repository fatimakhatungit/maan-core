<?php

namespace Elementor;
if (!defined('ABSPATH')) exit; // Exit if accessed directly

class maan_search extends Widget_Base
{
    public function get_name()
    {
        return 'maan-search';
    }

    public function get_title()
    {
        return __('Maan Search', 'maan');
    }

    public function get_categories()
    {
        return ['maanelement-addons'];
    }

    public function get_icon()
    {
        return 'eicon-posts-group';
    }

    protected function _register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Search', 'maan'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => __('Title', 'maan'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Search', 'maan'),
            ]
        );
        $this->add_control(
            'btn_color',
            [
                'label' => __('BG Color', 'maan'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-sub' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btnc_color',
            [
                'label' => __('Button Color', 'maan'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-sub' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();

    }

    protected function render()
    {

        $settings = $this->get_settings_for_display();

        echo '
                <form class="search-form" id="searchform" action="'.home_url('/').'" method="get">
                    <input type="text" class="input-style-2" type="text" name="s" value="" placeholder="'.$settings['title'].'">
                    <input type="hidden" name="post_type" value="download" />
                    <button class="btn-sub" id="searchsubmit" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            ';
    }

    protected function content_template()
    {
    }

    public function render_plain_content($instance = [])
    {
    }

}

Plugin::instance()->widgets_manager->register_widget_type(new maan_search());
?>