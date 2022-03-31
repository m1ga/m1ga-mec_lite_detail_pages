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
            'selector' => '{{WRAPPER}} .event__content',
          ]
      );
      $this->add_control(
          'event_content_color',
          [
              'label' => __('Title Color', 'mec_lite_dp'),
              'type' => \Elementor\Controls_Manager::COLOR,
              'scheme' => [
                  'type' => \Elementor\Core\Schemes\Color::get_type(),
                  'value' => \Elementor\Core\Schemes\Color::COLOR_1,
              ],
              'selectors' => [
                  '{{WRAPPER}} .event__content' => 'color: {{VALUE}}',
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
        if (!empty(get_post_field("post_content", $id))) {
            echo '<div class="event__content"><p  style="color: ' . $settings['event_content_color'] . '">'.get_post_field("post_content", $id).'</p></div>';
        } elseif (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
            echo '<div class="event__content" ><p style="color: ' . $settings['event_content_color'] . '"><i>no content - the event detail text will be visible here</i></p></div>';
        }
    }

}
