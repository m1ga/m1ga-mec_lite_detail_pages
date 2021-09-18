<?php
class Elementor_Widget_MCE_EventDateStart extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'event_date_start';
    }

    public function get_title()
    {
        return __('Event date start', 'mec_lite_dp');
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
            'show_date',
            [
                        'label' => __('Show date', 'mec_lite_dp'),
                        'type' => \Elementor\Controls_Manager::SWITCHER,
                        'label_on' => __('Show', 'mec_lite_dp'),
                        'label_off' => __('Hide', 'mec_lite_dp'),
                        'return_value' => 'yes',
                        'default' => 'yes',
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
            'show_time',
            [
                        'label' => __('Show time', 'mec_lite_dp'),
                        'type' => \Elementor\Controls_Manager::SWITCHER,
                        'label_on' => __('Show', 'mec_lite_dp'),
                        'label_off' => __('Hide', 'mec_lite_dp'),
                        'return_value' => 'yes',
                        'default' => 'yes',
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
        $this->add_control(
            'show_allday',
            [
                        'label' => __('Show all-day text', 'mec_lite_dp'),
                        'type' => \Elementor\Controls_Manager::SWITCHER,
                        'label_on' => __('Show', 'mec_lite_dp'),
                        'label_off' => __('Hide', 'mec_lite_dp'),
                        'return_value' => 'yes',
                        'default' => 'yes',
                    ]
        );
        $this->add_control(
            'allday_text',
            [
                'label' => __('All-day text', 'mec_lite_dp'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('All day', 'mec_lite_dp'),
                'placeholder' => __('Custom php time format', 'mec_lite_dp'),
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'style_date_section',
            [
              'label' => __('Date style', 'mec_lite_dp'),
              'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
              'name' => 'date_typography',
              'label' => __('Date typography', 'plugin-domain'),
              'selector' => '{{WRAPPER}} .event__date',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
              'name' => 'time_typography',
              'label' => __('Time typography', 'plugin-domain'),
              'selector' => '{{WRAPPER}} .event__time',
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

        $allday = get_post_meta($id, 'mec_allday', true);
        $date = strtotime(get_post_meta($id, 'mec_start_date', true));
        $formatedDate = date($settings['date_format'], $date);

        echo '<div class="event__datetime">';
        if ($settings["show_date"]) {
            echo '<time class="event__date" datetime="'.$formatedDate. ' ' . $formatedTime.'">'. $formatedDate .'</time>';
        }
        if (!$allday) {
            if ($settings["show_time"]) {
                $seconds = get_post_meta($id, 'mec_start_day_seconds', true);
                $formatedTime = date($settings['time_format'], $seconds);
                echo '<time class="event__time" datetime="'.$formatedDate. ' ' . $formatedTime.'">'. $formatedTime .'</time>';
            }
        } else {
            if ($settings["show_allday"]) {
                echo '<time class="event__time" datetime="'.$formatedDate.'">'. $settings['allday_text'] .'</time>';
            }
        }
        echo '</div>';
    }

    protected function _content_template()
    {
    }
}
