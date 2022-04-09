<?php

namespace Elementor;
if (!defined('ABSPATH')) exit; // Exit if accessed directly

class sidebar_tags extends Widget_Base
{
    public function get_name()
    {
        return 'sidebar-tags';
    }

    public function get_title()
    {
        return __('Sidebar Tags', 'maan');
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
                'label' => __('Blog', 'maan'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'cat',
            [
                'label' => __('Category', 'maan'),
                'type' => Controls_Manager::SELECT2,
                'options' => ae_drop_cat('download_tag'),
                'label_block' => true,
                'multiple' => true,
            ]
        );
        $this->add_control(
            'show_cat',
            [
                'label' => esc_html__('Show Category', 'maan'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => esc_html__('5', 'maan'),
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'content_sty',
            [
                'label' => __('Style', 'maan'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'post_title_color',
            [
                'label' => __('Title Color', 'maan'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tags-link' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ttih',
                'label' => __('Title Typography', 'maan'),
                'selector' => '{{WRAPPER}} .tags-link',
            ]
        );
        $this->add_control(
            'bg_color',
            [
                'label' => __('BG Color', 'maan'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tags-link' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'bgh_color',
            [
                'label' => __('BG Hover Color', 'maan'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tags-link:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();

    }

    protected function render()
    {

        $settings = $this->get_settings_for_display();
        $tax_args = array(
            'taxonomy' => 'download_tag',
            'number' => $settings['show_cat'],
            'include' => $settings['cat'],
        );
        $categories = get_terms($tax_args);
       echo'<div class="sidebar-tags">
                <div class="tags">';
                    if (!empty($categories)) {
                        foreach ($categories as $category) {
                            $meta = get_term_meta($category->term_id, '_maandownload', true);
                            echo '<a href="' . get_term_link($category->slug, 'download_tag') . '" class="tags-link">' . $category->name . '</a>';
                        }
                    }
                    echo '</div>
            </div>';
    }

    protected function content_template()
    {
    }

    public function render_plain_content($instance = [])
    {
    }

}

Plugin::instance()->widgets_manager->register_widget_type(new sidebar_tags());
?>