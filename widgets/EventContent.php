<?php
class Elementor_Widget_MCE_EventContent extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'event_content';
    }

    public function get_title()
    {
        return __('Event content', 'mec_lite_dp');
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
        if (!empty(get_post_field("post_content", $id))) {
            echo '<p>'.get_post_field("post_content", $id).'</p>';
        } elseif (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
            echo '<p><i>no content - the event detail text will be visible here</i></p>';
        }
    }

    protected function _content_template()
    {
    }
}
