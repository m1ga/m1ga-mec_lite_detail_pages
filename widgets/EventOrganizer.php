<?php
class Elementor_Widget_MCE_EventOrganizer extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'event_organizer';
    }

    public function get_title()
    {
        return __('Event organizer name', 'mec_lite_dp');
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
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $args = array("post_type" => "mec-events", "name" => get_query_var("event_id"));
        $query = get_posts($args);
        $id = $query[0]->ID;
        $meta = get_post_meta($id);
        $organizerId = get_post_meta($id, 'mec_organizer_id', true);
        if ($organizerId != 1) {
            $organizer = get_term($organizerId);
            $phone = get_term_meta($organizerId, "tel", true);
            $mail = get_term_meta($organizerId, "mail", true);
            echo '<div class="event__organizer">';
            echo '<div class="event__organizer__name">'.$organizer->name.'</div>';
            echo '<div class="event__organizer__desc">'.$organizer->description.'</div>';
            echo '<div class="event__organizer__phone">'.$phone.'</div>';
            echo '<div class="event__organizer__mail">'.$mail.'</div>';
            echo '</div>';
        }
    }

    protected function _content_template()
    {
    }
}
