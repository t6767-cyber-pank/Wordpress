<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


/**
 * Offcanvas Content Widget
 */
class Widget_Eael_Offcanvas extends Widget_Base {

    /**
	 * Retrieve offcanvas widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'eael-offcanvas';
	}

    /**
	 * Retrieve offcanvas widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
    public function get_title() {
        return __( 'EA Offcanvas', 'essential-addons-elementor' );
    }

    /**
	 * Retrieve offcanvas widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-sidebar';
	}

    /**
	 * Retrieve the list of categories the offcanvas widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
    public function get_categories() {
        return [ 'essential-addons-elementor' ];
    }

    /**
	 * Retrieve the list of scripts the offcanvas widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
    public function get_script_depends() {
        return [
			'eael_offcanvas'
		];
    }

    protected function _register_controls() {
		
        /*--------------------------------------*/
            ##  CONTENT TAB    ##
        /*--------------------------------------*/

        /**
         * Content Tab: Offcanvas
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_content_offcanvas',
            [
                'label'                 => __( 'Offcanvas Content', 'essential-addons-elementor' ),
            ]
        );

        $this->add_control(
            'content_type',
            [
                'label'                 => __( 'Content Type', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SELECT,
                'options'               => [
                    'sidebar'   => __( 'Sidebar', 'essential-addons-elementor' ),
                    'custom'    => __( 'Custom Content', 'essential-addons-elementor' ),
                    'section'   => __( 'Saved Section', 'essential-addons-elementor' ),
                    'widget'    => __( 'Saved Widget', 'essential-addons-elementor' ),
                    'template'  => __( 'Saved Page Template', 'essential-addons-elementor' ),
                ],
                'default'               => 'custom',
            ]
		);

        $registered_sidebars = get_registered_sidebars();
		$this->add_control(
            'sidebar',
            [
                'label'                 => __( 'Choose Sidebar', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => array_shift($registered_sidebars),
                'options'               => $registered_sidebars,
				'condition'             => [
					'content_type' => 'sidebar',
				],
            ]
		);
		
		$this->add_control(
            'saved_widget',
            [
                'label'                 => __( 'Choose Widget', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SELECT,
                'options'               => get_page_template_options( 'widget' ),
				'default'               => '-1',
				'condition'             => [
					'content_type'    => 'widget',
				],
            ]
		);
		
		$this->add_control(
            'saved_section',
            [
                'label'                 => __( 'Choose Section', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SELECT,
                'options'               => get_page_template_options( 'section' ),
				'default'               => '-1',
				'condition'             => [
					'content_type'    => 'section',
				],
            ]
        );

        $this->add_control(
            'templates',
            [
                'label'                 => __( 'Choose Template', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SELECT,
                'options'               => get_page_template_options( 'page' ),
				'default'               => '-1',
				'condition'             => [
					'content_type'    => 'template',
				],
            ]
		);
		
		$this->add_control(
			'custom_content',
			[
				'label'                 => '',
				'type'                  => Controls_Manager::REPEATER,
				'default'               => [
					[
						'title'       => __( 'Box 1', 'essential-addons-elementor' ),
						'description' => __( 'Text box description goes here', 'essential-addons-elementor' ),
					],
					[
						'title'       => __( 'Box 2', 'essential-addons-elementor' ),
						'description' => __( 'Text box description goes here', 'essential-addons-elementor' ),
					],
				],
				'fields'                => [
                    [
                        'name'              => 'title',
                        'label'             => __( 'Title', 'essential-addons-elementor' ),
                        'type'              => Controls_Manager::TEXT,
                        'dynamic'           => [
                            'active'   => true,
                        ],
                        'default'           => __( 'Title', 'essential-addons-elementor' ),
                    ],
                    [
                        'name'              => 'description',
                        'label'             => __( 'Description', 'essential-addons-elementor' ),
                        'type'              => Controls_Manager::WYSIWYG,
                        'dynamic'           => [
                            'active'   => true,
                        ],
                        'default'           => '',
                    ],
				],
				'title_field'           => '{{{ title }}}',
                'condition'             => [
                    'content_type'  => 'custom',
                ],
			]
		);

		$this->end_controls_section(); #section_content_offcanvas


		/**
         * Content Tab: Toggle Button
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_button_settings',
            [
                'label'                 => __( 'Toggle Button', 'essential-addons-elementor' ),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label'                 => __( 'Button Text', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::TEXT,
				'dynamic'               => [
					'active'   => true,
				],
                'default'               => __( 'Click Here', 'essential-addons-elementor' ),
            ]
        );

        $this->add_control(
            'button_icon',
            [
                'label'                 => __( 'Button Icon', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::ICON,
                'default'               => '',
            ]
        );
        
        $this->add_control(
            'button_icon_position',
            [
                'label'                 => __( 'Icon Position', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'before',
                'options'               => [
                    'before'    => __( 'Before', 'essential-addons-elementor' ),
                    'after'     => __( 'After', 'essential-addons-elementor' ),
                ],
                'prefix_class'          => 'eael-offcanvas-icon-',
                'condition'             => [
                    'button_icon!'  => '',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'button_icon_spacing',
            [
                'label'                 => __( 'Icon Spacing', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size'      => '5',
                    'unit'      => 'px',
                ],
                'range'                 => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 50,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', '%' ],
                'selectors'             => [
                    '{{WRAPPER}}.eael-offcanvas-icon-before .eael-offcanvas-toggle-icon' => 'margin-right: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}}.eael-offcanvas-icon-after .eael-offcanvas-toggle-icon' => 'margin-left: {{SIZE}}{{UNIT}}',
                ],
				'condition'             => [
                    'button_icon!'  => '',
				],
            ]
        );
        
		$this->end_controls_section();
		
		/**
         * Content Tab: Settings
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_settings',
            [
                'label'                 => __( 'Settings', 'essential-addons-elementor' ),
            ]
        );
        
        $this->add_control(
			'direction',
			[
				'label'                 => __( 'Direction', 'essential-addons-elementor' ),
				'type'                  => Controls_Manager::CHOOSE,
				'label_block'           => false,
				'toggle'                => false,
				'default'               => 'left',
				'options'               => [
					'left'          => [
						'title'     => __( 'Left', 'essential-addons-elementor' ),
						'icon'      => 'eicon-h-align-left',
					],
					'right'         => [
						'title'     => __( 'Right', 'essential-addons-elementor' ),
						'icon'      => 'eicon-h-align-right',
					],
				],
				'frontend_available'    => true,
			]
		);

		$this->add_control(
			'content_transition',
			[
				'label'                 => __( 'Content Transition', 'essential-addons-elementor' ),
				'type'                  => Controls_Manager::SELECT,
				'default'               => 'slide',
				'options'               => [
					'slide'        			=> __( 'Slide', 'essential-addons-elementor' ),
					'reveal'       			=> __( 'Reveal', 'essential-addons-elementor' ),
					'push'         			=> __( 'Push', 'essential-addons-elementor' ),
					'slide-along'  	        => __( 'Slide Along', 'essential-addons-elementor' ),
				],
				'frontend_available'    => true,
				'separator'             => 'before',
			]
		);
        
        $this->add_control(
            'close_button',
            [
                'label'             => __( 'Show Close Button', 'essential-addons-elementor' ),
                'type'              => Controls_Manager::SWITCHER,
                'default'           => 'yes',
                'label_on'          => __( 'Yes', 'essential-addons-elementor' ),
                'label_off'         => __( 'No', 'essential-addons-elementor' ),
                'return_value'      => 'yes',
                'separator'         => 'before',
            ]
        );
        
        $this->add_control(
            'esc_close',
            [
                'label'             => __( 'Esc to Close', 'essential-addons-elementor' ),
                'type'              => Controls_Manager::SWITCHER,
                'default'           => 'yes',
                'label_on'          => __( 'Yes', 'essential-addons-elementor' ),
                'label_off'         => __( 'No', 'essential-addons-elementor' ),
                'return_value'      => 'yes',
            ]
		);
		
		$this->add_control(
            'body_click_close',
            [
                'label'             => __( 'Click anywhere to Close', 'essential-addons-elementor' ),
                'type'              => Controls_Manager::SWITCHER,
                'default'           => 'yes',
                'label_on'          => __( 'Yes', 'essential-addons-elementor' ),
                'label_off'         => __( 'No', 'essential-addons-elementor' ),
                'return_value'      => 'yes',
            ]
        );

        $this->end_controls_section();


		/*-----------------------------------------------------------------------------------*/
        /*	STYLE TAB
        /*-----------------------------------------------------------------------------------*/
        
