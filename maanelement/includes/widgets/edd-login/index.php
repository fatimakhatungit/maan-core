<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class maan_edd_login extends Widget_Base
{

    public function get_name()
    {
        return 'maan-edd-login';
    }

    public function get_title()
    {
        return __('Maan EDD Login', 'maan');
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
                'label' => __( 'Login', 'maan' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'image',
            [
                'label' => __('Login Logo', 'maan'),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'login-title',
            [
                'label' => __('Login Title', 'maan'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'title' => __('Enter After Login Title', 'maan'),
            ]
        );
        $this->add_control(
            'url',
            [
                'label' => __('After Login Redirect Url', 'maan'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'title' => __('Enter After Login Redirect Url', 'maan'),
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

        //start login style
        $this->start_controls_section(
            'login_style',
            [
                'label' => __('Login Style', 'maan'),
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
                    {{WRAPPER}} #edd_login_form legend, 
                    {{WRAPPER}} #edd_register_form legend' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'login_bg_color',
            [
                'label' => __('Login Button Color', 'maan'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edd-submit' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'login_bag_color',
            [
                'label' => __('Login Button BG', 'maan'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edd-submit' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'login_bagh_color',
            [
                'label' => __('Login Button Hover BG', 'maan'),
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
        $logintitle = $this->get_settings('login-title');
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
                        <?php if ($logintitle) { ?>
                            <h4 class="register-title mb-50"><?php esc_html_e($logintitle); ?></h4>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($redirect_url) { ?>
                        <?php echo do_shortcode(' [edd_login redirect="' . $redirect_url . '"]'); ?>
                    <?php } else { ?>
                        <?php echo do_shortcode(' [edd_login]'); ?>
                    <?php } ?>
                    <?php if (is_user_logged_in()) { ?>
                    <?php } else { ?>
                        <?php if ($registration_url) { ?>
                            <span class="reg-acc">
                                       <?php esc_html_e('Don\'t Have an Account'); ?> <a
                                        href="<?php echo esc_attr($registration_url); ?>"><?php esc_html_e('Register?', 'maan'); ?></a>
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

Plugin::instance()->widgets_manager->register_widget_type(new maan_edd_login());
?>