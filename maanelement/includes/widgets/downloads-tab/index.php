<?php

namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


class download_tab_filter extends Widget_Base
{

    public function get_name()
    {
        return 'download-tab-filter';
    }

    public function get_title()
    {
        return __('Download Tab', 'maan');
    }

    public function get_icon()
    {
        return 'eicon-form-horizontal';
    }

    public function get_categories()
    {
        return ['maanelement-addons'];
    }

    protected function _register_controls()
    {

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
                'label' => esc_html__('Show Category', 'maan'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => esc_html__('5', 'maan'),
            ]
        );
        $this->add_control(
            'post_per',
            [
                'label' => esc_html__('Post Per Tab', 'maan'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => esc_html__('5', 'maan'),
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'ttb',
            [
                'label' => __('Tab Title', 'maan'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ttc',
            [
                'label' => __('Title Color', 'maan'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .nav-pills .show > .nav-link' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'ttca',
            [
                'label' => __('Active Color', 'maan'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .nav-pills .show > .nav-link.active' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ttih',
                'label' => __('Title Typography', 'maan'),
                'selector' => '{{WRAPPER}} .nav-pills .show > .nav-link',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'tti',
            [
                'label' => __('Tab Item', 'maan'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ittc',
            [
                'label' => __('Title Color', 'maan'),
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
                'label' => __('Title Typography', 'maan'),
                'selector' => '{{WRAPPER}} .work-title',
            ]
        );
        $this->add_control(
            'itatc',
            [
                'label' => __('Meta Color', 'maan'),
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
                'label' => __('Meta Typography', 'maan'),
                'selector' => '{{WRAPPER}} .work-box .work-desc .work-meta, 
                {{WRAPPER}} .work-box .work-desc .work-btns ul',
            ]
        );
        $this->end_controls_section();

    }

    protected function render()
    {

        $settings = $this->get_settings();
        echo ' <!-- Start Latest Themes
       ============================================= -->
        <div class="latest-thm">
                <div class="latest-pill-content">
                    <ul class="nav nav-pills latest-pill mb-60" id="pills-tab" role="tablist">';
        $tax_args = array(
            'taxonomy' => 'download_category',
            'number' => $settings['show_cat'],
            'include' => $settings['cat'],
            'hide_empty' => false,
        );
        $categories = get_terms($tax_args);
        $tab_btn = 0;
        foreach ($categories as $category) {
            $tab_btn++;
            if ($tab_btn == 1) {
                $tab_active = 'active';
            } else {
                $tab_active = '';
            }
            $meta = get_term_meta($category->term_id, '_maandownload', true);
            $img = isset($meta['tax_photo']['url']) ? $meta['tax_photo'] : '';
            echo '<li class="nav-item" role="presentation">
                                    <button class="nav-link ' . $tab_active . '" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#' . $category->slug . '" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                                        ' . get_that_image($img) . '
                                        ' . $category->name . '
                                    </button>
                                </li>';
        }

        echo '</ul>
                    <div class="tab-content" id="pills-tabContent">';
        $content = 0;
        foreach ($categories as $category) {
            $content++;
            if ($content == 1) {
                $content_show = 'active show';
            } else {
                $content_show = '';
            }
            echo '<div class="tab-pane fade ' . $content_show . '" id="' . $category->slug . '" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="latest-wpr grid-3">';
            $the_query = new \WP_Query(array(
                'post_type' => 'download',
                'posts_per_page' => $settings['post_per'],
                'tax_query' => array(
                    array(
                        'taxonomy' => 'download_category',
                        'field' => 'term_id',
                        'terms' => $settings['cat'],
                    )
                )
            ));
            if ($the_query->have_posts()) {
                while ($the_query->have_posts()) {
                    $the_query->the_post();
                    echo '<div class="work-box wow fadeInLeft">
                                    <div class="work-pic">
                                     ' . get_the_post_thumbnail() . '
                                                <a href="' . get_the_post_thumbnail_url() . '" class="item work-popup popup-link">      <i class="fas fa-search"></i>
                                                </a>
                                    </div>
                                    <div class="work-desc">
                                        <div class="work-meta">
                                            <ul class="space-between">
                                                <li>By- ' . get_the_author_posts_link() . '</li>
                                                <li>Comments ' . get_comments_number() . '</li>
                                            </ul>
                                        </div>
                                        <a href="theme-single.html">
                                            <h5 class="work-title">
                                                ' . get_the_title() . '
                                            </h5>
                                        </a>
                                        <div class="work-bottom space-between">
                                            <div class="work-price">
                                                <span class="value">';
                    edd_price();
                    echo '</span>
                                                <div class="price-rating d-flex align-items-center">
                                                    ' . maan_avarage_rating() . '
                                                </div>
                                            </div>
                                            <div class="work-btns">
                                                <ul>
                                                    <li>' . edd_get_total_sales() . ' Sale</li>
                                                    <li><a href="' . get_the_permalink() . '" class="btn-7">Preview</a></li>
                                                                                             <li><a class="btn-cart" href="' . esc_url(home_url('/') . 'checkout?edd_action=add_to_cart&download_id=' . get_the_ID()) . '"><i class="fas fa-shopping-cart"></i></a></li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                }
                wp_reset_postdata();
            }
            echo '</div></div>';
        }
        echo '

                    </div>
                </div>
            </div>
            <div class="work-view text-center mt-70">
                <a href="' . get_post_type_archive_link('download') . '" class="btn-4">View All Item</a>
            </div>
        <!-- End Latest Themes -->';
    }


}

Plugin::instance()->widgets_manager->register_widget_type(new download_tab_filter());