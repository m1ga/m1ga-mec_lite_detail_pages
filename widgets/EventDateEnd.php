<?php
class Elementor_Widget_MCE_EventDateEnd extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'event_date_end';
    }

    public function get_title()
    {
        return __('Event date end', 'mec_lite_dp');
    }

    public function get_icon()
    {
        return 'eicon-calendar';
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
            'date_format',
            [
                'label' => __('Date format', 'mec_lite_dp'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('d.m.Y', 'mec_lite_dp'),
                'placeholder' => __('Custom php date format', 'mec_lite_dp'),
            ]
        );

        $this->add_control(
            'time_format',
            [
                'label' => __('Time format', 'mec_lite_dp'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('H:i', 'mec_lite_dp'),
                'placeholder' => __('Custom php time format', 'mec_lite_dp'),
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
        $date = strtotime(get_post_meta($id, 'mec_end_date', true));
        $allday = get_post_meta($id, 'mec_allday', true);
        $formatedDate = date($settings['date_format'], $date);

        echo '<div class="event__datetime">';
        echo '<time class="event__date" datetime="'.$formatedDate. ' ' . $formatedTime.'">'. $formatedDate .'</time>';
        if (!$allday) {
            $seconds = get_post_meta($id, 'mec_end_day_seconds', true);
            $formatedTime = date($settings['time_format'], $seconds);
            echo '<time class="event__time" datetime="'.$formatedDate. ' ' . $formatedTime.'">'. $formatedTime .'</time>';
        }
        echo '</div>';
    }

    protected function _content_template()
    {
    }
}