        /**
         * Style Tab: Offcanvas Bar
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_offcanvas_bar_style',
            [
                'label'                 => __( 'Offcanvas Bar', 'essential-addons-elementor' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'                  => 'offcanvas_bar_bg',
                'label'                 => __( 'Background', 'essential-addons-elementor' ),
                'types'                 => [ 'classic', 'gradient' ],
                'selector'              => '.eael-offcanvas-content-{{ID}}',
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'offcanvas_bar_border',
				'label'                 => __( 'Border', 'essential-addons-elementor' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'selector'              => '.eael-offcanvas-content-{{ID}}',
			]
		);

		$this->add_control(
			'offcanvas_bar_border_radius',
			[
				'label'                 => __( 'Border Radius', 'essential-addons-elementor' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'.eael-offcanvas-content-{{ID}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'offcanvas_bar_padding',
			[
				'label'                 => __( 'Padding', 'essential-addons-elementor' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'selectors'             => [
					'.eael-offcanvas-content-{{ID}} .eael-offcanvas-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'                  => 'offcanvas_bar_box_shadow',
				'selector'              => '.eael-offcanvas-content-{{ID}}',
				'separator'             => 'before',
			]
		);

        $this->end_controls_section();

        /**
         * Style Tab: Content
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_popup_content_style',
            [
                'label'                 => __( 'Content', 'essential-addons-elementor' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
				'condition'             => [
					'content_type'      => [ 'sidebar', 'custom' ],
				],
            ]
        );
        
        $this->add_responsive_control(
			'content_align',
			[
				'label'                 => __( 'Alignment', 'essential-addons-elementor' ),
				'type'                  => Controls_Manager::CHOOSE,
				'options'               => [
					'left'      => [
						'title' => __( 'Left', 'essential-addons-elementor' ),
						'icon'  => 'fa fa-align-left',
					],
					'center'    => [
						'title' => __( 'Center', 'essential-addons-elementor' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'     => [
						'title' => __( 'Right', 'essential-addons-elementor' ),
						'icon'  => 'fa fa-align-right',
					],
					'justify'   => [
						'title' => __( 'Justified', 'essential-addons-elementor' ),
						'icon'  => 'fa fa-align-justify',
					],
				],
				'default'               => '',
				'selectors'             => [
					'.eael-offcanvas-content-{{ID}} .eael-offcanvas-body'   => 'text-align: {{VALUE}};',
				],
			]
		);
        
        $this->add_control(
            'widget_heading',
            [
                'label'                 => __( 'Box', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
				'condition'             => [
					'content_type'      => [ 'sidebar', 'custom' ],
				],
            ]
        );

        $this->add_control(
            'widgets_bg_color',
            [
                'label'                 => __( 'Background Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '.eael-offcanvas-content-{{ID}} .eael-offcanvas-custom-widget, .eael-offcanvas-content-{{ID}} .widget' => 'background-color: {{VALUE}}',
                ],
				'condition'             => [
					'content_type'      => [ 'sidebar', 'custom' ],
				],
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'widgets_border',
				'label'                 => __( 'Border', 'essential-addons-elementor' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'selector'              => '.eael-offcanvas-content-{{ID}} .eael-offcanvas-custom-widget, .eael-offcanvas-content-{{ID}} .widget',
				'condition'             => [
					'content_type'      => [ 'sidebar', 'custom' ],
				],
			]
		);

		$this->add_control(
			'widgets_border_radius',
			[
				'label'                 => __( 'Border Radius', 'essential-addons-elementor' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'.eael-offcanvas-content-{{ID}} .eael-offcanvas-custom-widget, .eael-offcanvas-content-{{ID}} .widget' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'             => [
					'content_type'      => [ 'sidebar', 'custom' ],
				],
			]
		);
        
        $this->add_responsive_control(
            'widgets_bottom_spacing',
            [
                'label'                 => __( 'Bottom Spacing', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size'      => '20',
                    'unit'      => 'px',
                ],
                'range'                 => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 60,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', '%' ],
                'selectors'             => [
                    '.eael-offcanvas-content-{{ID}} .eael-offcanvas-custom-widget, .eael-offcanvas-content-{{ID}} .widget' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
				'condition'             => [
					'content_type'      => [ 'sidebar', 'custom' ],
				],
            ]
        );

		$this->add_responsive_control(
			'widgets_padding',
			[
				'label'                 => __( 'Padding', 'essential-addons-elementor' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'selectors'             => [
					'.eael-offcanvas-content-{{ID}} .eael-offcanvas-custom-widget, .eael-offcanvas-content-{{ID}} .widget' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'             => [
					'content_type'      => [ 'sidebar', 'custom' ],
				],
			]
		);
        
        $this->add_control(
            'text_heading',
            [
                'label'                 => __( 'Text', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
				'condition'             => [
					'content_type'      => [ 'sidebar', 'custom' ],
				],
            ]
        );

        $this->add_control(
            'content_text_color',
            [
                'label'                 => __( 'Text Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '.eael-offcanvas-content-{{ID}} .eael-offcanvas-body, .eael-offcanvas-content-{{ID}} .eael-offcanvas-body *:not(.fa):not(.eicon)' => 'color: {{VALUE}}',
                ],
				'condition'             => [
					'content_type'      => [ 'sidebar', 'custom' ],
				],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'text_typography',
                'label'                 => __( 'Typography', 'essential-addons-elementor' ),
                'scheme'                => Scheme_Typography::TYPOGRAPHY_4,
                'selector'              => '.eael-offcanvas-content-{{ID}} .eael-offcanvas-body, .eael-offcanvas-content-{{ID}} .eael-offcanvas-body *:not(.fa):not(.eicon)',
				'condition'             => [
					'content_type'      => [ 'sidebar', 'custom' ],
				],
            ]
        );
        
        $this->add_control(
            'links_heading',
            [
                'label'                 => __( 'Links', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
				'condition'             => [
					'content_type'      => [ 'sidebar', 'custom' ],
				],
            ]
        );

        $this->start_controls_tabs( 'tabs_links_style' );

        $this->start_controls_tab(
            'tab_links_normal',
            [
                'label'                 => __( 'Normal', 'essential-addons-elementor' ),
				'condition'             => [
					'content_type'      => [ 'sidebar', 'custom' ],
				],
            ]
        );

        $this->add_control(
            'content_links_color',
            [
                'label'                 => __( 'Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '.eael-offcanvas-content-{{ID}} .eael-offcanvas-body a' => 'color: {{VALUE}}',
                ],
				'condition'             => [
					'content_type'      => [ 'sidebar', 'custom' ],
				],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'links_typography',
                'label'                 => __( 'Typography', 'essential-addons-elementor' ),
                'scheme'                => Scheme_Typography::TYPOGRAPHY_4,
                'selector'              => '.eael-offcanvas-content-{{ID}} .eael-offcanvas-body a',
				'condition'             => [
					'content_type'      => [ 'sidebar', 'custom' ],
				],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_links_hover',
            [
                'label'                 => __( 'Hover', 'essential-addons-elementor' ),
				'condition'             => [
					'content_type'      => [ 'sidebar', 'custom' ],
				],
            ]
        );

        $this->add_control(
            'content_links_color_hover',
            [
                'label'                 => __( 'Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '.eael-offcanvas-content-{{ID}} .eael-offcanvas-body a:hover' => 'color: {{VALUE}}',
                ],
				'condition'             => [
					'content_type'      => [ 'sidebar', 'custom' ],
				],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

		$this->end_controls_section();
		

		/**
         * Style Tab: Icon
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_icon_style',
            [
                'label'                 => __( 'Icon', 'essential-addons-elementor' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
				'condition'             => [
					'trigger'       => 'on-click',
					'trigger_type!' => 'button',
				],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'                 => __( 'Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .eael-trigger-icon' => 'color: {{VALUE}}',
                ],
				'condition'             => [
					'trigger'       => 'on-click',
					'trigger_type'  => 'icon',
				],
            ]
        );
        
        $this->add_responsive_control(
            'icon_size',
            [
                'label'                 => __( 'Size', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size'      => '28',
                    'unit'      => 'px',
                ],
                'range'                 => [
                    'px'        => [
                        'min'   => 10,
                        'max'   => 80,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .eael-trigger-icon' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
				'condition'             => [
					'trigger'       => 'on-click',
					'trigger_type'  => 'icon',
				],
            ]
        );
        
        $this->add_responsive_control(
            'icon_image_width',
            [
                'label'                 => __( 'Width', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px'        => [
                        'min'   => 10,
                        'max'   => 1200,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .eael-trigger-image' => 'width: {{SIZE}}{{UNIT}}',
                ],
				'condition'             => [
					'trigger'       => 'on-click',
					'trigger_type'  => 'image',
				],
            ]
        );
        
        $this->end_controls_section();

        /**
         * Style Tab: Toggle Button
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_toggle_button_style',
            [
                'label'                 => __( 'Toggle Button', 'essential-addons-elementor' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
			'button_align',
			[
				'label'                 => __( 'Alignment', 'essential-addons-elementor' ),
				'type'                  => Controls_Manager::CHOOSE,
				'default'               => 'left',
				'options'               => [
					'left'          => [
						'title'     => __( 'Left', 'essential-addons-elementor' ),
						'icon'      => 'eicon-h-align-left',
					],
					'center'        => [
						'title'     => __( 'Center', 'essential-addons-elementor' ),
						'icon'      => 'eicon-h-align-center',
					],
					'right'         => [
						'title'     => __( 'Right', 'essential-addons-elementor' ),
						'icon'      => 'eicon-h-align-right',
					],
				],
				'selectors'             => [
					'{{WRAPPER}} .eael-offcanvas-toggle-wrap'   => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_size',
			[
				'label'                 => __( 'Size', 'essential-addons-elementor' ),
				'type'                  => Controls_Manager::SELECT,
				'default'               => 'md',
				'options'               => [
					'xs' => __( 'Extra Small', 'essential-addons-elementor' ),
					'sm' => __( 'Small', 'essential-addons-elementor' ),
					'md' => __( 'Medium', 'essential-addons-elementor' ),
					'lg' => __( 'Large', 'essential-addons-elementor' ),
					'xl' => __( 'Extra Large', 'essential-addons-elementor' ),
				],
			]
		);

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label'                 => __( 'Normal', 'essential-addons-elementor' ),
            ]
        );

        $this->add_control(
            'button_bg_color_normal',
            [
                'label'                 => __( 'Background Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .eael-offcanvas-toggle' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_text_color_normal',
            [
                'label'                 => __( 'Text Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .eael-offcanvas-toggle' => 'color: {{VALUE}}',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'button_border_normal',
				'label'                 => __( 'Border', 'essential-addons-elementor' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'selector'              => '{{WRAPPER}} .eael-offcanvas-toggle',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label'                 => __( 'Border Radius', 'essential-addons-elementor' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .eael-offcanvas-toggle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'button_typography',
                'label'                 => __( 'Typography', 'essential-addons-elementor' ),
                'scheme'                => Scheme_Typography::TYPOGRAPHY_4,
                'selector'              => '{{WRAPPER}} .eael-offcanvas-toggle',
            ]
        );

		$this->add_responsive_control(
			'button_padding',
			[
				'label'                 => __( 'Padding', 'essential-addons-elementor' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .eael-offcanvas-toggle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'                  => 'button_box_shadow',
				'selector'              => '{{WRAPPER}} .eael-offcanvas-toggle',
			]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label'                 => __( 'Hover', 'essential-addons-elementor' ),
            ]
        );

        $this->add_control(
            'button_bg_color_hover',
            [
                'label'                 => __( 'Background Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .eael-offcanvas-toggle:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_text_color_hover',
            [
                'label'                 => __( 'Text Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .eael-offcanvas-toggle:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_border_color_hover',
            [
                'label'                 => __( 'Border Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .eael-offcanvas-toggle:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );

		$this->add_control(
			'button_animation',
			[
				'label'                 => __( 'Animation', 'essential-addons-elementor' ),
				'type'                  => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'                  => 'button_box_shadow_hover',
				'selector'              => '{{WRAPPER}} .eael-offcanvas-toggle:hover',
			]
		);

		$this->end_controls_tab();

        $this->end_controls_tabs();
        
		$this->end_controls_section();
		
		/**
         * Style Tab: Close Button
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_close_button_style',
            [
                'label'                 => __( 'Close Button', 'essential-addons-elementor' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
				'condition'             => [
					'close_button' => 'yes',
				],
            ]
		);

        $this->add_control(
            'close_button_icon',
            [
                'label'                 => __( 'Button Icon', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::ICON,
                'default'               => 'fa fa-close',
				'condition'             => [
					'close_button' => 'yes',
				],
            ]
        );

		$this->add_control(
            'close_button_text_color',
            [
                'label'                 => __( 'Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '.eael-offcanvas-close-{{ID}}' => 'color: {{VALUE}}',
                ],
				'condition'             => [
					'close_button' => 'yes',
				],
            ]
        );
        
        $this->add_responsive_control(
            'close_button_size',
            [
                'label'                 => __( 'Size', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size'      => '28',
                    'unit'      => 'px',
                ],
                'range'                 => [
                    'px'        => [
                        'min'   => 10,
                        'max'   => 80,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', '%' ],
                'selectors'             => [
                    '.eael-offcanvas-content-{{ID}} .eael-offcanvas-close-{{ID}}' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
				'condition'             => [
					'close_button' => 'yes',
				],
            ]
        );
		
		$this->end_controls_section();
		
		/**
         * Style Tab: Overlay
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_overlay_style',
            [
                'label'                 => __( 'Overlay', 'essential-addons-elementor' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
		);

		$this->add_control(
            'overlay_bg_color',
            [
                'label'                 => __( 'Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '.eael-offcanvas-content-{{ID}}-open .eael-offcanvas-container:after' => 'background: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'overlay_opacity',
            [
                'label'                 => __( 'Opacity', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 1,
                        'step'  => 0.01,
                    ],
                ],
				'selectors'             => [
					'.eael-offcanvas-content-{{ID}}-open .eael-offcanvas-container:after' => 'opacity: {{SIZE}};',
				],
            ]
        );
        
		$this->end_controls_section();

    }

    /**
	 * Render close button for offcanvas output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
    protected function render_close_button() {
        $settings = $this->get_settings_for_display();

        if( $settings['close_button'] != 'yes' ) return;

        $this->add_render_attribute(
            'close-button', 'class',
            [
                'eael-offcanvas-close',
                'eael-offcanvas-close-'.esc_attr($this->get_id())
            ]
        );

        $this->add_render_attribute( 'close-button', 'role', 'button' );
        ?>
        <div class="eael-offcanvas-header">
            <div <?php echo $this->get_render_attribute_string('close-button'); ?>>
                <?php if( $settings['close_button_icon'] != '' ) { ?>
                    <span class="<?php echo esc_attr($settings['close_button_icon']); ?>"></span>
                <?php } else{ ?>
                <span class="fa fa-close"></span>
                <?php } // end of if( $settings['close_button_icon'] != '' ) ?>
            </div>
        </div>
        <?php

    }

    /**
	 * Render sidebars for output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
    protected function render_sidebar() {
        $settings = $this->get_settings_for_display();
        $sidebar  = $settings['sidebar'];

        if( empty( $sidebar ) ) return;

        dynamic_sidebar( $sidebar );
    }

    /**
	 * Render custom template or saved template output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
    protected function render_custom_content() {
        $settings = $this->get_settings_for_display();

        if( count($settings['custom_content']) ) {
            foreach($settings['custom_content'] as $key => $item) {
                ?>
                <div class="eael-offcanvas-custom-widget">
                    <h3 class="eael-offcanvas-widget-title"><?php echo $item['title']; ?></h3>
                    <div class="eael-offcanvas-widget-content">
                        <?php echo $item['description']; ?>
                    </div>
                </div>
                <?php
            }
        }

    }


	/**
	 * Render offcanvas content widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $setting_attr = [
            'content_id'       => esc_attr( $this->get_id() ),
            'direction'        => esc_attr( $settings['direction'] ),
            'transition'       => esc_attr( $settings['content_transition'] ),
            'esc_close'        => esc_attr( $settings['esc_close'] ),
            'body_click_close' => esc_attr( $settings['body_click_close'] )
        ];


        $this->add_render_attribute(
            'content-wrap',
            [
                'class' => 'eael-offcanvas-content-wrap',
                'data-settings' => htmlspecialchars(json_encode($setting_attr))
            ]
        );

        $this->add_render_attribute(
            'content',
            [
                'class' => [
                    'eael-offcanvas-content',
                    'eael-offcanvas-content-'.esc_attr($this->get_id()),
                    'eael-offcanvas-'.$setting_attr['transition'],
                    'elementor-element-'.$this->get_id(),
                    'eael-offcanvas-content-'.$setting_attr['direction']
                ]
            ]
        );

        $this->add_render_attribute(
            'toggle-button',
            [
                'class' => [
                    'eael-offcanvas-toggle',
                    'eael-offcanvas-toogle-'.esc_attr( $this->get_id() ),
                    'elementor-button',
                    'elementor-size-'.esc_attr( $settings['button_size'] )
                ]
            ]
        );

        if( $settings['button_animation'] ) {
            $this->add_render_attribute('toggle-button', 'class', 'elementor-animation-'.esc_attr( $settings['button_animation']));
        }

        ?>
        <div <?php echo $this->get_render_attribute_string( 'content-wrap' ); ?>>

            <?php if( $settings['button_text'] != '' || $settings['button_text'] != '' ) : ?>
            <div class="eael-offcanvas-toggle-wrap">
                <div <?php echo $this->get_render_attribute_string('toggle-button'); ?>>
                    <?php if( ! empty($settings['button_icon'] ) ) : ?>
                        <span class="eael-offcanvas-toggle-icon <?php echo esc_attr($settings['button_icon']); ?>"></span>
                    <?php endif; ?>
                    <span class="eael-toggle-text">
                        <?php echo $settings['button_text']; ?>
                    </span>
                </div>
            </div>
            <?php endif; // end of if( $settings['button_text'] != '' || $settings['button_text'] != '' ) ?>

            <div <?php echo $this->get_render_attribute_string('content'); ?>>
                <?php $this->render_close_button(); ?>
                <div class="eael-offcanvas-body">
                    <?php
                        if( 'sidebar' == $settings['content_type'] ) {

                            $this->render_sidebar();

                        }else if( 'custom' == $settings['content_type'] ) {

                            $this->render_custom_content();

                        }else if( 'section' == $settings['content_type'] && ! empty($settings['saved_section']) ) {

                            echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $settings['saved_section'] );

                        } elseif ( 'template' == $settings['content_type'] && !empty( $settings['templates'] ) ) {
                        
                            echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $settings['templates'] );
                            
                        } elseif ( 'widget' == $settings['content_type'] && !empty( $settings['saved_widget'] ) ) {
    
                            echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $settings['saved_widget'] );
    
                        }
                    ?>
                </div><!-- /.eael-offcanvas-body -->
            </div>
        </div>
        <?php
       
	}
	

	protected function content_template() {}
}


Plugin::instance()->widgets_manager->register_widget_type( new Widget_Eael_Offcanvas() );