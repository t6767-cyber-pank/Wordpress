<?php
class Timur_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'TimurName';
	}

	public function get_title() {
		return __( 'modal Window');
	}

	public function get_icon() {
		return 'fas fa-ankh';
	}

	public function get_categories() {
		return [ 'general' ];
	}
	
	protected function _register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'url',
				'placeholder' => __( 'default: ModalTitle'),
                'default' => __( 'Default title'),
			]
		);
		
		$this->add_control(
			'content',
			[
				'label' => __( 'Content'),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'input_type' => 'url',
				'placeholder' => __( 'default: Content'),
                'default' => __( 'Default content'),
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Style'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'direction',
            [
                'label' => __( 'Direction'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => __( 'default: rtl'),
                'default' => __( 'rtl'),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'modal_header_typography',
                'label' => __( 'modal header Typography'),
                'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .textheader',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'modal_content_typography',
                'label' => __( 'modal content Typography'),
                'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .textcontent',
            ]
        );

        $this->end_controls_section();

    }

	protected function render() {
	    $a=rand(1,100000);
        $b=rand(1,100000);
        $c=rand(1,100000);
        $x=$a.$b.$c;
        $settings = $this->get_settings_for_display();
        ?>
        <style>
            .close<?=$x?> {
                float: <?php if($settings['direction']=="rtl") echo "left"; else echo "right"; ?>;
                font-size: 21px;
                font-weight: 700;
                line-height: 1;
                color: #000;
                text-shadow: 0 1px 0 #fff;
                filter: alpha(opacity=20);
                opacity: .2;
                width: 20px;
                margin-top: -20px;
                padding: 0px;
            }
            .modal-content<?=$x?>{
                direction: <?=$settings['direction'] ?>;
            }
            .modal-dialog
            {
                top: 30%;
            }
        </style>
        <div class="container">
            <button type="button" class="btn btn-lg" id="myBtn<?=$x?>"  style="margin: 0px; padding: 0px; color: <?=$settings['title_color']?>"><?=$settings['title']?></button>
            <div class="modal fade" id="myModal<?=$x?>" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content modal-content<?=$x?>">
                        <div class="modal-header">
                            <button type="button" class="close<?=$x?>" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title textheader"><?=$settings['title']?></h4>
                        </div>
                        <div class="modal-body textcontent">
                            <?=$settings['content'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function(){
                $("#myBtn<?=$x?>").click(function(){
                    $("#myModal<?=$x?>").modal();
                });
            });
        </script>
        <?php
	}

	protected function _content_template() {}

}
