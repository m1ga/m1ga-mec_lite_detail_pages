<?php
class Elementor_Widget_MCE_EventPlaceImage extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'event_place_image';
    }

    public function get_title()
    {
        return __('Event place image', 'mec_lite_dp');
    }

    public function get_icon()
    {
        return 'eicon-image';
    }

    public function get_categories()
    {
        return [ 'mec_lite_dp' ];
    }

    protected function _register_controls()
    {
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
            $image = get_term_meta($locationId, "thumbnail", true);
            echo '<div class="event__location">';
            echo '<img src="'.$image.'"/>';
            echo '</div>';
        }
    }

    protected function _content_template()
    {
    }
}
