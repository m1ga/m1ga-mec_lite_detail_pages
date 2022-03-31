<?php
class Elementor_Widget_MCE_EventPlace extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'event_place';
    }

    public function get_title()
    {
        return __('Event place', 'mec_lite_dp');
    }

    public function get_icon()
    {
        return 'eicon-map-pin';
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
              'label' => __('Content', 'mec_lite_dp'),
              'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
          ]
        );

        $this->add_control(
            'show_desc',
            [
                'label' => __('Show location description', 'mec_lite_dp'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'mec_lite_dp'),
                'label_off' => __('Hide', 'mec_lite_dp'),
                'return_value' => 'yes',
                'default' => 'yes',
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
              'name' => 'locationname_typography',
              'label' => __('Typography place name', 'mec_lite_dp'),
              'selector' => '{{WRAPPER}} .event__location__name',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
              'name' => 'locationdesc_typography',
              'label' => __('Typography description', 'mec_lite_dp'),
              'selector' => '{{WRAPPER}} .event__location__desc',
            ]
        );

        $this->add_control(
            'event_place_color',
            [
                'label' => __('Title Color', 'mec_lite_dp'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .event__location' => 'color: {{VALUE}}',
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
        $meta = get_post_meta($id);
        $locationId = get_post_meta($id, 'mec_location_id', true);
        if ($locationId != 1) {
            $location = get_term($locationId);
            $address = get_term_meta($locationId, "address", true);
            echo '<div class="event__location" style="color: ' . $settings['event_place_color'] . '">';
            echo '<div class="event__location__name">'.$location->name.'</div>';
            echo '<div class="event__location__address">'.$address.'</div>';
            if ($settings["show_desc"]) {
                echo '<div class="event__location__desc">'.$location->description.'</div>';
            }
            echo '</div>';
        }
    }

}
