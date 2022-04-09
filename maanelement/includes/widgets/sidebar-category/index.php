<?php

namespace Elementor;
if (!defined('ABSPATH')) exit; // Exit if accessed directly

class sidebar_cate extends Widget_Base
{
    public function get_name()
    {
        return 'sidebar-cate';
    }

    public function get_title()
    {
        return __('Sidebar Category', 'maan');
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
                'options' => ae_drop_cat('download_category'),
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
                    '{{WRAPPER}} .category-list ul li a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ttih',
                'label' => __('Title Typography', 'maan'),
                'selector' => '{{WRAPPER}} .category-list ul li a',
            ]
        );
        $this->add_control(
            'bg',
            [
                'label' => __('BG Color', 'maan'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category-list ul li' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();

    }

    protected function render()
    {

        $settings = $this->get_settings_for_display();
        $tax_args = array(
            'taxonomy' => 'download_category',
            'number' => $settings['show_cat'],
            'include' => $settings['cat'],
            'hide_empty' => false,
        );
        $categories = get_terms($tax_args);
       echo'<!-- Category -->
            <div class="category">
                <div class="category-list">
                    <ul>';
                    if (!empty($categories)) {
                        foreach ($categories as $category) {
                            $meta = get_term_meta($category->term_id, '_maandownload', true);
                            $img = isset($meta['tax_photo']['url']) ? $meta['tax_photo'] : '';
                            echo '<li>
                            <a href="' . get_term_link($category->slug, 'download_category') . '">
                                <i>' . get_that_image($img) . '</i>
                                <span> ' . $category->name . '</span>
                            </a>
                        </li>';
                        }
                    }
                    echo '</ul>
                </div>
            </div>';
    }

    protected function content_template()
    {
    }

    public function render_plain_content($instance = [])
    {
    }

}

Plugin::instance()->widgets_manager->register_widget_type(new sidebar_cate());
?>