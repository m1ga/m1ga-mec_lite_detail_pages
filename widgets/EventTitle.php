<?php
class Elementor_Widget_MCE_EventTitle extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'event_title';
    }

    public function get_title()
    {
        return __('Event title', 'mec_lite_dp');
    }

    public function get_icon()
    {
        return 'eicon-animated-headline';
    }

    public function get_categories()
    {
        return [ 'mec_lite_dp' ];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Settings', 'mec_lite_dp'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __('HTML Tag', 'mec_lite_dp'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'h1',
                'options' => [
                    'h1'  => __('H1', 'mec_lite_dp'),
                    'h2' => __('H2', 'mec_lite_dp'),
                    'h3' => __('H3', 'mec_lite_dp'),
                    'h4' => __('H4', 'mec_lite_dp'),
                    'h5' => __('H5', 'mec_lite_dp'),
                    'p' => __('p', 'mec_lite_dp'),
                ],
            ]
        );

        $this->add_control(
            'event_title_align',
            [
                    'label' => __('Alignment', 'mec_lite_dp'),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __('Left', 'mec_lite_dp'),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __('Center', 'mec_lite_dp'),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => __('Right', 'mec_lite_dp'),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'default' => 'left',
                    'toggle' => true,
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
              'label' => __('Style', 'mec_lite_dp'),
              'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
              'name' => 'content_typography',
              'label' => __('Typography', 'mec_lite_dp'),
              'selector' => '{{WRAPPER}} .event__title',
            ]
        );

        $this->add_control(
            'event_title_color',
            [
                'label' => __('Title Color', 'mec_lite_dp'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .event__title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $args = array("post_type" => "mec-events", "name" => get_query_var("event_id"));
        $query = get_posts($args);
        $id = $query[0]->ID;
        echo '<'.$settings['title_tag'].' class="event__title" style="text-align: ' . $settings['event_title_align'] . '; color: ' . $settings['event_title_color'] . '">'.get_the_title($id).'</'.$settings['title_tag'].'>';
    }

    protected function _content_template()
    {
    }
}
