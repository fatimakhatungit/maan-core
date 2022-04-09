<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class maan_testimonial extends Widget_Base {

    public function get_name() {
        return 'maan-testimonial';
    }

    public function get_title() {
        return __( 'Testimonial', 'maan' );
    }
    public function get_categories() {
        return [ 'maanelement-addons' ];
    }
    public function get_icon() {
        return 'eicon-person';
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'maan' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'slide_number',
            [
                'label' => __('Slide Number', 'maan'),
                'type' => Controls_Manager::NUMBER,
                'default' => 1,
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'member_name',
            [
                'label' => __( 'Name', 'maan' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Al-Mahmud', 'maan' ),
            ]
        );
        $repeater->add_control(
            'member_info',
            [
                'label' => __( 'Comment', 'maan' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea', 'maan' ),
            ]
        );
        $repeater->add_control(
            'rating',
            [
                'label' => __('Rating', 'maan'),
                'type' => Controls_Manager::NUMBER,
                'default' => 5,
            ]
        );
        $repeater->add_control(
            'member_photo', [
                'label' => __( 'Photo', 'maan' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'member_list',
            [
                'label' => __( 'Client List', 'maan' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'member_name' => __( 'Al-Mahmud', 'maan' ),
                    ],
                    [
                        'member_name' => __( 'Al-Mahmud', 'maan' ),
                    ],
                    [
                        'member_name' => __( 'Al-Mahmud', 'maan' ),
                    ],
                    [
                        'member_name' => __( 'Al-Mahmud', 'maan' ),
                    ],

                ],
                'title_field' => '{{{ member_name }}}',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_style',
            [
                'label' => __( 'Style', 'maan' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'maan' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .feed-box .feed-head .feed-bio h5' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_fonts',
                'label' => __( 'Title Typography', 'maan' ),
                'selector' => '{{WRAPPER}} .feed-box .feed-head .feed-bio h5',
            ]
        );
        $this->add_control(
            'inf_color',
            [
                'label' => __( 'Info Color', 'maan' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .feed-box p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'inf_fonts',
                'label' => __( 'Info Typography', 'maan' ),
                'selector' => '{{WRAPPER}} .feed-box p',
            ]
        );
        $this->add_control(
            'social_bg',
            [
                'label' => __( 'Nav BG', 'maan' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'team_socials_bngn',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .owl-theme .owl-dots .owl-dot span',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'team_socials_bsg',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .owl-theme .owl-dots .owl-dot.active span::before, 
                {{WRAPPER}} .owl-theme .owl-dots .owl-dot:hover span::before',
            ]
        );
        $this->add_control(
            'social_bga',
            [
                'label' => __( 'Testimonial BG', 'maan' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'team_socials_bgt',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .feed-box.bg-2',
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $option = [
            'item' => $settings['slide_number'],
        ]; ?>

        <!-- Start Feedback
		============================================= -->
        <div class="feed-area" data-maan='<?php echo wp_json_encode($option) ?>'>
        <?php echo '<div class="feed-wpr feed-sldr owl-carousel owl-theme">';
            if ($settings['member_list']) {
                foreach ($settings['member_list'] as $members) {
                    echo '<div class="feed-box bg-2">
                        <div class="feed-qoute">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <div class="feed-head">
                            <div class="feed-pic">
                                ' . get_that_image($members['member_photo']) . '
                            </div>
                            <div class="feed-bio">
                                <h5 class="work-title">' . $members['member_name'] . '</h5>
                                <div class="price-rating d-flex align-items-center">
                                   '.client_ratings($members['rating']).'
                                </div>
                            </div>
                        </div>
                        <p class="mb-0">
                            ' . $members['member_info'] . '
                        </p>
                    </div>';
                }
            }
            echo '</div>
        </div>
        <!-- End Feedback -->';

    }

    protected function content_template() {}

    public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register_widget_type( new maan_testimonial() );
?>