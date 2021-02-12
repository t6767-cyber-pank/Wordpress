<?php
class Tabs_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'TabsName';
    }

    public function get_title() {
        return __( 'TabsVasterra');
    }

    public function get_icon() {
        return 'fas fa-atom';
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

        $this->add_control(
            'title1',
            [
                'label' => __( 'Title1'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => __( 'default: Title'),
                'default' => __( 'Title'),
            ]
        );

        $this->add_control(
            'content1',
            [
                'label' => __( 'Content1'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'input_type' => 'url',
                'placeholder' => __( 'default: Content'),
                'default' => __( 'Default content'),
            ]
        );

        $this->add_control(
            'title2',
            [
                'label' => __( 'Title2'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => __( 'default: Title'),
                'default' => __( 'Title'),
            ]
        );

        $this->add_control(
            'content2',
            [
                'label' => __( 'Content2'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'input_type' => 'url',
                'placeholder' => __( 'default: Content'),
                'default' => __( 'Default content'),
            ]
        );

        $this->add_control(
            'title3',
            [
                'label' => __( 'Title3'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => __( 'default: Title'),
                'default' => __( 'Title'),
            ]
        );

        $this->add_control(
            'content3',
            [
                'label' => __( 'Content3'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'input_type' => 'url',
                'placeholder' => __( 'default: Content'),
                'default' => __( 'Default content'),
            ]
        );

        $this->add_control(
            'title4',
            [
                'label' => __( 'Title4'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => __( 'default: Title'),
                'default' => __( 'Title'),
            ]
        );

        $this->add_control(
            'content4',
            [
                'label' => __( 'Content4'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'input_type' => 'url',
                'placeholder' => __( 'default: Content'),
                'default' => __( 'Default content'),
            ]
        );

        $this->add_control(
            'title5',
            [
                'label' => __( 'Title5'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => __( 'default: Title'),
                'default' => __( 'Title'),
            ]
        );

        $this->add_control(
            'content5',
            [
                'label' => __( 'Content5'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'input_type' => 'url',
                'placeholder' => __( 'default: Content'),
                'default' => __( 'Default content'),
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <style>
            .nav-pills>li.active>a {
                opacity: 1;
                color: #fff;
                background-color: <?=$settings['title_color']?>;
                border-radius: 0px;
            }

            .nav>li>a:focus, .nav>li>a:hover {
                border-radius: 0px;
            }

            .nav-pills>li.active>a:hover {
                color: #fff;
                background-color: <?=$settings['title_color']?>;
            }
            .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover {
                color: #fff;
                background-color: <?=$settings['title_color']?>;
            }

            .nav-pills>li+li {
                margin-left: 55px;
                font-size: 20px;
            }

            .nav li:first-child {
                margin-left: 55px !important;
                font-size: 20px;
            }
        </style>
        <ul class="nav nav-pills">
            <li class="active"><a data-toggle="pill" href="#menu"><?=$settings['title1']?></a></li>
            <li><a data-toggle="pill" href="#menu1"><?=$settings['title2']?></a></li>
            <li><a data-toggle="pill" href="#menu2"><?=$settings['title3']?></a></li>
            <li><a data-toggle="pill" href="#menu3"><?=$settings['title4']?></a></li>
            <li><a data-toggle="pill" href="#menu4"><?=$settings['title5']?></a></li>
        </ul>

        <div class="tab-content">
            <div id="menu" class="tab-pane fade in active">
                <?=$settings['content1']?>
            </div>
            <div id="menu1" class="tab-pane fade">
                <?=$settings['content2']?>
            </div>
            <div id="menu2" class="tab-pane fade">
                <?=$settings['content3']?>
            </div>
            <div id="menu3" class="tab-pane fade">
                <?=$settings['content4']?>
            </div>
            <div id="menu4" class="tab-pane fade">
                <?=$settings['content5']?>
            </div>
        </div>
        <script>
            try {
            hidealltabs();
            document.getElementById("tab5").style.display = "block";
            document.querySelector("#hhh5 a").style.color="red";


            document.getElementById("hhh1").addEventListener("click", function() {
                hidealltabs();
                document.getElementById("tab1").style.display = "block";
                document.querySelector("#hhh1 a").style.color="red";
            });


            document.getElementById("hhh2").addEventListener("click", function() {
                hidealltabs();
                document.getElementById("tab3").style.display = "block";
                document.querySelector("#hhh2 a").style.color="red";
            });


            document.getElementById("hhh3").addEventListener("click", function() {
                hidealltabs();
                document.getElementById("tab2").style.display = "block";
                document.querySelector("#hhh3 a").style.color="red";
            });


            document.getElementById("hhh4").addEventListener("click", function() {
                hidealltabs();
                document.getElementById("tab4").style.display = "block";
                document.querySelector("#hhh4 a").style.color="red";
            });


            document.getElementById("hhh5").addEventListener("click", function() {
                hidealltabs();
                document.getElementById("tab5").style.display = "block";
                document.querySelector("#hhh5 a").style.color="red";
            });
            }
            catch(err) {
                console.log(err.message);
            }

            function hidealltabs()
            {
                document.getElementById("tab1").style.display = "none";
                document.getElementById("tab2").style.display = "none";
                document.getElementById("tab3").style.display = "none";
                document.getElementById("tab4").style.display = "none";
                document.getElementById("tab5").style.display = "none";
                document.querySelector("#hhh5 a").style.color="black";
                document.querySelector("#hhh4 a").style.color="black";
                document.querySelector("#hhh3 a").style.color="black";
                document.querySelector("#hhh2 a").style.color="black";
                document.querySelector("#hhh1 a").style.color="black";
            }
        </script>
        <?php
    }

    protected function _content_template() {}

}
