<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reservation extends Public_Controller {

    protected $data;

    public function __construct() {
        parent::__construct();
        $this->load->model('Room_model');
        $this->load->library('form_validation');
        $this->load->helper(array('combobox', 'date'));
        $this->form_validation->set_error_delimiters(
                '<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
		<i class="fa fa-question-circle"></i> ', ' </div>'
        );
    }

    private function _render_reservation_template($template, $data_) {
        $this->data['title_top'] = get_class();
        $this->data['title_top_desc'] = 'my desc';
        $this->template['image_top_header'] = $this->_render_page('public/_templates/image_top_header', $this->data, TRUE);

        $this->template['form_template'] = $this->_render_page($template, $data_, TRUE);
        $this->_render_public_page(get_class(), $this, 'public/reservation', $this->template);
    }

    private function check_room_session() {
        if ($this->session->has_userdata('room_id')) {
            
        } else {
            show_error('Romm is unavailable or not exist.');
        }
    }

    private function validate_page_($page) {
        switch ($page) {
            default :
            case 1://select room
                $session_names = array();
                $session_names[] = 'room_id';

                //check in                
                $session_names[] = 'check_in';
                $session_names[] = 'check_out';
                $session_names[] = 'adult_count';
                $session_names[] = 'child_count';
                $this->session->unset_userdata($session_names);
                break;
            case 2://check in

                if (!$this->input->get('room-id')) {
                    show_error('Missing Parameter.');
                }
                $room_id_ = $this->input->get('room-id');


                /*
                 * check if room_id is exist, then check if available
                 * 
                 */
                if (TRUE) {
                    $this->data['room_id'] = $room_id_;
                    $this->session->set_userdata('room_id', $room_id_);
                } else {
                    show_error('Romm is unavailable or not exist.');
                }

                break;
            case 3://personal info
                $this->check_room_session();

                break;
            case 4://payment
                $this->check_room_session();
                break;
            case 5://thank you
                $this->check_room_session();
                break;
        }
    }

    #1 | select room

    public function index() {
        $this->validate_page_(1);


        //select room
        $this->data['rooms'] = $this->Room_model->where(array('room_active' => TRUE))->with_room_type()->as_object()->get_all();

        $this->_render_reservation_template('public/_templates/reservation_select_room', $this->data);
    }

    #2

    public function check_in() {
        $this->validate_page_(2);
        $this->data['message'] = 'test error';
        $this->form_validation->set_rules(array(
            array(
                'field' => 'check_in',
                'label' => 'Check In',
                'rules' => 'required',
            ),
            array(
                'field' => 'check_out',
                'label' => 'Check Out',
                'rules' => 'required',
            ),
            array(
                'field' => 'adult_count',
                'label' => 'Adult',
                'rules' => 'required',
            ),
            array(
                'field' => 'child_count',
                'label' => 'Child',
                'rules' => 'required',
            ),
        ));

        if ($this->form_validation->run()) {
            $this->session->set_userdata(array(
                'check_in' => $this->input->post('check_in', TRUE),
                'check_out' => $this->input->post('check_out', TRUE),
                'adult_count' => $this->input->post('adult_count', TRUE),
                'child_count' => $this->input->post('child_count', TRUE)
            ));
            redirect(base_url('reservation/personal-info'), 'refresh');
        } else {
            $this->data['message'] = validation_errors();
        }

        $this->_render_reservation_template('public/_templates/reservation_check_in', $this->data);
    }

    #3

    public function personal_info() {
        $this->validate_page_(3);

        $this->data['room'] = $this->Room_model->where(array('room_id' => $this->session->userdata('room_id')))->with_room_type()->as_object()->get();
        $this->_render_reservation_template('public/_templates/reservation_personal_info', $this->data);
    }

    #4

    public function payment() {
        $this->validate_page_(4);

        $this->_render_reservation_template('public/_templates/reservation_payment', $this->data);
    }

    #5

    public function thank_you() {
        $this->validate_page_(5);

        $this->_render_reservation_template('public/_templates/reservation_thank_you', $this->data);
    }

    public function resources($bootstrap_dir = NULL) {
        if (is_null($bootstrap_dir)) {
            show_404();
        }
        return ' 
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic|Playfair+Display:400,400italic,700,700italic,900,900italic" rel="stylesheet" type="text/css">
		<!-- Bootstrap -->
		<link href="' . $bootstrap_dir . 'css/bootstrap.min.css" rel="stylesheet">
		<link href="' . $bootstrap_dir . 'css/font-awesome.min.css" rel="stylesheet">

		<link href="' . $bootstrap_dir . 'css/owl.carousel.css" rel="stylesheet">
		<link href="' . $bootstrap_dir . 'css/owl.theme.css" rel="stylesheet">
		<link href="' . $bootstrap_dir . 'css/owl.transitions.css" rel="stylesheet">
		<link href="' . $bootstrap_dir . 'css/cs-select.css" rel="stylesheet">
		<link href="' . $bootstrap_dir . 'css/bootstrap-datepicker3.min.css" rel="stylesheet">
		<link href="' . $bootstrap_dir . 'css/freepik.hotels.css" rel="stylesheet">
		<link href="' . $bootstrap_dir . 'css/nivo-lightbox.css" rel="stylesheet">
		<link href="' . $bootstrap_dir . 'css/nivo-lightbox-theme.css" rel="stylesheet">
		<link href="' . $bootstrap_dir . 'css/style.css" rel="stylesheet">




		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn\'t work if you view the page via file:// -->
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
