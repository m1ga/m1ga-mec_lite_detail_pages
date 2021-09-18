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
        return 'eicon-text';
    }

    public function get_categories()
    {
        return [ 'mec_lite_dp' ];
    }

    protected function _register_controls()
    {
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
            echo '<div class="event__location">'.$location->name.'</div>';
        }
    }

    protected function _content_template()
    {
    }
}
