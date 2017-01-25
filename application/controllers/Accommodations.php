<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Accommodations extends Public_Controller {

        public function __construct() {
                parent::__construct();
                $this->load->model(array('Room_type_model', 'Room_model'));
        }

        public function index() {
                $this->data['title_top'] = get_class();
                $this->data['title_top_desc'] = 'my desc';

                $this->template['image_top_header'] = $this->_render_page('public/_templates/image_top_header', $this->data, TRUE);
                $this->template['room_types'] = $this->Room_type_model->where(array('room_type_active' => TRUE))->as_object()->get_all();
                $this->template['rooms'] = $this->Room_model->where(array('room_active' => TRUE))->with_room_type()->as_object()->get_all();

                $this->_render_public_page(get_class(), $this, 'public/accomodation', $this->template);
        }

        public function resources($bootstrap_dir = NULL) {
                if (is_null($bootstrap_dir)) {
                        show_404();
                }
                return ' <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic|Playfair+Display:400,400italic,700,700italic,900,900italic" rel="stylesheet" type="text/css">
                        <!--Bootstrap -->
                        <link href = "' . $bootstrap_dir . 'css/bootstrap.min.css" rel = "stylesheet">
                        <link href = "' . $bootstrap_dir . 'css/font-awesome.min.css" rel = "stylesheet">

                        <link href = "' . $bootstrap_dir . 'css/owl.carousel.css" rel = "stylesheet">
                        <link href = "' . $bootstrap_dir . 'css/owl.theme.css" rel = "stylesheet">
                        <link href = "' . $bootstrap_dir . 'css/owl.transitions.css" rel = "stylesheet">
                        <link href = "' . $bootstrap_dir . 'css/cs-select.css" rel = "stylesheet">
                        <link href = "' . $bootstrap_dir . 'css/bootstrap-datepicker3.min.css" rel = "stylesheet">
                        <link href = "' . $bootstrap_dir . 'css/freepik.hotels.css" rel = "stylesheet">
                        <link href = "' . $bootstrap_dir . 'css/nivo-lightbox.css" rel = "stylesheet">
                        <link href = "' . $bootstrap_dir . 'css/nivo-lightbox-theme.css" rel = "stylesheet">
                        <link href = "' . $bootstrap_dir . 'css/style.css" rel = "stylesheet">




                        <!--HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
                        <!--WARNING: Respond.js doesn\'t work if you view the page via file:// -->
                            <!--[if lt IE 9]>
                            <script src="' . $bootstrap_dir . 'js/html5shiv.min.js"></script>
                            <script src="' . $bootstrap_dir . 'js/respond.min.js"></script>
                            <![endif]-->

                            <script src="' . $bootstrap_dir . 'js/modernizr.custom.min.js"></script>';
        }

        public function resources_footer($bootstrap_dir = NULL) {
                if (is_null($bootstrap_dir)) {
                        show_404();
                }
                return '<!-- jQuery (necessary for Bootstrap\'s JavaScript plugins) -->
                        <script src="' . $bootstrap_dir . 'js/jquery.min.js"></script>
                        <!-- Include all compiled plugins (below), or include individual files as needed -->
                        <script src="' . $bootstrap_dir . 'js/bootstrap.min.js"></script>
                        <script src="' . $bootstrap_dir . 'js/owl.carousel.min.js"></script>
                        <script src="' . $bootstrap_dir . 'js/jssor.slider.mini.js"></script>
                        <script src="' . $bootstrap_dir . 'js/classie.js"></script>
                        <script src="' . $bootstrap_dir . 'js/selectFx.js"></script>
                        <script src="' . $bootstrap_dir . 'js/bootstrap-datepicker.min.js"></script>
                        <script src="' . $bootstrap_dir . 'js/starrr.min.js"></script>
                        <script src="' . $bootstrap_dir . 'js/nivo-lightbox.min.js"></script>
                        <script src="' . $bootstrap_dir . 'js/jquery.shuffle.min.js"></script>
                        <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
                        <script src="' . $bootstrap_dir . 'js/gmaps.min.js"></script>
                        <script src="' . $bootstrap_dir . 'js/jquery.parallax-1.1.3.js"></script>
                        <script src="' . $bootstrap_dir . 'js/script.js"></script>';
        }

}
