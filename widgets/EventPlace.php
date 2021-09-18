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
              'label' => __('Typography place name', 'plugin-domain'),
              'selector' => '{{WRAPPER}} .event__locationname',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
              'name' => 'locationdesc_typography',
              'label' => __('Typography description', 'plugin-domain'),
              'selector' => '{{WRAPPER}} .event__locationdesc',
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
            $desc = get_term_by('term_id', $location->id, "mce_location");
            echo '<div class="event__location">';
            echo '<div class="event__locationname">'.$location->name.'</div>';
            if ($settings["show_desc"]) {
                echo '<div class="event__locationdesc">'.$location->description.'</div>';
            }
            echo '</div>';
        }
    }

    protected function _content_template()
    {
    }
}
