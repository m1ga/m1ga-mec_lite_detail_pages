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
            'selector' => '{{WRAPPER}} .event__organizer',
          ]
      );

      $this->add_control(
          'event_organizer_color',
          [
              'label' => __('Title Color', 'mec_lite_dp'),
              'type' => \Elementor\Controls_Manager::COLOR,
              'scheme' => [
                  'type' => \Elementor\Core\Schemes\Color::get_type(),
                  'value' => \Elementor\Core\Schemes\Color::COLOR_1,
              ],
              'selectors' => [
                  '{{WRAPPER}} .event__organizer' => 'color: {{VALUE}}',
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
        $organizerId = get_post_meta($id, 'mec_organizer_id', true);
        if ($organizerId != 1) {
            $organizer = get_term($organizerId);
            $phone = get_term_meta($organizerId, "tel", true);
            $mail = get_term_meta($organizerId, "mail", true);
            echo '<div class="event__organizer"  style="color: ' . $settings['event_organizer_color'] . '">';
            echo '<div class="event__organizer__name">'.$organizer->name.'</div>';
            echo '<div class="event__organizer__desc">'.$organizer->description.'</div>';
            echo '<div class="event__organizer__phone">'.$phone.'</div>';
            echo '<div class="event__organizer__mail">'.$mail.'</div>';
            echo '</div>';
        }
    }

}
