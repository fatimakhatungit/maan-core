<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class maan_edd_register extends Widget_Base
{

    public function get_name()
    {
        return 'maan-edd-register';
    }

    public function get_title()
    {
        return __('Maan EDD Register', 'maan');
    }

    public function get_categories()
    {
        return ['maanelement-addons'];
    }

    public function get_icon()
    {
        return 'eicon-elementor';
    }

    protected function _register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Register', 'maan' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'image',
            [
                'label' => __('Register Logo', 'maan'),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'register-title',
            [
                'label' => __('Register Title', 'maan'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'title' => __('Enter After Register Title', 'maan'),
            ]
        );
        $this->add_control(
            'url',
            [
                'label' => __('After Register Redirect Url', 'maan'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'title' => __('Enter After Register Redirect Url', 'maan'),
            ]
        );

        $this->add_control(
            'reg_url',
            [
                'label' => __('Registration Url', 'maan'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'title' => __('Enter After Registration Url', 'maan'),
            ]
        );
        $this->end_controls_section();

        //start register style
        $this->start_controls_section(
            'register_style',
            [
                'label' => __('Register Style', 'maan'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            't_color',
            [
                'label' => __('Title Color', 'maan'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .register-title, 
                    {{WRAPPER}} #edd_register_form legend' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'register_bg_color',
            [
                'label' => __('Register Button Color', 'maan'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edd-submit' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'register_bag_color',
            [
                'label' => __('Register Button BG', 'maan'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edd-submit' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'register_bagh_color',
            [
                'label' => __('Register Button Hover BG', 'maan'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edd-submit:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render($instance = [])
    {

        // get our input from the widget settings.

        $settings = $this->get_settings();
        $image = $this->get_settings('image');
        $redirect_url = $this->get_settings('url');
        $registration_url = $this->get_settings('reg_url');
        $registertitle = $this->get_settings('register-title');
        ?>
        <!-- Start Register
        ============================================= -->
        <div class="reg-area">
            <div class="reg-wpr">
                <div class="login-form">
                    <?php if ($image['url']) { ?>
                        <i class="header-icon"><a
                                    href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo $image['url']; ?>" alt="login-img"></a></i>
                    <?php } ?>
                    <?php if (!is_user_logged_in()) { ?>
                        <?php if ($registertitle) { ?>
                            <h4 class="register-title mb-50"><?php esc_html_e($registertitle); ?></h4>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($redirect_url) { ?>
                        <?php echo do_shortcode(' [edd_register redirect="' . $redirect_url . '"]'); ?>
                    <?php } else { ?>
                        <?php echo do_shortcode(' [edd_register]'); ?>
                    <?php } ?>
                    <?php if (is_user_logged_in()) { ?>
                        <h4 class="register-title mb-50"><?php esc_html_e('You are already logged in!', 'maan'); ?></h4>
                    <?php } else { ?>
                        <?php if ($registration_url) { ?>
                            <span class="reg-acc">
                                       <?php esc_html_e('You already registered!'); ?> <a
                                        href="<?php echo esc_attr($registration_url); ?>"><?php esc_html_e('Login?', 'maan'); ?></a>
                                    </span>
                        <?php } ?>

                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- End Register -->

        <?php

    }

    protected function content_template()
    {
    }

    public function render_plain_content($instance = [])
    {
    }

}

Plugin::instance()->widgets_manager->register_widget_type(new maan_edd_register());
?>