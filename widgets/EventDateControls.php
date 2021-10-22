<?php
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
      'label' => __('Date typography', 'mec_lite_dp'),
      'selector' => '{{WRAPPER}} .event__date',
    ]
);

$this->add_group_control(
    \Elementor\Group_Control_Typography::get_type(),
    [
      'name' => 'time_typography',
      'label' => __('Time typography', 'mec_lite_dp'),
      'selector' => '{{WRAPPER}} .event__time',
    ]
);

$this->add_control(
    'event_date_color',
    [
        'label' => __('Title Color', 'mec_lite_dp'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'scheme' => [
            'type' => \Elementor\Scheme_Color::get_type(),
            'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'selectors' => [
            '{{WRAPPER}} .event__datetime' => 'color: {{VALUE}}',
        ],
    ]
);

$this->add_control(
    'event_time_color',
    [
        'label' => __('Title Color', 'mec_lite_dp'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'scheme' => [
            'type' => \Elementor\Scheme_Color::get_type(),
            'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'selectors' => [
            '{{WRAPPER}} .event__time' => 'color: {{VALUE}}',
        ],
    ]
);

$this->end_controls_section();
