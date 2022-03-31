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
        require("EventDateControls.php");
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $var_get = 'mec_end_date';
        $var_get2 = 'mec_end_day_seconds';
        require("EventDateRender.php");
    }
}
