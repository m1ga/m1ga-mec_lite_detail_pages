<?php
/**
* Plugin Name: Modern Events Calendar Lite - Detail pages
* Plugin URI: https://github.com/m1ga/mec_lite_elementor
* Description: Link to normal pages for Modern Events Calendar Lite event details and edit them with Elementor
* Version: 1.1
* Author: Michael Gangolf
* Author URI: https://www.migaweb.de/
**/

add_action('admin_init', 'mec_lite_dp_register_settings');
add_action('admin_menu', 'addMenu');
add_action('init', 'custom_rewrite_rules');
add_action('wp_enqueue_scripts', 'enqueue_style');

function mec_lite_dp_register_settings()
{
    add_option('mec_lite_dp', "");
    register_setting('mec_lite_dp_option_group', 'mec_lite_dp', 'sanitize_text_field');
}

function enqueue_style()
{
    wp_register_style('mec_lite_dp', plugins_url('style.css', __FILE__));
    wp_enqueue_style('mec_lite_dp');
}

function custom_rewrite_rules()
{
    add_rewrite_rule(
        'events/?([^/]*)/?',
        'index.php?page_id=' . get_option('mec_lite_dp').'&event_id=$matches[1]',
        'top'
    );
}

function mec_lite_dp_query_vars($vars)
{
    $vars[] = 'event_id';
    return $vars;
}
add_filter('query_vars', 'mec_lite_dp_query_vars');

function addMenu()
{
    add_submenu_page("mec-intro", "Custom detail page", "Custom detail page", "manage_options", "mec-set-detailpage", "mec_set_detailpage");
}

function mec_set_detailpage()
{
    echo '<div class="wrap">
	<h1>Custom detail page</h1>
	<form method="post" action="options.php">';

    $text = get_option('mec_lite_dp');
    printf(
        '<h3>Detail page id</h3>
        <p>Insert the ID of your detail page</p>
        <input type="text" id="mec_lite_dp" name="mec_lite_dp" value="%s" />',
        esc_attr($text)
    );

    settings_fields('mec_lite_dp_option_group');
    submit_button();

    echo '</form></div>';
    flush_rewrite_rules();
}



use Elementor\Plugin;

add_action('init', static function () {
    require_once(__DIR__ . '/widgets/EventTitle.php');
    require_once(__DIR__ . '/widgets/EventDateStart.php');
    require_once(__DIR__ . '/widgets/EventDateEnd.php');
    require_once(__DIR__ . '/widgets/EventContent.php');
    require_once(__DIR__ . '/widgets/EventPlace.php');
    require_once(__DIR__ . '/widgets/EventPlaceImage.php');
    require_once(__DIR__ . '/widgets/EventOrganizerImage.php');
    require_once(__DIR__ . '/widgets/EventOrganizer.php');
    \Elementor\Plugin::instance()->widgets_manager->register(new \Elementor_Widget_MCE_EventTitle());
    \Elementor\Plugin::instance()->widgets_manager->register(new \Elementor_Widget_MCE_EventDateStart());
    \Elementor\Plugin::instance()->widgets_manager->register(new \Elementor_Widget_MCE_EventDateEnd());
    \Elementor\Plugin::instance()->widgets_manager->register(new \Elementor_Widget_MCE_EventContent());
    \Elementor\Plugin::instance()->widgets_manager->register(new \Elementor_Widget_MCE_EventPlace());
    \Elementor\Plugin::instance()->widgets_manager->register(new \Elementor_Widget_MCE_EventPlaceImage());
    \Elementor\Plugin::instance()->widgets_manager->register(new \Elementor_Widget_MCE_EventOrganizerImage());
    \Elementor\Plugin::instance()->widgets_manager->register(new \Elementor_Widget_MCE_EventOrganizer());
});


function add_elementor_widget_categories($elements_manager)
{
    $elements_manager->add_category(
        'mec_lite_dp',
        [
            'title' => __('MCE Lite Components', 'mec_lite_dp'),
            'icon' => 'fa fa-plug',
        ]
    );
}
add_action('elementor/elements/categories_registered', 'add_elementor_widget_categories');
