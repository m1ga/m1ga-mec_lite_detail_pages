<?php
$args = array("post_type" => "mec-events", "name" => get_query_var("event_id"));
$query = get_posts($args);
$id = $query[0]->ID;
$meta = get_post_meta($id);

$allday = get_post_meta($id, 'mec_allday', true);
$date = strtotime(get_post_meta($id, $var_get, true));
$formatedDate = date($settings['date_format'], $date);

echo '<div class="event__datetime">';
if ($settings["show_date"]) {
    echo '<time class="event__date" datetime="'.$formatedDate. ' ' . $formatedTime.'" style="color: ' . $settings['event_date_color'] . '">'. $formatedDate .'</time>';
}
if (!$allday) {
    if ($settings["show_time"]) {
        $seconds = get_post_meta($id, $var_get2, true);
        $formatedTime = date($settings['time_format'], $seconds);
        echo '<time class="event__time" datetime="'.$formatedDate. ' ' . $formatedTime.'" style="color: ' . $settings['event_time_color'] . '">'. $formatedTime .'</time>';
    }
} else {
    if ($settings["show_allday"]) {
        echo '<time class="event__time" datetime="'.$formatedDate.'" style="color: ' . $settings['event_time_color'] . '">'. $settings['allday_text'] .'</time>';
    }
}
echo '</div>';
